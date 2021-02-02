<?php

include("includes/db.php");

$post_date = date('Y-m-d H:i:s');
$post_id = $_POST['post_id'];
if (!empty($_POST["comment_author"]) && !empty($_POST["comment_content"])) {

    $stmt = $conn->prepare("INSERT INTO comments(comment_author, comment_content, comment_date,comment_post_id) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi", $_POST["comment_author"], $_POST["comment_content"], $post_date, $post_id);
    if ($stmt->execute()) {
        $message = '<label class="text-success">Comment posted Successfully.</label>';
        $status = array(
            'error'  => 0,
            'message' => $message
        );
    }
} else {
    $message = '<label class="text-danger">Error: Comment not posted.</label>';
    $status = array(
        'error'  => 1,
        'message' => $message
    );
}
echo json_encode($status);
