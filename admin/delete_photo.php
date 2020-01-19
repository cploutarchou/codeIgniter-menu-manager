<?php
declare( strict_types=1 );
include( "../admin/includes/header.php" );
include "../admin/includes/init.php" ?>
<?php if (!$session->is_logged_in()) {
    redirect("login.php");
} ?>

<?php
if (empty($_GET['id'])) {
    redirect("/admin/photos.php");
}

//The photo_found object new actually is an object of class photo
$photo_found = $photo->find_by_id($_GET['id']);
//echo "<pre>";print_r($photo_found);die();
if ($photo_found) {
    $photo_found->delete_image();
} else {
    redirect("/admin/photos.php");
}
?>