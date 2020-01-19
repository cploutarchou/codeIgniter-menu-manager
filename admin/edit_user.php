<?php
declare( strict_types=1 );
include( "../admin/includes/header.php" ); ?>
<?php if (!$session->is_logged_in()) {
    redirect("login.php");
}
include_once '../admin/photo_library_modal.php'
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

        <?php
        if (isset($_GET['id'])) {
            $user->id = $_GET['id'];
        }
        if (isset($_POST['submit'])) {
            if ($_POST['email'] != $_POST['confirm_email']) {
                $_SESSION['status_msg'] = [
                    'status' => 0,
                    'msg' => 'Email address not matching'
                ];
            }
            if ($_POST['password'] != $_POST['confirm_password']) {
                $_SESSION['status_msg'] = [
                    'status' => 0,
                    'msg' => 'Password not matching'
                ];
            }
            if ($_POST['email'] == $_POST['confirm_email'] && $_POST['password'] == $_POST['confirm_password']) {
                $user->first_name = $_POST['first_name'];
                $user->last_name = $_POST['last_name'];
                $user->username = $_POST['username'];
                $user->password = $_POST['password'];
                $user->email = $_POST['email'];
                $res = $user->find_by_id($user->id);
                if (empty($_FILES['profile_image']['name'])) {
                    $user->image = $res->image;
                } else {
                    $user->profile_image_file = $_FILES['profile_image'];
                    $user->tmpName = $_FILES['profile_image']['tmp_name'];
                    $user->image = $_FILES['profile_image']['name'];
                }
                $user->update_user_info();
            }
        }


        ?>
        <?php if ($user->message['status'] == 1) {
            echo "  <div id='hide' class='col-lg-9'>
            <p class='alert alert-success'>" . $user->message['msg'] . "</p>
        </div>";
        } else {
            echo "  <div id='hide'>
            <p class='alert alert-danger'>" . $user->message['msg'] . "</p>
        </div>";
        } ?>

        <?php
        $res = $user->find_by_id($user->id);
        ?>
        <form action="" class="form-group" method="post" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="first_name">First Name : </label>
                <input typeof="text" name="first_name" id="first_name"
                       class="form-control" value="<?= $res->first_name ?>">
                <label for="last_name">Last Name :</label>
                <input type="text" name="last_name" id="last_name" class="form-control"
                       value="<?= $res->last_name ?>">
                <label for="username">Username : </label>
                <input type="text" id="username" name="username" class="form-control" required
                       value="<?= $res->username ?>">
                <label for="email">Email address :</label>
                <input type="email" id="email" name="email" class="form-control" required
                       value="<?= $res->email ?>">
                <label for="confirm_email">Confirm email address :</label>
                <input type="email" id="confirm_email" name="confirm_email" class="form-control" required>
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" class="form-control" required
                       value="<?= $res->password ?>">
                <br>
                <!-- An element to toggle between password visibility -->
                <label for="show_password">Show Password</label>
                <input type="checkbox" onclick="myFunction()" id="show_password">
                <br>
                <label for="confirm_password">Confirm Password :</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                <br>
                <?php $image = ( !empty($res->image) ) ? '/admin/images/profile/' . $res->image : '/admin/images/profile/no_image.png'; ?>
                <?php if (file_exists($image)) {
                    $image = '/admin/images/profile/' . $res->image;
                } else {
//                    $image = $image = '/admin/images/' . $res->image;
                } ?>
            </div>
            <div class="col-md-3 user_image_box">
                <a href="" data-toggle="modal" data-target="#photo-library"><img src="<?= $image ?>" alt=""
                                                                                 class="thumbnail"
                                                                                 style="width: 640px;height: 380px;"></a>
                <label for="profile_image">Profile image : </label>
                <input type="file" id="profile_image" name="profile_image" class="form-control" alt="profile-image">
                <br>
                <input class="btn btn-warning btn-lg" id="submit" type="submit" value="Update" name="submit">
                <a href="../admin/users.php" class="btn-lg btn btn-danger">Cancel</a>
                <a href="delete_user.php?id=<?php echo $user->id ?>" id="user-id" class="btn-lg btn
                btn-danger">Delete</a>
            </div>


        </form>

    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<!-- /#page-wrapper -->

<?php include( "../admin/includes/footer.php" ); ?>
<script>

    function myFunction() {
        const x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>