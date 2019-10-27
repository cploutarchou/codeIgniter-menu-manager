<?php $this->load->view('header') ?>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="row">
                <div class="col-md-12">
                    <header>
                        <h1 class="top-header-text">CI - Easy Menu Manager</h1>

                        <div id="link">
                            <!--                            <a class="btn btn-primary" href="-->
                            <?php //echo base_url() ?><!--menu/sample" target="_blank">Preview-->
                            <!--                                Menu</a>-->
                        </div>
                    </header>
                </div>
                <div id="col-md-12">
                    <div id="main" class="col-md-9">
                        <ul id="menu-group">
                            <?php foreach ($menu_groups as $menu) : ?>
                                <li id="group-<?php echo $menu->id; ?>">
                                    <a href="<?php echo site_url('menu/menu'); ?>/<?php echo $menu->id; ?>">
                                        <?php echo $menu->title; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li id="add-group"><a href="<?php echo site_url('menugroup/add'); ?>"
                                                  title="Add New Menu">+</a>
                            </li>
                        </ul>
                        <div class="clear"></div>

                        <form method="post" id="form-menu" action="<?php echo site_url('menu/save_position'); ?>">
                            <div class="ns-row" id="ns-header">
                                <div class="actions">Actions</div>
                                <div class="ns-url">URL</div>
                                <div class="ns-title">Title</div>
                            </div>
                            <?php echo $menu_ul; ?>
                            <div id="ns-footer">
                                <button type="submit" class="btn btn-default btn-success" id="btn-save-menu">Save
                                    Menu
                                </button>
                            </div>
                            <br>
                        </form>
                    </div>
                    <aside class="col-md-3 col-sm-12">
                        <section class="box">
                            <h2>Info</h2>
                            <div>
                                <p>Drag the menu list to re-order, </p>
                                <p>Click <b>Update Menu</b> to save the
                                    position.
                                </p>
                                <p>To add item on menu, use form below.</p>
                            </div>
                        </section>
                        <section class="box">
                            <h2>Current Menu</h2>
                            <div>
                                <span id="edit-group-input"><?php echo $group_title->title; ?></span>
                                (ID: <b><?php echo $group_id; ?></b>)
                                <div class="edit-group-buttons">
                                    <a id="edit-group" href="#" title="Edit Menu"><span class="btn btn-primary"
                                                                                        style="color: #ffffff">Edit</span></a>
                                    <?php if ($group_id > 1) : ?>
                                        <a id="delete-group" href="#"><span class="btn btn-danger"
                                                                            style="color:
                                                                                     #ffffff">Delete</span></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </section>
                        <section class="box">
                            <h2>Add To Menu</h2>
                            <div>
                                <form id="form-add-menu" method="post" action="<?php echo site_url('menu/add'); ?>">
                                    <div class="form-group">
                                        <label for="menu-title">Title</label>
                                        <input style="width: 100% !important;" type="text" name="title" required
                                               id="menu-title"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="menu-url">URL</label>
                                        <input type="text" name="url" id="menu-url" class="form-control" required
                                               style="width: 100% !important;">
                                    </div>
                                    <div class="form-group">
                                        <label for="menu-class">Class</label>
                                        <input type="text" name="class" id="menu-class" class="form-control"
                                               style="width: 100% !important;">
                                    </div>
                                    <p class="buttons">
                                        <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                        <button id="add-menu" type="submit" class="btn btn-success ">Add Menu Item
                                        </button>
                                    </p>
                                </form>
                            </div>
                        </section>
                    </aside>
                    <div class="clear"></div>


                </div>
                <?php $this->load->view('footer') ?>
            </div>
            <div id="loading">
                <img src="<?php echo base_url(); ?>assets/images/ajax-loader.gif" alt="Loading">
                Processing...
            </div>
        </div>
    </div>
</div>
</body>