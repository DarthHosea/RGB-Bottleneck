<?php
include_once("includes/db.php");
include_once("includes/functions.php");
include_once("includes/admin-header.php");
ob_start();
?>



<body class="">
    <div class="wrapper">
        <div class="sidebar">
            <!--
            Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
             -->
            <?php
            include_once("includes/admin-sidebar.php");
            ?>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <?php
            include_once("includes/admin-navbar.php");
            ?>
            <!-- End Navbar -->
            <div class="content">
                <?php

                if (isset($_SESSION['success'])) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['success'] ?>
                    </div>
                <?php
                    unset($_SESSION['success']);
                }



                if (isset($_GET['source'])) {

                    $source = $_GET['source'];
                } else {
                    $source = '';
                }

                switch ($source) {

                    case 'add_post';
                        include "includes/add_post.php";
                        break;
                    case 'edit_post';
                        include "includes/edit_post.php";
                        break;


                    default:
                        include "includes/view_all_posts.php";
                        break;
                }


                ?>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                Creative Tim
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                About Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                Blog
                            </a>
                        </li>
                    </ul>
                    <div class="copyright">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2018 made with <i class="tim-icons icon-heart-2"></i> by
                        <a href="javascript:void(0)" target="_blank">Creative Tim</a> for a better web.
                    </div>
                </div>
            </footer>
        </div>
    </div>



    <?php

    //include_once("includes/admin-fixed-plugin.php");
    include_once("includes/admin-footer.php");
