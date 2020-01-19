<?php
declare( strict_types=1 );
include( "../admin/includes/header.php" ); ?>
<?php if (!$session->is_logged_in()) {
    redirect("login.php");
}

if (empty($_GET['photo_id'])) {
    redirect('/admin/commments.php');
}
$photo_id = trim($_GET['photo_id']);
$res = Comment::get_comments_by_photo_id($photo_id);


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
                    Photo Comments :
                    <small>Photo ID <?= $photo_id ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="/admin/index.php">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="/admin/comments.php">Comments</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Photo Comments
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
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                    <th>Submitted Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <?php


                    if ( is_array($res) || is_object($res) ){
                    ?>
                    <?php foreach ( $res

                    as $comment ) : ?>
                    <td><?= $comment->id ?></td>
                    <td><?= $comment->author ?></td>
                    <td><?= $comment->email ?></td>
                    <td><?= $comment->body ?></td>
                    <td><?= date('d-m-Y H:i a', strtotime($comment->submitted_date)) ?></td>
                    <td>Future Update</td>
                    <td>
                        <button><span class="fa fa-remove"
                                      onclick="delete_response(<?= $comment->id ?>)"
                                      style="color: red;
"></span></button>&ensp;
                        <a href="edit_user.php?id=<?= $comment->id ?>"><span class="fa fa-edit" style="color: gray;
"></span></a>&ensp;
                        <a href="/admin/photo_comments.php?photo_id=<?= $comment->photo_id ?>"><span class="fa fa-eye"
                                                                                                     style="color:
                        gray;
"></span></a>&ensp;
                    </td>

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
<script type="text/javascript">

    function delete_response(id) {
        $("#spinner").show();
        $.ajax({
            url: "/admin/delete_comment.php",
            type: "POST",
            data: {id: id},
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == 1) {
                    $("#spinner").hide();
                    swal("Success", response.msg, "success");
                    window.location.href = "/admin/comments.php";
                } else {
                    swal("Error", response.msg, "error");
                }
            }
        });
    }
</script>