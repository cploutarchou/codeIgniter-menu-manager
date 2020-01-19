<?php
declare( strict_types=1 );
include( "../admin/includes/header.php" ); ?>
<?php if (!$session->is_logged_in()) {
    redirect("login.php");
} ?>

<?php

if (empty($_GET['id'])) {
    redirect('/admin/photos.php');
} else {
    $photo = $photo->find_by_id($_GET['id']);
//    echo "<pre>";var_dump($photo);die();
}

if (isset($_POST['update'])) {
    if ($photo) {
        $photo->title = $_POST['title'];
        $photo->caption = $_POST['caption'];
        $photo->alt = $_POST['alt'];
        $photo->description = $_POST['description'];
        $photo->save_photo();
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
        <a class="navbar-brand" href="/">SB Admin</a>
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
                    Photos Page :
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="#">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
            </div>
        </div>
        <form action="" method="post" name="edit_photo">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="title">Title : </label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= $photo->title ?>">
                    <br>
                    <p class="thumbnail">
                        <img src="<?= UPLOAD_FOLDER . $photo->filename ?>" alt="<?= $photo->alt ?>"
                             style="width:375px;">
                    </p>
                    <label for="caption">Caption : </label>
                    <input type="text" name="caption" id="caption" class="form-control" value="<?= $photo->caption ?>">
                    <label for="alt">Alternate Text : </label>
                    <input type="text" name="alt" id="alt" class="form-control" value="<?= $photo->alt ?>">
                    <label for="description">Description </label>
                    <textarea name="description" id="description" class="form-control" cols="30"
                              rows="10"><?= $photo->description ?></textarea>
                </div>
            </div>

            <div class="col-md-4">
                <div class="photo-info-box">
                    <div class="info-box-header">
                        <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                    </div>
                    <div class="inside">
                        <div class="box-inner">

                            <p class="text">
                                <span class="glyphicon glyphicon-calendar"></span> Uploaded on:
                                <?= date('d/m/YY H:i a', strtotime($photo->uploaded_on)) ?>
                            </p>
                            <p class="text ">
                                Photo Id: <span class="data photo_id_box"><?= $photo->id ?></span>
                            </p>
                            <p class="text">
                                Filename: <span class="data"><?= $photo->filename ?></span>
                            </p>
                            <p class="text">
                                File Type: <span class="data"><?= $photo->type ?></span>
                            </p>
                            <p class="text">
                                File Size: <span
                                        class="data"><?= convert_bytes_to_any(floatval($photo->size)) ?></span>
                            </p>
                        </div>
                        <div class="info-box-footer clearfix">
                            <div class="info-box-delete pull-left">
                                <a href="/admin/delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger
                                btn-lg
">Delete</a>
                            </div>
                            <div class="info-box-update pull-right ">
                                <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include( "../admin/includes/footer.php" ); ?>
<script>

    $(document).ready(function () {
        $('#description').summernote();
    });
</script>