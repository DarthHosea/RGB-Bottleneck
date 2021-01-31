<?php
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $sql = "DELETE FROM posts WHERE post_id = $post_id "; // SQL with parameters
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}


?>




<table class="table">
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
                <td><?php echo $post_author ?></td>
                <td><?php echo $post_date ?></td>
                <td><?php echo $post_status ?></td>
                <td><?php echo $post_comment_count ?></td>
                <td class="td-actions text-center">
                    <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon">
                        <i class="tim-icons icon-single-02"></i>
                    </button>

                    <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal1<?php echo $post_id ?>">
                        <i class="tim-icons icon-settings"></i>
                    </button>


                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-toggle="modal" data-target="#exampleModal<?php echo $post_id ?>">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>

                </td>
            </tr>

            <?php include("modals-posts.php") ?>

        <?php
        }




        ?>





    </tbody>
</table>