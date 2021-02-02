<?PHP
session_start();

?>
<?php
$url = $_SERVER['REQUEST_URI'];
//strpos($a, 'are');

?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
            <strong class="blue-text">RGB Bottleneck</strong>
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
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">About MDB</a>
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
                <?php
                if (!isset($_SESSION['username'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="login.php">Prijava</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="logout.php">Odjava</a>
                    </li>
                <?php
                }

                ?>
                <?php
                if (isset($_SESSION['role'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="admin/home-admin.php">Admin Panel</a>
                    </li>
                <?php
                } ?>

            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a href="https://www.facebook.com/mdbootstrap" class="nav-link waves-effect" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://twitter.com/MDBootstrap" class="nav-link waves-effect" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded waves-effect" target="_blank">
                        <i class="fab fa-github mr-2"></i>MDB GitHub
                    </a>
                </li>
            </ul>

        </div>

    </div>
</nav>