<?php
include_once("includes/db.php");
include_once("includes/functions.php");
include_once("includes/admin-header.php");

?>

<?php
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $sql = "DELETE FROM comments WHERE comment_id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
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

                <div class="row">
                    <table class="table  table-striped table-bordered table-hover">
                        <thead>



                            <tr>
                                <th class="text-center">ID</th>
                                <th>ID Objave</th>
                                <th>Autor</th>
                                <th>Datum</th>
                                <th class="text-center">Brisanje</th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php

                            $sql = "SELECT * FROM comments"; // SQL with parameters
                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            $result = $stmt->get_result(); // get the mysqli result
                            //$user = $result->fetch_assoc(); // fetch data 
                            while ($row = mysqli_fetch_assoc($result)) {

                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row["comment_post_id"];
                                $comment_author = $row["comment_author"];
                                $comment_date = $row["comment_date"];


                            ?>

                                <tr>
                                    <td class="text-center"><?php echo $comment_id ?></td>


                                    <td><?php echo $comment_post_id ?></td>
                                    <td><?php echo $comment_author ?></td>
                                    <td><?php echo $comment_date ?></td>


                                    <td class="td-actions text-center">
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal1<?php echo $comment_id ?>">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button>

                                    </td>
                                    <!-- Modal For Deleting -->
                                    <div class="modal fade modal-black" id="exampleModal1<?php echo $comment_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Potvrda brisanja</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                        <i class="tim-icons icon-simple-remove"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Jeste li sigurni da želite obrisati ovog korisnika?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                                                    <a href="admin-comments.php?delete=<?php echo $comment_id ?>"><button type="button" class="btn btn-primary">Izbriši</button></a>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
