<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>CI - Easy Menu Manager</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <!-- Latest compiled and minified CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel='icon' href='<?php echo base_url() ?>favicon.ico' type='image/x-icon'>
    <!--[if lt IE 9]>
<!--    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <![endif]-->

    <script>
        const _BASE_URL = '<?php echo base_url(); ?>';
        let current_group_id = <?php if (!empty($group_id)) {
            echo $group_id;
        } ?>;
    </script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.mjs.nestedSortable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/menu.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
</head>

