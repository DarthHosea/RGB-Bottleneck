<?php


include_once("includes/header.php");
include("includes/db.php");
?>


<!-- Navbar -->
<?php
include("includes/navbar.php");
$manufacturer = $_GET['manufacturer'];
if ($manufacturer == 'AMD') {
    $color = 'danger';
} else if ($manufacturer == 'Intel') {
    $color = 'primary';
} else {
    $color = 'success';
}
?>
<!-- Navbar -->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main class=" pt-5">
    <div class="container-fluid">


        <!--Section: Cards-->

        <section class="text-center">
            <div class="row ml-2 mb-4 wow fadeIn justify-content-left">
                <h1 class="text-<?php echo $color ?> fw-bold"><?php echo $manufacturer ?></h1>
            </div>

            <!--Grid row-->
            <div class="row mb-4 wow fadeIn justify-content-center border border-<?php echo $color ?>">
                <!-- AMD
                <!--Grid column-->
                <div class="col-sm">
                    <div class="row mb-4 wow fadeIn justify-content-center border border-<?php echo $color ?>">
                        <H2>Najpopularnije vijesti</H2>
                    </div>
                    <div class="row mb-4 wow fadeIn justify-content-center border border-<?php echo $color ?>">
                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <div class="view overlay">
                                <img src="https://mdbootstrap.com/img/Marketing/mdb-press-pack/mdb-vue.jpg" class="card-img-top" alt="">
                                <a href="https://mdbootstrap.com/vue/" target="_blank">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">MDB with Vue</h4>
                                <!--Text-->
                                <p class="card-text">Based on the latest Bootstrap 4 and Vue 2.5.7. </p>
                                <a href="https://mdbootstrap.com/vue/" target="_blank" class="btn btn-primary btn-md">Free download
                                    <i class="fas fa-download ml-2"></i>
                                </a>
                            </div>

                        </div>
                        <!--/.Card-->
                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <div class="view overlay">
                                <img src="https://mdbootstrap.com/img/Marketing/mdb-press-pack/mdb-vue.jpg" class="card-img-top" alt="">
                                <a href="https://mdbootstrap.com/vue/" target="_blank">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">MDB with Vue</h4>
                                <!--Text-->
                                <p class="card-text">Based on the latest Bootstrap 4 and Vue 2.5.7. </p>
                                <a href="https://mdbootstrap.com/vue/" target="_blank" class="btn btn-primary btn-md">Free download
                                    <i class="fas fa-download ml-2"></i>
                                </a>
                            </div>

                        </div>
                        <!--/.Card-->
                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <div class="view overlay">
                                <img src="https://mdbootstrap.com/img/Marketing/mdb-press-pack/mdb-vue.jpg" class="card-img-top" alt="">
                                <a href="https://mdbootstrap.com/vue/" target="_blank">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">MDB with Vue</h4>
                                <!--Text-->
                                <p class="card-text">Based on the latest Bootstrap 4 and Vue 2.5.7. </p>
                                <a href="https://mdbootstrap.com/vue/" target="_blank" class="btn btn-primary btn-md">Free download
                                    <i class="fas fa-download ml-2"></i>
                                </a>
                            </div>

                        </div>
                        <!--/.Card-->
                    </div>
                </div>




                <?php



                $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
                $sql = $conn->prepare("SELECT * FROM posts WHERE manufacturer = ?");
                $sql->bind_param('s', $manufacturer);
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
                $sql = $conn->prepare("SELECT * FROM posts WHERE manufacturer = ? LIMIT $paginationStart, $limit");
                $sql->bind_param('s', $manufacturer);
                $sql->execute();
                $resultsCat = $sql->get_result();



                ?>
                <div class="col-10">
                    <div class="row mb-4 wow fadeIn justify-content-center border-3 border-<?php echo $color ?>" style="border-width: 15px;">


                        <?php
                        while ($row = mysqli_fetch_assoc($resultsCat)) {

                        ?>
                            <div class="col-lg-4 col-md-12 mb-4 ">
                                <div class="card text-white bg-<?php echo $color ?>">
                                    <?php
                                    $postIdd = $row['post_id'];
                                    $query = $conn->prepare('SELECT * FROM images WHERE post_id = ? LIMIT 1');
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
                                    <!--Card image-->
                                    <span class="border border-<?php echo $color ?>">
                                        <div class="view overlay">
                                            <span class="badge bg-<?php echo $color ?> float-right"><?php echo $row2['cat_title']  ?></span>
                                            <span class="badge bg-<?php echo $color ?> float-left"><?php echo $row2['cat_title']  ?></span>
                                            <img src="admin/images/<?php echo $row1['name'] ?>" class="card-img-top" alt="">
                                            <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                    </span>
                                    <!--Card content-->
                                    <div class="card-body">
                                        <!--Title-->
                                        <div class="row" style="margin-left: 10px;">
                                            <h4 class="card-title float-left"><?php echo $row['post_title'] ?></h4>
                                        </div>

                                        <!--Text-->

                                        <?php $contentTrimmed =  mb_strimwidth($row['post_content'], 0, 200, "..."); ?>
                                        <p class="card-text text-white"><?php echo $contentTrimmed ?></p>
                                        <span class="badge rounded-pill bg-<?php echo $color ?> float-right"><?php echo $row['post_date']  ?></span>

                                    </div>

                                </div>
                            </div>
                            <!--Grid column-->
                        <?php
                        }




                        ?>
                    </div>




                </div>
            </div>
            <!--Grid row-->




            <?php





            ?>
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
                            <a class="page-link" href="<?php echo 'categories.php?manufacturer=' . $manufacturer . '&page=' . $i ?>"><?php echo $i ?>
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
                                                    } ?> " aria-label="Next">
                            <span aria-hidden="true">&rArr;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!--Pagination-->

        </section>

        <!--Section: Cards-->

    </div>
</main>
<!--Main layout-->

<!--Footer-->
<?php

include_once("includes/footer.php");
