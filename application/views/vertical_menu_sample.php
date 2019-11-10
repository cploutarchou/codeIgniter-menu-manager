<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 3 Vertical Menu Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
</style>

<body>

<div class="jumbotron text-center">
    <h1>CI - Bootstrap 3 | Vertical Menu Manager</h1>
</div>

<div class="container">
    <div class="row">
        <?php get_menu('1', 'black'); ?>
        <?php get_menu('1', ''); ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.dropdown-submenu a.test').click( function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>
</body>
</html>

