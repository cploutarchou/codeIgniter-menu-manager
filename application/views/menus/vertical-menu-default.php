<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php $menu = get_main_menu($group_id); ?>
            <nav class="navbar <?php if ($style == '' || $style == 'default') {
                echo 'navbar-default';
            } else if ($style == 'black') {
                echo 'navbar-inverse';
            } ?>" role="navigation">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" target="_blank">CI-Menu Manager</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php for ($i = 0; $i < count($menu->main_menu, true); $i++) { ?>
                            <?php if (count($menu->main_menu[$i]->parent_menu, true) == 0): ?>
                                <li class=""><a
                                            href="<?php echo base_url() . $menu->main_menu[$i]->url ?>">
                                        <?php echo
                                        $menu->main_menu[$i]->title ?></a></li>
                            <?php else: ?>
                                <li class="dropdown">
                                    <a href="<?php echo base_url() . $menu->main_menu[$i]->url ?>"
                                       class="dropdown-toggle"
                                       data-toggle="dropdown"><?php
                                        echo $menu->main_menu[$i]->title ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php for ($b = 0; $b < count($menu->main_menu[$i]->parent_menu, true); $b++):
                                            if (!isset($menu->main_menu[$i]->parent_menu[$b]->parent_submenu)): ?>
                                                <li><a href="#"><?php echo
                                                        $menu->main_menu[$i]->parent_menu[$b]->title ?></a></li>
                                            <?php else: ?>
                                                <li class="dropdown dropdown-submenu"><a href="<?php echo base_url() .
                                                        $menu->main_menu[$i]->parent_menu[$b]->url ?>"
                                                                                         class="dropdown-toggle"
                                                                                         data-toggle="dropdown"><?php echo
                                                        $menu->main_menu[$i]->parent_menu[$b]->title ?></a>
                                                    <?php if (isset
                                                    ($menu->main_menu[$i]->parent_menu[$b]->parent_submenu)):
                                      ?>
                                                        <ul class="dropdown-menu">
                                                            <?php foreach
                                                            ($menu->main_menu[$i]->parent_menu[$b]->parent_submenu
                                                             as $par_sub) :

                                                              ?>
                                                                <li><a href="<?php echo
                                                                    $par_sub->url ?>"><?php echo
                                                                        $par_sub->title ?>
                                                                    </a></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>

                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>




