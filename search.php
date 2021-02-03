<?php


include_once("includes/header.php");
include("includes/db.php");
?>


<!-- Navbar -->
<?php
include("includes/navbar.php");




?>
<!-- Navbar -->

</header>
<!--Main Navigation-->


<!--Main layout-->
<main class="mt-5 pt-5">
    <div class="container">

        <?php











        ?>

        <!--Section: Cards-->
        <section class="pt-5">

            <!--Grid row-->
            <div class="row mt-3 wow fadeIn">

                <?php
                if (isset($_POST['searchKey'])) {
                    $searchKey = $_POST['searchKey'];
                } else if (isset($_GET['key'])) {
                    $searchKey = $_GET['key'];
                }


                $newSearch =  "%" . $searchKey . "%";
                $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
                $sql = $conn->prepare("SELECT * FROM posts WHERE post_title LIKE ?");
                $sql->bind_param('s', $newSearch);
                $sql->execute();
                $results = $sql->get_result();
                $allRecrods = mysqli_num_rows($results);
                // Calculate total pages
                $totoalPages = ceil($allRecrods / $limit);
                // Current pagination page number
                $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
                $prev = $page - 1;
                $next = $page + 1;

                // Offset
                $paginationStart = ($page - 1) * $limit;

                // Limit query

                $sql = $conn->prepare("SELECT * FROM posts WHERE post_title LIKE ? LIMIT $paginationStart, $limit");
                $sql->bind_param('s',  $newSearch);
                $sql->execute();
                $resultsCat = $sql->get_result();
                while ($row = mysqli_fetch_assoc($resultsCat)) {

                ?>

                    <?php
                    $color = '';
                    if ($row['manufacturer'] == 'AMD') {
                        $color = 'danger';
                    } else if ($row['manufacturer'] == 'Nvidia') {
                        $color = 'success';
                    } else {
                        $color = 'primary';
                    }
                    $postIdd = $row['post_id'];
                    $query = $conn->prepare('SELECT * FROM images WHERE post_id = ? LIMIT 5');
                    $query->bind_param('s', $postIdd);
                    $query->execute();
                    $results1 = $query->get_result();
                    $row1 = mysqli_fetch_assoc($results1);


                    $cat_name = $row['post_category_id'];

                    $query = $conn->prepare('SELECT * FROM categories WHERE cat_id = ? LIMIT 1');
                    $query->bind_param('i', $cat_name);
                    $query->execute();
                    $results1 = $query->get_result();
                    $row2 = mysqli_fetch_assoc($results1)

                    ?>


                    <!--Grid column-->
                    <div class="col-lg-5 col-xl-4 mb-4 ">
                        <!--Featured image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="admin/images/<?php echo $row1['name'] ?>" class="img-fluid border rounded border-<?php echo $color ?>" alt="">
                            <a href="post-page.php?id=<?php echo $postIdd ?>" target="_blank">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                    </div>

                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4 pt-2 border rounded border-white bg-<?php echo $color ?>">
                        <h3 class="mb-3 font-weight-bold dark-black-text">
                            <strong><?php echo $row['post_title'] ?></strong>
                        </h3>
                        <?php $contentTrimmed =  mb_strimwidth($row['post_content'], 0, 200, "..."); ?>
                        <p class="dark-black-text"><?php echo $contentTrimmed ?></p>
                        <span class="badge rounded-pill bg-<?php echo $color ?> fa-calendar-alt float-left "><i class="fas fa-calendar-alt mr-2"></i><?php echo $row['post_date']  ?></span>
                        <span class="badge bg-<?php echo $color ?> float-right"><?php echo $row2['cat_title']  ?></span>

                    </div>
                    <!--Grid column-->



                <?php

                }
                ?>






            </div>
            <!--Grid row-->







            <!--Pagination-->
            <!--Pagination-->
            <nav class="d-flex justify-content-center wow fadeIn">
                <ul class="pagination pg-blue">

                    <!--Arrow left-->
                    <li class="page-item <?php if ($page <= 1) {
                                                echo 'disabled';
                                            } ?> ">
                        <a class="page-link" href="<?php if ($page <= 1) {
                                                        echo '#';
                                                    } else {
                                                        echo '?page=' . $prev;
                                                    } ?> " aria-label="Previous">
                            <span aria-hidden="true"> &lArr;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>


                    <?php
                    for ($i = 1; $i <= $totoalPages; $i++) {
                    ?>
                        <li class="page-item <?php if ($page == $i) {
                                                    echo 'active';
                                                }  ?>">
                            <a class="page-link" href="<?php echo 'search.php?page=' . $i ?>&key=<?php echo $searchKey ?>"><?php echo $i ?>
                                <?php if ($page == $i) {
                                ?>
                                    <span class="sr-only">(current)</span>
                                <?php
                                } ?>

                            </a>
                        </li>

                    <?php
                    }

                    ?>


                    <li class="page-item <?php if ($page >= $totoalPages) {
                                                echo 'disabled';
                                            } ?> ">
                        <a class="page-link" href="<?php if ($page >= $totoalPages) {
                                                        echo '#';
                                                    } else {
                                                        echo '?page=' . $next;
                                                    } ?>&key=<?php echo $searchKey ?> " aria-label="Next">
                            <span aria-hidden="true">&rArr;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!--Pagination-->
            <!--Pagination-->

        </section>
        <!--Section: Cards-->

    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mdb-color darken-2 mt-4 wow fadeIn">

    <!--Call to action-->
    <div class="pt-4">
        <a class="btn btn-outline-white" href="https://mdbootstrap.com/docs/jquery/getting-started/download/" target="_blank" role="button">Download MDB
            <i class="fas fa-download ml-2"></i>
        </a>
        <a class="btn btn-outline-white" href="https://mdbootstrap.com/education/bootstrap/" target="_blank" role="button">Start
            free tutorial
            <i class="fas fa-graduation-cap ml-2"></i>
        </a>
    </div>
    <!--/.Call to action-->

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
        <a href="https://www.facebook.com/mdbootstrap" target="_blank">
            <i class="fab fa-facebook-f mr-3"></i>
        </a>

        <a href="https://twitter.com/MDBootstrap" target="_blank">
            <i class="fab fa-twitter mr-3"></i>
        </a>

        <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
            <i class="fab fa-youtube mr-3"></i>
        </a>

        <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
            <i class="fab fa-google-plus-g mr-3"></i>
        </a>

        <a href="https://dribbble.com/mdbootstrap" target="_blank">
            <i class="fab fa-dribbble mr-3"></i>
        </a>

        <a href="https://pinterest.com/mdbootstrap" target="_blank">
            <i class="fab fa-pinterest mr-3"></i>
        </a>

        <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
            <i class="fab fa-github mr-3"></i>
        </a>

        <a href="http://codepen.io/mdbootstrap/" target="_blank">
            <i class="fab fa-codepen mr-3"></i>
        </a>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
        © 2019 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();
</script>
</body>

</html>