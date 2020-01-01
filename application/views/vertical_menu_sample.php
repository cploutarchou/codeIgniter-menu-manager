<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 3 Vertical Menu Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .dropdown-submenu{ position: relative; }
        .dropdown-submenu>.dropdown-menu{
            top:0;
            left:100%;
            margin-top:-6px;
            margin-left:-1px;
            -webkit-border-radius:0 6px 6px 6px;
            -moz-border-radius:0 6px 6px 6px;
            border-radius:0 6px 6px 6px;
        }
        .dropdown-submenu>a:after{
            display:block;
            content:" ";
            float:right;
            width:0;
            height:0;
            border-color:transparent;
            border-style:solid;
            border-width:5px 0 5px 5px;
            border-left-color:#cccccc;
            margin-top:5px;margin-right:-10px;
        }
        .dropdown-submenu:hover>a:after{
            border-left-color:#555;
        }
        .dropdown-submenu.pull-left{ float: none; }
        .dropdown-submenu.pull-left>.dropdown-menu{
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }

    </style>

<body>

<div class="jumbotron text-center">
    <h1>CI - Bootstrap 3 | Vertical Menu Manager</h1>
</div>

<div class="container">
    <div class="row">
        <?php get_menu('1', 'black'); ?>
<!--        --><?php //get_menu('1', ''); ?>
    </div>
</div>
<script>

    (function($){
        $(document).ready(function(){
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
            });
        });
    })(jQuery);

</script>
</body>
</html>

