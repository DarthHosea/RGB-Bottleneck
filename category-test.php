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
    <div class="container">
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
        <section class="pt-5">
            <?php
            while ($row = mysqli_fetch_assoc($resultsCat)) {

            ?>
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
                <!--Grid row-->
                <div class="row mt-3 wow fadeIn">

                    <!--Grid column-->
                    <div class="col-lg-5 col-xl-4 mb-4">
                        <!--Featured image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="admin/images/<?php echo $row1['name'] ?>" class="img-fluid" alt="">
                            <a href="https://mdbootstrap.com/education/tech-marketing/automated-app-introduction/" target="_blank">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
                        <h3 class="mb-3 font-weight-bold dark-grey-text">
                            <strong><?php echo $row['post_title'] ?></strong>
                        </h3>
                        <?php $contentTrimmed =  mb_strimwidth($row['post_content'], 0, 200, "..."); ?>
                        <p class="grey-text"><?php echo $contentTrimmed ?></p>
                        <a href="https://mdbootstrap.com/education/tech-marketing/automated-app-introduction/" target="_blank" class="btn btn-<?php echo $color ?> btn-md">Detaljnije
                            <i class="fas fa-play ml-2"></i>
                        </a>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->
                <hr class="mb-5">

            <?php

            }
            ?>
        </section>


    </div>


</main>
<!--Main layout-->

<!--Footer-->
<?php

include_once("includes/footer.php");
