
<div class="content-wrapper" style="min-height: 946px !important;">
    <section class="content-header">
        <h1> Edit Menu</h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>
            <li><a href="<?php url('admin/menu');?>">List Menu </a></li>
            <li class="breadcrumb-item active">Edit menu</li>
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
                    <form role="form" method="POST" action="<?php url('admin/menu/edit'); ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Menu Name <span class="error">*</span>: </label>
                            <input type="text" value="<?php echo $mdata['menu_name'] ?>"  class="form-control" name="menu_name" placeholder="Menu name">                                            
                        </div>
                        <div class="box-footer">
                            <?php if(!empty($mdata)) { ?>
                            <input type="hidden" name="id" value="<?php echo $mdata['id']; ?>">                            
                            <input type="hidden" name="mode" value="edit">
                            <?php } ?>
                            
                            <button type="submit" class="btn btn-info pull-right">Edit Menu</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

