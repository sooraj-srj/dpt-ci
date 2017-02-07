
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
            <div class="box-header">                
                <div class="form-group">
                    <?php include('alert-message.php'); ?>
                </div>
            </div>

            <div class="box-body">
                <div class="col-md-6 col-md-offset-3">
                    <?php p($gallery_images) ?>

                </div>
            </div>
        </div>
    </section>
</div>

