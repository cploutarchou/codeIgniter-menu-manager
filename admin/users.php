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
                    Gallery Users
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
        <div class="col-md-4" style="margin-bottom: 15px;">
            <a href="register.php" class="btn btn-default">Create New User</a>
        </div>
        <div class="col-lg-12">
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Register Date</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <?php
                    $res = $database->find_any_query_oop("SELECT * FROM users");

                    if ( is_array($res) || is_object($res) ){
                    ?>
                    <?php foreach ( $res

                    as $user ) : ?>
                    <?php if (!empty($user->image)) {
                        $image_check = '/admin/images/profile/' . $user->image;
                        if (file_exists($image_check)) {
                            $image = '/admin/images/profile/' . $user->image;
                        } else {
                            $image = $image = '/admin/images/' . $user->image;
                        }
                    } else {
                        $image = '/admin/images/profile/no_image.png';
                    }
                    ?>

                    <td><?= $user->id ?></td>
                    <td style="width: 165px;"><img src="<?= $image ?>" alt="" style="width: 165px;"
                                                   class="thumbnail"></td>
                    <td><?= $user->first_name ?></td>
                    <td><?= $user->last_name ?></td>
                    <td><?= date('d-m-Y H:i a', strtotime($user->register_date)) ?></td>
                    <td><?= $user->email ?></td>
                    <td><?php echo $user->status == 0 ? 'Inactive' : 'Active' ?></td>
                    <td>
                        <!--                        <a href="delete_user.php?id=-->
                        <? //= $user->id ?><!--"><span class="fa fa-remove"-->
                        <!--                                                                         style="color: red;"></span></a>-->
                        &ensp;
                        <button><span class="fa fa-remove"
                                      onclick="delete_response(<?= $user->id ?>)"
                                      style="color: red;
"></span></button>&ensp;
                        <a href="edit_user.php?id=<?= $user->id ?>"><span class="fa fa-edit" style="color: gray;
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
<script type="text/javascript">

    function delete_response(user_id) {
        $("#spinner").show();
        $.ajax({
            url: "/admin/delete_user.php",
            type: "POST",
            data: {id: user_id},
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status === 1) {
                    $("#spinner").hide();
                    swal("Success", response.msg, "success");
                    window.location.href = "/admin/users.php";
                } else {
                    swal("Error", response.msg, "error");
                }
            }
        });
    }
</script>