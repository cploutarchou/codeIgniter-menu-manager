<?php
declare( strict_types=1 );
require_once '../includes/init.php';

if (isset($_POST['image_name'])) {
    $data = [
        'image' => $_POST['image_name'],
        'user_id' => $_POST['user_id']
    ];
//    die('<pre>'. var_dump($data));
    $user->ajax_save_user_profile_image($data);


//    echo "This is data from server";
}
//echo "<pre>".var_dump($_POST['image_id']).die();
if (isset($_POST['image_id'])) {
    $res = $photo->get_image_info($_POST['image_id']);
//        echo "<pre>".var_dump($res).die();
    if (!empty($res)) {
        return $res;
    }
}
