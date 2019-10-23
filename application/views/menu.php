<?php $this->load->view('header') ?>
<body>
<div id="wrapper">
    <header>
        <h1><a href="<?php echo site_url(); ?>">Easy Menu Manager</a></h1>
        <div id="link">
            <a class="button red" href="<?php echo base_url() ?>menu/sample" target="_blank">Preview
                Menu</a>
        </div>
    </header>
    <div id="content">
        <div id="main">
            <ul id="menu-group">
                <?php foreach ($menu_groups as $menu) : ?>
                    <li id="group-<?php echo $menu->id; ?>">
                        <a href="<?php echo site_url('menu/menu'); ?>/<?php echo $menu->id; ?>">
                            <?php echo $menu->title; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li id="add-group"><a href="<?php echo site_url('menugroup/add'); ?>" title="Add New Menu">+</a>
                </li>
            </ul>
            <div class="clear"></div>

            <form method="post" id="form-menu" action="<?php echo site_url('menu/save_position'); ?>">
                <div class="ns-row" id="ns-header">
                    <div class="ns-actions">Actions</div>
                    <div class="ns-class">Class</div>
                    <div class="ns-url">URL</div>
                    <div class="ns-title">Title</div>
                </div>
                <?php echo $menu_ul; ?>
                <div id="ns-footer">
                    <button type="submit" class="button green small" id="btn-save-menu">Save Menu</button>
                </div>
            </form>
        </div>
        <aside>
            <section class="box">
                <h2>Info</h2>
                <div>
                    <p>Drag the menu list to re-order, and click <b>Update Menu</b> to save the position.</p>
                    <p>To add a menu item, use the form below.</p>
                </div>
            </section>
            <section class="box">
                <h2>Current Menu</h2>
                <div>
                    <span id="edit-group-input"><?php echo $group_title->title; ?></span>
                    (ID: <b><?php echo $group_id; ?></b>)
                    <div>
                        <a id="edit-group" href="#">Edit</a>
                        <?php if ($group_id > 1) : ?>
                            &middot; <a id="delete-group" href="#">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <section class="box">
                <h2>Add To Menu</h2>
                <div>
                    <form id="form-add-menu" method="post" action="<?php echo site_url('menu/add'); ?>">
                        <p>
                            <label for="menu-title">Title</label>
                            <input type="text" name="title" id="menu-title">
                        </p>
                        <p>
                            <label for="menu-url">URL</label>
                            <input type="text" name="url" id="menu-url">
                        </p>
                        <p>
                            <label for="menu-class">Class</label>
                            <input type="text" name="class" id="menu-class">
                        </p>
                        <p class="buttons">
                            <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                            <button id="add-menu" type="submit" class="button green small">Add Menu Item</button>
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
</body>
</html>