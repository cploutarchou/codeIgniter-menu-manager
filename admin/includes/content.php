<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gallery Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="../../admin">Dashboard</a>
                    </li>
                </ol>
            </div>
        </div>
        <!--End Page Heading-->
        <!--Page Content Goes Here-->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $session->count ?></div>
                                <div>New Views</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-photo fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $photo->count_all() ?></div>
                                <div>Photos</div>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/photos.php" target="_blank">
                        <div class="panel-footer">
                            <span class="pull-left">Total Photos in Gallery</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $user->count_all(); ?>

                                </div>

                                <div>Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/users.php" target="_blank">
                        <div class="panel-footer">
                            <span class="pull-left">Total Users</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $comment->count_all() ?></div>
                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/comments.php" target="_blank">
                        <div class="panel-footer">
                            <span class="pull-left">Total Comments</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="piechart" style="width: 900px; height: 500px;" class="col-lg-6">
                </div>


            </div> <!--First Row-->
        </div>
    </div>


    <script type="text/javascript">


        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Views', <?= $session->count;?>],
                ['Comments', <?=$comment->count_all();?>],
                ['Users', <?=$user->count_all();?>], ['Photos', <?=$photo->count_all();?>]

            ]);

            var options = {
                legend: 'none',
                pieSliceText: 'label',
                title: 'Gallery Statistics',
                backgroundColor: 'transparent',
                is3D: true

            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }


    </script>
