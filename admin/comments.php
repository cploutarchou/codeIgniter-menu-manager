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
                    Gallery Comments
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="/admin/index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Comments
                    </li>
                </ol>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom: 15px;">
            <a href="register.php" class="btn btn-default">Add new comment</a>
        </div>
        <div class="col-lg-12">
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo ID</th>
                    <th>No of Comments</th>
                    <th>Photo</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                    <th>Submitted Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <?php
                    $res = $database->find_any_query_oop("SELECT  c.*,p.filename FROM comments  as c LEFT JOIN photos p on c.photo_id = p.id GROUP BY photo_id ORDER BY c.submitted_date desc ");
                    if ( is_array($res) || is_object($res) ){
                    ?>
                    <?php foreach ( $res

                    as $comment ) {
                    $count = $database->find_any_query_oop("SELECT count(*) as count FROM comments where photo_id = $comment->photo_id");
                    ?>
                    <td><?= $comment->id ?></td>
                    <td><?= $comment->photo_id ?></td>
                    <td><?= $count[0]->count ?></td>
                    <td><img class="admin-photo-thumbnail" alt="" src="<?= $photo->picture_path() ?><?=
                        $comment->filename
                        ?>"></td>
                    <td><?= $comment->author ?></td>
                    <td><?= $comment->email ?></td>
                    <td><?= $comment->body ?></td>
                    <td><?= date('d-m-Y H:i a', strtotime($comment->submitted_date)) ?></td>
                    <td>
                        <a href="/admin/photo_comments.php?photo_id=<?= $comment->photo_id ?>"><span class="fa fa-eye"
                                                                                                     style="color:
                        gray;
"></span></a>&ensp;
                    </td>
                </tr>
                <?php }
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
