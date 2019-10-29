<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>


<body>

<div class="jumbotron text-center">
    <h1>My First Bootstrap Page</h1>
    <p>Resize this responsive page to see the effect!</p>
</div>

<div class="container">
    <div class="row">

        <?php $menu = get_menu(1); ?>
        <pre>
<?php var_dump($menu->main_menu);die();?>
        </pre>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">CI-Menu Manager</a>
                </div>
                <ul class="nav navbar-nav">
                    <?php foreach ($menu->main_menu as $row): ?>
<!--                        --><?php //foreach ($menu->parent_menus as $submenu): ?>
                            <?php
                            $cat_title = $row->title;
                            $cat_id = $row->id;
                            $setID = (int)'';
                            if (!$_GET) {
                                $setID = 1;
                            } elseif (isset($_GET['cat'])) {
                                $setID = $_GET['cat'];
                            }

                            if ($cat_id == $setID) {
                                $active = 'active';
                            } elseif ($cat_id == $setID) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            ?>
                            <li class="<?php echo $active ?>"><a
                                        href="<?php echo base_url() . 'menu/vertical_sample?cat='
                                            . $cat_id ?>">
                                    <?php echo
                                    $cat_title ?></a></li>
<!--                        --><?php //if ($submenu->id==$row->id):?>
<!--                                                <li class="dropdown">-->
<!--                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1-->
<!--                                                        <span class="caret"></span></a>-->
<!--                                                    <ul class="dropdown-menu">-->
<!--                                                        <li><a href="#">--><?php //echo $submenu->title ?><!--></a></li>-->
<!---->
<!--                                                    </ul>-->
<!--                                                </li>-->

<!--                        --><?php //endif; ?>
<!--                        --><?php //endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
    </div>

</div>

</body>
</html>
