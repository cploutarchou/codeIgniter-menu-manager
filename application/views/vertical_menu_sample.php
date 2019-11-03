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
    <h1>My First Bootstrap Page</h1>
    <p>Resize this responsive page to see the effect!</p>
</div>

<div class="container">
    <div class="row">

        <?php $menu = get_menu(1); ?>
        <!--        <pre>-->
        <!---->
        <!---->
        <!--           --><?php ////var_dump($menu->main_menu[2]->submenu[0]->sub[0]);
        //
        //            foreach ($menu->main_menu[2]->submenu as $sub){
        //                print_r($sub->sub);
        //            }
        //             ?>
        </pre>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">CI-Menu Manager</a>
                </div>
                <ul class="nav navbar-nav">

                    <?php for ($i = 0; $i <= $menu->count; $i++) { ?>
                        <?php if (!isset($menu->main_menu[$i]->submenu)): ?>
                            <li class="<?php ?>"><a
                                        href="<?php echo base_url() . 'menu/vertical_sample?cat='
                                            . $menu->main_menu[$i]->id ?>">
                                    <?php echo
                                    $menu->main_menu[$i]->title ?></a></li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php
                                    echo $menu->main_menu[$i]->title ?>
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php if (isset($menu->main_menu[$i]->submenu)): ?>
                                        <?php $s = 0;
                                        foreach ($menu->main_menu[$i]->submenu as $subSub): ?>
                                            <?php
//                                            var_dump($subSub->sub[$s]);

                                            if (count($subSub->sub[$s]) == -1): ?>
                                                <li><a href="#"><?php echo $subSub->title ?></a>
                                            <?php else: ?>

                                                <li class="dropdown-submenu">
                                                    <a class="test" href="#"><?php echo $subSub->title ?><span
                                                                class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <?php foreach ($subSub->sub[$s] as $subSubMen) { ?>
                                                            <li><a href="#"><?php echo $subSubMen->title ?></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                                <?php $s++;endif; ?>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </div>

</div>

</body>
</html>
<script>
    $(document).ready(function () {
        $('.dropdown-submenu a.test').on("click", function (e) {
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>
