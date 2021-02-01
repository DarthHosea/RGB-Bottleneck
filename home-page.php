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



        <hr class="my-5">

        <!--Section: Cards-->

        <section class="text-center">

            <!--Grid row-->
            <div class="row mb-4 wow fadeIn">
                <!-- AMD
                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4">
                    <?php
                    $manu = 'AMD';
                    $query = $conn->prepare('SELECT * FROM posts WHERE manufacturer = ?');
                    $query->bind_param('s', $manu);
                    $query->execute();
                    $results = $query->get_result();
                    while ($row = mysqli_fetch_assoc($results)) {

                    ?>
                        <div class="card">
                            <?php
                            $postIdd = $row['post_id'];
                            $query = $conn->prepare('SELECT * FROM images WHERE post_id = ? LIMIT 1');
                            $query->bind_param('s', $postIdd);
                            $query->execute();
                            $results1 = $query->get_result();
                            $row1 = mysqli_fetch_assoc($results1)

                            ?>
                            <!--Card image-->

                            <div class="view overlay">
                                <img src="admin/images/010220210759002018_hyundai_i30_n_option_2_1920x1080.jpg" class="card-img-top" alt="">
                                <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title"><?php echo $row['post_title'] ?></h4>
                                <!--Text-->
                                <p class="card-text"><?php echo $row['post_content'] ?></p>
                                <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank" class="btn btn-primary btn-md">Start
                                    tutorial
                                    <i class="fas fa-play ml-2"></i>
                                </a>
                            </div>

                        </div>

                    <?php
                    }




                    ?>


                </div>
                <!--Grid column-->

                <!-- Nvidia
                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4">
                    <?php
                    $manu = 'Nvidia';
                    $query = $conn->prepare('SELECT * FROM posts WHERE manufacturer = ?');
                    $query->bind_param('s', $manu);
                    $query->execute();
                    $results = $query->get_result();
                    while ($row = mysqli_fetch_assoc($results)) {

                    ?>
                        <div class="card">
                            <?php
                            $postIdd = $row['post_id'];
                            $query = $conn->prepare('SELECT * FROM images WHERE post_id = ? LIMIT 1');
                            $query->bind_param('s', $postIdd);
                            $query->execute();
                            $results1 = $query->get_result();
                            $row1 = mysqli_fetch_assoc($results1)

                            ?>
                            <!--Card image-->

                            <div class="view overlay">
                                <img src="admin/images/010220210759002018_hyundai_i30_n_option_2_1920x1080.jpg" class="card-img-top" alt="">
                                <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title"><?php echo $row['post_title'] ?></h4>
                                <!--Text-->
                                <p class="card-text"><?php echo $row['post_content'] ?></p>
                                <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank" class="btn btn-primary btn-md">Start
                                    tutorial
                                    <i class="fas fa-play ml-2"></i>
                                </a>
                            </div>

                        </div>

                    <?php
                    }




                    ?>


                </div>
                <!--Grid column-->

                <!-- Intel
                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4">
                    <?php
                    $manu = 'Intel';
                    $query = $conn->prepare('SELECT * FROM posts WHERE manufacturer = ?');
                    $query->bind_param('s', $manu);
                    $query->execute();
                    $results = $query->get_result();
                    while ($row = mysqli_fetch_assoc($results)) {

                    ?>
                        <div class="card">
                            <?php
                            $postIdd = $row['post_id'];
                            $query = $conn->prepare('SELECT * FROM images WHERE post_id = ? LIMIT 1');
                            $query->bind_param('s', $postIdd);
                            $query->execute();
                            $results1 = $query->get_result();
                            $row1 = mysqli_fetch_assoc($results1)

                            ?>
                            <!--Card image-->

                            <div class="view overlay">
                                <img src="admin/images/010220210759002018_hyundai_i30_n_option_2_1920x1080.jpg" class="card-img-top" alt="">
                                <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title"><?php echo $row['post_title'] ?></h4>
                                <!--Text-->
                                <p class="card-text"><?php echo $row['post_content'] ?></p>
                                <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank" class="btn btn-primary btn-md">Start
                                    tutorial
                                    <i class="fas fa-play ml-2"></i>
                                </a>
                            </div>

                        </div>

                    <?php
                    }




                    ?>


                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->





            <!--Pagination-->
            <nav class="d-flex justify-content-center wow fadeIn">
                <ul class="pagination pg-blue">

                    <!--Arrow left-->
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    <li class="page-item active">
                        <a class="page-link" href="#">1
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">5</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
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
