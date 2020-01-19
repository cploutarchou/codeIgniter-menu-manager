<?php
declare( strict_types=1 );
require_once '../admin/includes/init.php';
$photos = Photo::find_all_oop();
?>
<!--Start Modal-->

<div class="modal fade" id="photo-library">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Gallery System Library</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-9">
                    <div class="thumbnails row">

                        <?php foreach ($photos as $photo) { ?>

                            <div class="col-xs-2">
                                <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnail">
                                    <img alt="<?= $photo->alt ?>" class="modal_thumbnails img-responsive photo_id" src="
                                ../admin/images/<?= $photo->filename ?>" data="<?= $photo->id ?>">
                                </a>
                            </div>

                        <?php } ?>

                    </div>
                </div><!--col-md-9 -->

                <div class="col-md-3">
                    <div id="modal_sidebar" class="container"></div>
                </div>

            </div><!--Modal Body-->
            <div class="modal-footer">
                <div class="row">
                    <!--Closes Modal-->
                    <button id="set_user_image" type="button" class="btn btn-primary" disabled
                            data-dismiss="modal">Apply Selection
                    </button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--    End Modal-->
