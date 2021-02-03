<?PHP
session_start();

?>
<?php
$url = $_SERVER['REQUEST_URI'];
//strpos($a, 'are');

?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar bg-danger">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
            <strong class="white-text">RGB Bottleneck</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if (strpos($url, 'home-page')) {
                                        echo 'active';
                                    };
                                    ?>">
                    <a class="nav-link waves-effect" href="home-page.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>



                <li class="nav-item <?php if (strpos($url, 'AMD')) {
                                        echo 'active';
                                    };
                                    ?>">
                    <a class="nav-link waves-effect" href="categories.php?manufacturer=AMD">AMD</a>
                </li>
                <li class="nav-item <?php if (strpos($url, 'Nvidia')) {
                                        echo 'active';
                                    };
                                    ?>">
                    <a class="nav-link waves-effect" href="categories.php?manufacturer=Nvidia">Nvidia</a>
                </li>
                <li class="nav-item <?php if (strpos($url, 'Intel')) {
                                        echo 'active';
                                    };
                                    ?>">
                    <a class="nav-link waves-effect" href="categories.php?manufacturer=Intel">Intel</a>
                </li>
                <li class="nav-item dropdown <?php if (strpos($url, 'search.php')) {
                                                    echo 'active';
                                                };
                                                ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pretraga
                    </a>
                    <div style="width: 300px" class="dropdown-menu bg-danger pl-2" aria-labelledby="navbarDropdownMenuLink">

                        <form class="d-flex input-group w-auto" method="post" action="search.php">
                            <input style="top:7px" name="searchKey" type="text" class="form-control" aria-label="Search" />
                            <button class="btn btn-md btn-danger" name="submit" type="submit" data-mdb-ripple-color="dark">
                                Pretraga
                            </button>
                        </form>
                    </div>

                </li>

            </ul>

            <!-- Right -->

            <ul class="navbar-nav nav-flex-icons">
                <li>

                </li>

                <?php
                if (isset($_SESSION['role'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="admin/home-admin.php">Admin Panel</a>
                    </li>
                <?php
                } ?>
                <?php
                if (!isset($_SESSION['username'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="login.php">Prijava</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item ">
                        <a class="nav-link waves-effect" href="logout.php">Odjava</a>
                    </li>
                    <li class="nav-item border border-danger rounded">
                        <img src="userImages\010220210759002018_hyundai_i30_n_option_1_1920x1080.jpg" alt="" width="50" height="40" class="d-inline-block align-top rounded">
                    </li>
                <?php
                }

                ?>

            </ul>

        </div>

    </div>
</nav>