<?php
declare( strict_types=1 );

include( "../admin/includes/header.php" ); ?>
<?php if (!$session->is_logged_in()) {
    redirect("login.php");
} ?>

<?php

if (isset($_POST['submit'])) {
    if ($_POST['email'] != $_POST['confirm_email']) {
        $_SESSION['message'] = "Email address not matching";
    }
    if ($_POST['password'] != $_POST['confirm_password']) {
        $_SESSION['message'] = "Password not matching";
    }
    if ($_POST['email'] == $_POST['confirm_email'] && $_POST['password'] == $_POST['confirm_password']) {
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->email = $_POST['email'];
        $user->profile_image_file = $_FILES['profile_image'];
        $user->tmpName = $_FILES['profile_image']['tmp_name'];
        $user->image = $_FILES['profile_image']['name'];

        $user->create_new_user();
    }
}


?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Gallery Admin</a>
    </div>
    <!-- Top Menu Items -->
    <?php include "../admin/includes/navigation/top_nav.php" ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "../admin/includes/navigation/sidebar_nav.php" ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gallery Users :
                    <small>Listing</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="/admin/index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Users
                    </li>
                </ol>
            </div>
        </div>
        <!--        <pre>--><? //= print_r($user, true) ?><!--</pre>-->
        <div class="col-md-12">
            <div id='hide' class="center-block">
                <?php if (!empty($_SESSION['message'])) {
                    echo "<div class='alert alert-warning '>
  <strong>Warning!</strong>" . $_SESSION['message'] . "
</div>";
                } ?>
            </div>
            <form action="" class="form-group" method="post" enctype="multipart/form-data">
                <div class="col-md-4">
                    <label for="first_name">First Name : </label>
                    <input typeof="text" name="first_name" id="first_name" class="form-control">
                    <label for="last_name">Last Name :</label>
                    <input type="text" name="last_name" id="last_name" class="form-control">
                    <label for="username">Username : </label>
                    <input type="text" id="username" name="username" class="form-control" required>
                    <label for="email">Email address :</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                    <label for="confirm_email">Confirm email address :</label>
                    <input type="text" id="confirm_email" name="confirm_email" class="form-control" required>
                    <label for="password">Password :</label>
                    <input type="text" id="password" name="password" class="form-control" required>
                    <label for="confirm_password">Confirm Password :</label>
                    <input type="text" id="confirm_password" name="confirm_password" class="form-control" required>
                    <br>

                </div>
                <div class="col-md-3">
                    <img src="../admin/assets/no-image-available-icon-6.jpg" alt="" class="thumbnail"
                         style="width: 320px;height: 200px;">
                    <label for="profile_image">Profile image : </label>
                    <input type="file" id="profile_image" name="profile_image" class="form-control" alt="profile-image">
                    <br>
                    <input class="btn btn-success btn-lg" id="submit" type="submit" value="Create" name="submit">
                    <a href="../admin/users.php" class="btn-lg btn btn-danger">Cancel</a>
                </div>


            </form>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include( "../admin/includes/footer.php" ); ?>
