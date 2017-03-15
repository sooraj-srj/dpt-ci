<style type="text/css">
    .item-resize{
        position: relative;
        width: 250px;
        height: 200px;
        overflow: hidden;
    }
    .crop-resize{
        position: absolute;
        left: 50%;
        top: 50%;
        /*width: 100%;*/
        /*height: auto;*/
        height: 100%;
        width: auto;
        -webkit-transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
    }
</style>
<div class="content-wrapper" style="min-height: 946px !important;">
    <section class="content-header">
        <h1> Manage Gallery Images</h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>
            <li><a href="<?php url('admin/gallery');?>">List Gallery </a></li>
            <li class="breadcrumb-item active">Manage gallery images</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">      
            <h3 class="box-title">Add/Remove gallery for <b><?php echo $gallery_data['title']; ?></b></h3>          
                <div class="form-group">
                    <?php include('alert-message.php'); ?>
                </div>
            </div>

            <div class="box-body">
                <div class="col-md-12">
                    <?php //p($gallery_images) ?>
                    <form action="<?php url('admin/upload'); ?>" class="dropzone">
                        <input type="hidden" name="gallery_id" value="<?php echo $gallery_data['id']; ?>">
                    </form>
                    <br>
                    <?php 
                    if(empty($gallery_images)){
                        echo '<div class="alert alert-warning">No images for '.$gallery_data['title'].'</div>';
                    }
                    foreach ($gallery_images as $images) {
                        ?>
                        <div class="col-md-3">
                            <div class="item-resize">
                                <img src="<?php echo_image('images/gallery/'.$images['file_name']); ?>" class="img-responsive thumbnail crop-resize">
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>

