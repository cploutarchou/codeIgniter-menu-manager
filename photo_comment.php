<?php
declare( strict_types=1 );
require_once( 'admin/includes/init.php' );

if (empty($_GET['id'])) {
    redirect('index.php');
}
$photo = $photo->find_by_id($_GET['id']);
$user = $user->find_by_id($photo->user_id);


if (isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $email = trim($_POST['email']);
    $body = $_POST['body'];

    $res = Comment::add_comment($photo->id, $author, $email, $body);

    if ($res && $res->save()) {
        redirect("photo_comment.php?id={$res->photo_id}");
    } else {
        $message = "There was some problem to save it";
    }

} else {
    $author = "";
    $email = "";
    $body = "";
}

$comments = Comment::get_comments_by_photo_id($_GET['id']);


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Start Bootstrap</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container-fluid">

    <div class="row">


        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?= $photo->title ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#"><?= $user->first_name . ' ' . $user->last_name ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?= date('d/m/Y h:i a', strtotime
                ($photo->uploaded_on)) ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="/admin/images/<?= $photo->filename ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead"><?= $photo->caption ?></p>
            <?= $photo->description ?>

            <hr>

            <!-- Blog Comments -->


            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="author">Author Name :</label>
                            <input id="author" name="author" class="form-control" type="text" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address : </label>
                            <input class="form-control" id="email" name="email" required type="email">
                        </div>
                        <label for="body">Comments :</label>
                        <textarea class="form-control" rows="3" id="body" name="body" required></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->


            <!-- Comment -->

            <?php if (!empty($comments)) { ?>
                <?php foreach ($comments as $blog_comments): ?>
                    <div class="media">

                        <a class="pull-left" href="#">
                            <img class="media-object" src="https://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?= $blog_comments->author; ?>
                                <small><?= date('d-m-Y h:i:s A', strtotime($blog_comments->submitted_date)); ?></small>
                            </h4>
                            <p><?php echo $blog_comments->body; ?></p>
                            <!-- Nested Comment -->
                            <div class="media" hidden>
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="https://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Nested Start Bootstrap
                                        <small>August 25, 2014 at 9:30 PM</small>
                                    </h4>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                    sollicitudin
                                    commodo. Cras purus odio, vestibulum in vulputate at, tempus
                                    viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                                    congue
                                    felis in faucibus.
                                </div>
                            </div>
                            <!-- End Nested Comment -->
                        </div>

                    </div>
                    <!--End Comment Section-->

                <?php endforeach; ?>

            <?php } ?>
        </div>


        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <div class="input-group">
                    <label>
                        <input type="text" class="form-control">
                    </label>
                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                </div>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="well">
                <h4>Side Widget Well</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus
                    laudantium odit aliquam repellat tempore quos aspernatur
                    vero.</p>
            </div>

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website <?= date("Y") ?></p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
