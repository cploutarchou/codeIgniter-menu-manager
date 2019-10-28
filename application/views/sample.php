
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Menu Display Sample - Easy Menu Manager</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/sample.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/menu.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <h1>Easy Menu Manager</h1><h2>Public Demonstration</h2>
                <h2 id="link"><a href="<?php echo base_url(); ?>">View Admin</a></h2>
            </div>

            <div id="main">

                <h3>Example 1</h3>
                Showing menu with ID = 1
                <pre>echo get_easymenu(1);</pre>
                <h4>Output:</h4>
                <?php $menu = get_easymenu(1);
                echo $menu; ?>

                <h3>Example 2</h3>
                Showing menu with ID = 1 and class = horizontal
                <pre>
echo get_easymenu(1, 'class="horizontal white"');
echo get_easymenu(1, 'class="horizontal black"');
echo get_easymenu(1, 'class="horizontal red"');
echo get_easymenu(1, 'class="horizontal green"');
echo get_easymenu(1, 'class="horizontal blue"');
                </pre>
                <h4>Output:</h4>
                <?php $menu = get_easymenu(1, 'class="horizontal white"');
                echo $menu; ?>
                <div class="clear"></div>
                <?php $menu = get_easymenu(1, 'class="horizontal black"');
                echo $menu; ?>
                <div class="clear"></div>
                <?php $menu = get_easymenu(1, 'class="horizontal red"');
                echo $menu; ?>
                <div class="clear"></div>
                <?php $menu = get_easymenu(1, 'class="horizontal green"');
                echo $menu; ?>
                <div class="clear"></div>
                    <?php $menu = get_easymenu(1, 'class="horizontal blue"');
                    echo $menu; ?>
                <div class="clear"></div>

                <h3>Example 3</h3>
                Showing menu with ID = 2 and class = vertical
                <pre>
echo get_easymenu(2, 'class="vertical white"');
echo get_easymenu(2, 'class="vertical black"');
echo get_easymenu(2, 'class="vertical red"');
echo get_easymenu(2, 'class="vertical green"');
echo get_easymenu(2, 'class="vertical blue"');
                </pre>
                <h4>Output:</h4>
                <?php echo get_easymenu(2, 'class="vertical white"'); ?>
                <?php echo get_easymenu(2, 'class="vertical black"'); ?>
                <?php echo get_easymenu(2, 'class="vertical red"'); ?>
                <?php echo get_easymenu(2, 'class="vertical green"'); ?>
                <?php echo get_easymenu(2, 'class="vertical blue"'); ?>

            </div>

            <div id="footer">
                Easy Menu Manager
            </div>
        </div>
    </body>
</html>