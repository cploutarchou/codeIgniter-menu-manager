<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Ver Display Sample - Easy Menu Manager</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/sample.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/menu.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $(function () {
            $('.vertical li:has(ul)').addClass('parent');
            $('.horizontal li:has(ul)').addClass('parent');
        });
    </script>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <h1>Easy Menu Manager</h1>
        <h2>Public Demonstration</h2>
        <h2 id="link"><a href="<?php echo base_url(); ?>">View Admin</a></h2>
    </div>

    <div id="main">

        <?php echo get_easymenu(2, 'class="vertical blue"'); ?>

    </div>

    <div id="footer">
        Easy Menu Manager
    </div>
</div>
</body>
</html>