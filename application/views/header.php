<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>CI - Easy Menu Manager</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!--[if lt IE 9]>
<!--    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <![endif]-->

    <script>
        var _BASE_URL = '<?php echo base_url(); ?>';
        var current_group_id = <?php if (!empty($group_id)) {
            echo $group_id;
        } ?>;
    </script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.mjs.nestedSortable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/menu.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="../../assets/js/bootstrap.min.js"></script>
</head>

