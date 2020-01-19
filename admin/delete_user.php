<?php

declare( strict_types=1 );
session_start();
include "../admin/includes/init.php" ?>

<?php if (!$session->is_logged_in()) {
    redirect("login.php");
} ?>

<?php
if (empty($_POST['id'])) {
    redirect("/admin/users.php");
} else {

//The photo_found object new actually is an object of class photo
    $user = $user->find_by_id($_POST['id']);
//echo "<pre>";print_r($res);die();
    if ($user) {
        $res = $user->delete_user();
//        echo "<pre>".print_r($res,true);"</pre>";die();
        if ($res == true) {
            echo json_encode(['status' => 1, 'msg' => 'User Successfully deleted']);


        } else {
            echo json_encode(['status' => 0, 'msg' => 'Unable to delete user']);
        }
    }

}

?>

