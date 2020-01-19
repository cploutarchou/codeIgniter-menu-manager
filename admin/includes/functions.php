<?php
declare( strict_types=1 );
spl_autoload_register('myAutoloader');

function myAutoloader($class)
{
    $the_path = "/var/www/vhosts/cpdevlabs.com/gallery.cpdevlabs.com/admin/includes/{$class}.php";
    include $class . '.php';
    if (file_exists($the_path)) {
        require_once( $the_path );
    } else {
        echo "<p class='alert alert-danger text-center'>" . "The file name <b style='color: black'>{$class}.php</b> was not found on our system folders" . "</p>";
        die();
    }
}


/**
 * With that function manage to redirect to any link assign on
 *  location variable
 * @param $location
 */
function redirect($location)
{
    header("location: {$location}");

}

function convert_bytes_to_any($size)
{

    $base = log($size) / log(1024);
    $suffix = array("", "KB", "MB", "GB", "TB");
    $f_base = floor($base);
    return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];

}






