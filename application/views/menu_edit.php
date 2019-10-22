<h2>Edit Menu Item</h2>
<form method="post" action="<?php echo site_url('menu_controller/save'); ?>">
    <p>
        <label for="edit-menu-title">Title</label>
        <input type="text" name="title" id="edit-menu-title" value="<?php echo $row->title; ?>">
    </p>
    <p>
        <label for="edit-menu-url">URL</label>
        <input type="text" name="url" id="edit-menu-url" value="<?php echo $row->url; ?>">
    </p>
    <p>
        <label for="edit-menu-class">Class</label>
        <input type="text" name="class" id="edit-menu-class" value="<?php echo $row->class; ?>">
    </p>
    <?php if ($row->parent_id == 0) : //only top level menu can be moved ?>
        <p>
            <label for="select_group_id">Group</label>
            <select name="group_id">
                <?php foreach ($menu_groups as $group): ?>
                    <option value="<?php echo $group->id; ?>" <?php if ($group->id == $row->group_id) {
                echo 'selected';
            } ?>><?php echo $group->title; ?></option>
    <?php endforeach;
    ?>

            </select>
        </p>
        <input type="hidden" name="old_group_id" value="<?php echo $row->group_id; ?>">
<?php endif; ?>
    <input type="hidden" name="menu_id" value="<?php echo $row->id; ?>">
</form>