<?php
/**
 * File : index.php
 * Created by PhpStorm
 * User: christos
 * Date: 2019-08-10
 * Time: 11:10
 * Copyright 2019, christos, All rights reserved
 */
declare( strict_types=1 );
include( "includes/header.php" );

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 20;
$items_total_count = $photo->count_all();
$pagination = new Pagination($page, $items_per_page, $items_total_count);

$query = "SELECT * FROM photos LIMIT {$items_per_page} OFFSET {$pagination->offset()}";
$photos = Photo::find_by_query_oop($query);

?>

<div class="container-fluid">
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-lg-10">

            <div class="thumbnail row">
                <?php foreach ($photos as $photo): ?>

                    <div class="col-xs-6 col-md-3">
                        <a href="photo_comment.php?id=<?= $photo->id ?>" class="thumbnail img-responsive">
                            <img src="/admin/images/<?= $photo->filename ?>" alt="<?= $photo->caption ?>"
                                 class="home_page_photo img-responsive">

                        </a>

                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg">
                        <?php
                        if ($pagination->total_pages() > 1) {
                            if ($pagination->has_previous()) {
                                $previous_page = $pagination->previous();
                                echo "<li class='previous'><a href='index.php?page=$previous_page'>Previous</a></li>";
                            }
                            ?>
                            <?php for ($i = 1; $i <= $pagination->total_pages(); $i++) {
                                if ($i == $pagination->current_page) {
                                    $active = "active";
                                } else {
                                    $active = ' ';
                                }
                                echo "<li class='$active' ><a href='index.php?page=$i'>$i</a ></li >";
                            }
                            ?>
                            <?
                            if ($pagination->has_next()) {
                                $next_page = $pagination->next();
                                echo "<li class='next' ><a href='index.php?page=$next_page' > Next</a ></li >";
                            }

                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-lg-2 col-md-2">

            <?php include( "includes/sidebar.php" ); ?>

        </div>
    </div>
    <!-- /.row -->

    <?php include( "includes/footer.php" ); ?>
