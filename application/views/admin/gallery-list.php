<style type="text/css">
    .thumbnail{
        margin-bottom: 0px !important;
    }
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Galleries </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li class="active">List galleries</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List all categories</h3>
                            <div class="btn-group pull-right">                                
                                <a class="btn btn-info" href="<?php url('admin/gallery-images'); ?>"><i class="fa fa-plus-circle"></i> Add new gallery</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php include('alert-message.php'); ?>
                                        
                                        <?php 
                                        foreach ($categories as $cat) {
                                            ?>
                                            <h3><?php echo $cat['title'] ?></h3>
                                            <div class="row">
                                            <?php 
                                                $gallery = get_gallery_images($cat['id']); 
                                                foreach ($gallery as $gal) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="item-resize">
                                                            <img src="<?php echo_image('images/gallery/'.$gal['image_file']); ?>" class="thumbnail" width="200" height="123">
                                                            <a href="<?php url('admin/image-delete/'.$gal['id']) ?>" class="text-danger pull-right" onclick="return confirm('Are you sure you want to remove this image?')">Romove</a>
                                                        </div>

                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                            </div>
                                            <div class="clearfix"></div>                                            
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
