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

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gallery Photos
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="#">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Photos
                    </li>
                </ol>
            </div>
        </div>
        <div class="col-lg-12">
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>No Of Comments</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Filename</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <?php
                    $res = $database->find_any_query_oop("SELECT * FROM photos");

                    if ( is_array($res) || is_object($res) ){

                    //                        echo "<pre>"; var_dump($res,true);die();
                    ?>
                    <?php foreach ( $res

                    as $pho ) :

                    $count = $database->find_any_query_oop("SELECT count(*) as count FROM comments where photo_id = $pho->id"); ?>
                    <td><?= $pho->id ?></td>
                    <td><img class="admin-photo-thumbnail" alt="" src="<?= $photo->picture_path() ?><?=
                        $pho->filename
                        ?>"></td>
                    <td><?= $count[0]->count ?> <a href="/admin/photo_comments.php?photo_id=<?= $pho->id ?>"><span
                                class="fa fa-eye"
                                style="color:
                        gray;
"></span></a>&ensp;
                    </td>
                    <td><?= $pho->title ?></td>
                    <td><?= $pho->description ?></td>
                    <td><?= $pho->filename ?></td>
                    <td><?= $pho->type ?></td>
                    <td><?= convert_bytes_to_any(floatval($pho->size)) ?> </td>
                    <td>
                        <a href="delete_photo.php?id=<?= $pho->id ?>"><span class="fa fa-remove"
                                                                            style="color: red;
"></span></a>&ensp;
                        <a href="edit_photo.php?id=<?= $pho->id ?>"><span class="fa fa-edit" style="color: gray;
"></span></a>&ensp;
                        <a href="../photo_comment.php?id=<?= $pho->id ?>"><span class="fa fa-eye" style="color: gray;
"></span></a>&ensp;

                </tr>
                <?php endforeach;
                } ?>
                </tbody>
            </table>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include( "../admin/includes/footer.php" ); ?>
