<?php
declare( strict_types=1 );
include "../admin/includes/header.php";
?>
<?php
if ($session->is_logged_in()) {
    redirect("index.php");
}

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //Method to check database user
    $user_found = $user->verify_user($username, $password);

    if ($user_found) {
//      echo  var_dump ($user_found->fetch_row ());die();
        $session->login($user_found->fetch_object());
        redirect('index.php');
    } else {
        $the_message = "<p class='text-center alert alert-danger'>Your password or username are incorrect</p>";
    }


} else {
    $the_message = "";
    $username = "";
    $password = "";
}
?>

<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php echo $the_message; ?></h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username" style="color: white;">Username</label>
            <input type="text" id="username" class="form-control" name="username"
                   value="<?php echo htmlentities($username); ?>">

        </div>

        <div class="form-group">
            <label style="color: white;" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password"
                   value="<?php echo htmlentities($password); ?>">

        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </div>


    </form>


</div>
