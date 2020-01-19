<?php

declare( strict_types=1 );
session_start();
include "../admin/includes/init.php" ?>

<?php if (!$session->is_logged_in()) {
    redirect("login.php");
} ?>

<?php
if (empty($_POST['id'])) {
    redirect("/admin/comments.php");
} else {

//The photo_found object new actually is an object of class photo
    $comment_object = $comment->find_by_id($_POST['id']);
//    echo "<pre>";
//    print_r($find_comment);
//    die();
    if ($comment_object) {
        $comment_object = $comment_object->delete();
//        echo "<pre>".print_r($res,true);"</pre>";die();
        if ($comment_object == true) {
            echo json_encode(['status' => 1, 'msg' => 'Comment Successfully deleted']);


        } else {
            echo json_encode(['status' => 0, 'msg' => 'Unable to delete comment']);
        }
    }

}

?>

