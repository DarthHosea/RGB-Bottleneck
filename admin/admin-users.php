<?php
include_once("includes/db.php");
include_once("includes/functions.php");
include_once("includes/admin-header.php");

?>





<?php
if (isset($_GET['edit'])) {
    $role = $_GET['role'];
    if ($role == 'Admin') {
        $role = 'Standard';
    } else {
        $role = 'Admin';
    }
    $user_id = $_GET['edit'];
    $stmtImages = $conn->prepare("UPDATE users SET user_role = ? WHERE user_id = ? ");
    $stmtImages->bind_param("si", $role, $user_id);
    $stmtImages->execute();
    header("location: admin-users.php");
}


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
                if (isset($_GET['delete'])) {
                    $user_id = $_GET['delete'];
                    $sql = "DELETE FROM users WHERE user_id = ? ";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    echo '<div class="alert alert-success" role="alert">
Korisnik uspješno obrisan.
</div>';
                }


                ?>
                <div class="row">
                    <table class="table  table-striped table-bordered table-hover">
                        <thead>



                            <tr>
                                <th class="text-center">ID</th>
                                <th>Username</th>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>E-mail</th>
                                <th>Ovlast</th>
                                <th class="text-center">Promjena</th>
                                <th class="text-center">Slika</th>
                                <th class="text-center">Brisanje</th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php

                            $sql = "SELECT * FROM users"; // SQL with parameters
                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            $result = $stmt->get_result(); // get the mysqli result
                            //$user = $result->fetch_assoc(); // fetch data 
                            while ($row = mysqli_fetch_assoc($result)) {

                                $user_id = $row['user_id'];
                                $username = $row["username"];
                                $user_firstname = $row["user_firstname"];
                                $user_lastname = $row["user_lastname"];
                                $user_email = $row["user_email"];
                                $user_image = $row["user_image"];
                                $user_role = $row["user_role"];

                            ?>

                                <tr>
                                    <td class="text-center"><?php echo $user_id ?></td>

                                    <td><?php echo $username ?></td>
                                    <td><?php echo $user_firstname ?></td>
                                    <td><?php echo $user_lastname ?></td>
                                    <td><?php echo $user_email ?></td>
                                    <td><?php echo $user_role ?></td>
                                    <td class="td-actions text-center">

                                        <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal3<?php echo $user_id ?>">
                                            <i class="tim-icons icon-settings"></i>
                                        </button>




                                    </td>
                                    <td class="td-actions text-center">

                                        <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal2<?php echo $user_id ?>">
                                            <i class="tim-icons  icon-badge"></i>
                                        </button>
                                    </td>
                                    <td class="td-actions text-center">
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal1<?php echo $user_id ?>">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button>

                                    </td>
                                    <?php include("includes/modals-users.php") ?>
                                </tr>



                            <?php
                            }




                            ?>





                        </tbody>
                    </table>
                </div>



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
