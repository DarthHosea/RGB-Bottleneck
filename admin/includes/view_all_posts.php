<?php
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $sql = "DELETE FROM posts WHERE post_id = $post_id "; // SQL with parameters
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo '<div class="alert alert-success" role="alert">
    Objava je uspješno obrisana
  </div>';
}


?>

<?php
if (isset($_GET['deleteImage'])) {
    $image_id = $_GET['deleteImage'];
    $stmtImages = $conn->prepare("DELETE FROM images WHERE id = ? ");
    $stmtImages->bind_param("i", $image_id);
    $stmtImages->execute();
    echo '<div class="alert alert-success" role="alert">
    Slike su uspješno obrisane
  </div>';
}


?>


<?php
if (isset($_POST['edit_post'])) {
    //$post_id = $_GET['edit'];

    $queryResult = updatePost();
    confirmQuery($queryResult);
    echo '<div class="alert alert-success" role="alert">
    Objava je uspješno ažurirana
  </div>';
}


?>

<?php
if (isset($_POST['add_images'])) {
    $queryResult = addImages();
    confirmQuery($queryResult);
    echo '<div class="alert alert-success" role="alert">
    Slike su uspješno dodane
  </div>';
}


?>



<table class="table  table-striped table-bordered table-hover">
    <thead>



        <tr>
            <th class="text-center">ID</th>
            <th>Naslov</th>
            <th>Kategorija</th>
            <th>Proizvođač</th>
            <th>Autor</th>
            <th>Datum</th>
            <th>Status</th>
            <th>Broj komentara</th>
            <th class="text-center">Akcije</th>
        </tr>
    </thead>
    <tbody>



        <?php

        $sql = "SELECT * FROM posts"; // SQL with parameters
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        //$user = $result->fetch_assoc(); // fetch data 
        while ($row = mysqli_fetch_assoc($result)) {

            $post_id = $row['post_id'];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_author = $row["post_author"];
            $post_date = $row["post_date"];
            $post_content = $row["post_content"];
            $post_comment_count = $row["post_comment_count"];
            $post_status = $row["post_status"];
            $manufacturer = $row["manufacturer"];


            $sql1 =  "SELECT * FROM categories WHERE cat_id = $post_category_id";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute();
            $result2 = $stmt1->get_result(); // get the mysqli result

            $sql2 =  "SELECT * FROM users WHERE user_id = $post_author";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute();
            $result3 = $stmt2->get_result(); // get the mysqli result
            $userAuthor = mysqli_fetch_assoc($result3);
            $userAuthorName = $userAuthor['username'];
            //$query2 = "SELECT * FROM users WHERE user_id = $post_author";
            //$select_users_id = mysqli_query($connection, $query2);

        ?>

            <tr>
                <td class="text-center"><?php echo $post_id ?></td>
                <td><?php echo $post_title ?></td>
                <?php
                while ($row = mysqli_fetch_assoc($result2)) {

                    $cat_title = $row["cat_title"];

                    echo "<td>{$cat_title}</td>";
                }
                ?>
                <td><?php echo $manufacturer ?></td>
                <td><?php echo $userAuthorName ?></td>
                <td><?php echo $post_date ?></td>
                <td><?php echo $post_status ?></td>
                <td><?php echo $post_comment_count ?></td>
                <td class="td-actions text-center">

                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal3<?php echo $post_id ?>">
                        <i class="tim-icons icon-attach-87"></i>
                    </button>


                    <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal2<?php echo $post_id ?>">
                        <i class="tim-icons icon-single-02"></i>
                    </button>

                    <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal1<?php echo $post_id ?>">
                        <i class="tim-icons icon-settings"></i>
                    </button>


                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal<?php echo $post_id ?>">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>

                </td>
                <?php include("modals-posts.php") ?>
            </tr>



        <?php
        }




        ?>





    </tbody>
</table>