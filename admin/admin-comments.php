<?php
include_once("includes/db.php");
include_once("includes/functions.php");
include_once("includes/admin-header.php");

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
                    $sql = "DELETE FROM comments WHERE comment_id = ? ";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    echo '<div class="alert alert-success" role="alert">
Komentar je uspješno obrisan.
</div>';
                }


                ?>
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


                            $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 10;
                            $sql = $conn->prepare("SELECT * FROM comments");
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
                            $sql = $conn->prepare("SELECT * FROM comments LIMIT $paginationStart, $limit");
                            $sql->execute();
                            $resultsComments = $sql->get_result();
                            //$user = $result->fetch_assoc(); // fetch data 
                            while ($row = mysqli_fetch_assoc($resultsComments)) {

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
                    <!--Pagination-->

                </div>
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
                                <a class="page-link" href="<?php echo 'admin-users.php?page=' . $i ?>"><?php echo $i ?>
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
