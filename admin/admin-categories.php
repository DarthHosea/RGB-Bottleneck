<?php
include_once("includes/db.php");
include_once("includes/functions.php");
include_once("includes/admin-header.php");

?>

<?php

if (isset($_POST['create_category'])) {


    $queryResult = createCategory();
    confirmQuery($queryResult);
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
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data" name="add_category">
                                    <div class="form-group">
                                        <label for="category">Nova kategorija</label>
                                        <input type="text" name="category" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ime kategorije">

                                    </div>


                                    <button type="submit" name="create_category" class="btn btn-primary">Dodaj</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="card-title"> Kategorije</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table tablesorter " id="">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th>
                                                    ID
                                                </th>
                                                <th>
                                                    Ime kategorije
                                                </th>
                                                <th class="text-center">Promjena</th>
                                                <th class="text-center">Brisanje</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM categories"; // SQL with parameters
                                            $stmt = $conn->prepare($sql);

                                            $stmt->execute();
                                            $result = $stmt->get_result(); // get the mysqli result
                                            //$user = $result->fetch_assoc(); // fetch data
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['cat_id'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['cat_title'] ?>
                                                    </td>
                                                    <td class="td-actions text-center">

                                                        <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                                            <i class="tim-icons icon-settings"></i>
                                                        </button>

                                                    </td>
                                                    <td class="td-actions text-center">


                                                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                                                            <i class="tim-icons icon-simple-remove"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
