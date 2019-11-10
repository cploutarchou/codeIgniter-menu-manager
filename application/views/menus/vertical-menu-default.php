
<?php $menu = get_main_menu($group_id); ?>
<nav class="navbar <?php if ($style==''||$style=='default') {
    echo 'navbar-default';
}else if ($style=='black'){
    echo  'navbar-inverse';
}?>">
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
