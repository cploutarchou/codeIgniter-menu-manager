<?php
declare( strict_types=1 );
include( "../admin/includes/header.php" ); ?>
<?php if (!$session->is_logged_in()) {
    redirect("login.php");
} ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">SB Admin</a>
    </div>
    <!-- Top Menu Items -->
    <?php include "../admin/includes/navigation/top_nav.php" ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "../admin/includes/navigation/sidebar_nav.php" ?>
    <!-- /.navbar-collapse -->
</nav>
<?php
$message = "";
if (isset($_POST['submit'])) {

    $photo->title = $_POST['title'];
    $photo->description = $_POST['description'];
    $photo->user_id = $_SESSION['user_id'];

//    echo "<pre>";
//    echo print_r($_FILES['file_upload'], TRUE);
//    echo "<br>";
//    echo "</pre>";

    if ($_FILES['file_upload']) {

        if ($photo->set_file($_FILES['file_upload'])) {
            $photo->save_photo();
            $message = $photo->message;
        }
    } else {
        $message = $this->upload_errors[0];
    }
}
$message = "";
if (isset($_FILES['file'])) {

    $photo->title = $_POST['title'];
    $photo->description = $_POST['description'];
    $photo->user_id = $_SESSION['user_id'];

//    echo "<pre>";
//    echo print_r($_FILES['file_upload'], TRUE);
//    echo "<br>";
//    echo "</pre>";

    if ($_FILES['file']) {

        if ($photo->set_file($_FILES['file'])) {
            $photo->save_photo();
            $message = $photo->message;
        }
    } else {
        $message = $this->upload_errors[0];
    }
}
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Upload Photo
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="#">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Upload Photo
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="container-fluid ">
            <div class="col-sm-8 col-sm-offset-3 text-center" <?php if ($message != "") {
                echo $message;
            } else {
                echo "hidden";
            } ?>>
                <h3 class="alert alert-warning"><?php echo $message ?></h3>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="upload.php"
                          class="dropzone"
                          id="my-awesome-dropzone">


                    </form>
                    <div class="form-group" hidden>
                        <input type="file" name="file" class="btn btn-primary" style="width: 100%;">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <div class="well-lg">
                    <form action="upload.php" method="post" enctype="multipart/form-data">

                        <div class="form-group ">
                            <label for="title">Image Title:</label>
                            <input type="text" name="title" class="form-control" required id="title">
                        </div>

                        <div class="form-group ">
                            <label for="description">Description :</label>
                            <input type="text" name="description" class="form-control" id="description" required
                                   width="48" height="48">
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="file" name="file_upload" class="btn btn-primary" style="width: 100%;">
                        </div>
                        <input type="submit" name="submit" class="btn btn-default form-control" value="Upload">
                    </form>
                </div>

            </div>
        </div>

    </div>

    <!-- /.container-fluid -->
</div>


<!-- /#page-wrapper -->
<?php include( "../admin/includes/footer.php" ); ?>
