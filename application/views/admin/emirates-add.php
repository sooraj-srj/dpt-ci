
<div class="content-wrapper" style="min-height: 946px !important;">
    <section class="content-header">
        <h1> <?php if(!empty($edata)){ echo 'Edit Emirates';}  else { echo 'Add Emirates';} ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>
            <li><a href="<?php url('admin/emirates');?>">List emirates </a></li>
            <li class="breadcrumb-item active"><?php if(!empty($edata)){ echo 'Edit Emirates'; } else {  echo 'Add Emirates'; } ?></li>
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
                    <form role="form" method="POST" action="<?php if(!empty($edata)) {$mode = 'edit';} else {$mode = 'add';} url('admin/emirates/'.$mode); ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Emirates Name <span class="error">*</span>: </label>
                            <input type="text" value="<?php echo $edata['name'] ?>"  class="form-control" name="name" placeholder="Emirates name">                                            
                        </div>
                        
                        <div class="form-group">
                            <label> Image: </label>
                            <input type="file" class="form-control" name="image" placeholder="Emirates Image">
                                           
                            <?php if(!empty($edata['image'])) { ?>
                            <img src="<?php echo_image('images/emirates/'.$edata['image']) ?>" class="img-responsive" width="250">
                            <?php } ?>
                        </div>
                        
                        <div class="box-footer">
                            <?php if(!empty($edata)) { ?>
                            <input type="hidden" name="id" value="<?php echo $edata['id']; ?>">
                            <input type="hidden" name="image_name" value="<?php echo $edata['image']; ?>">
                            <input type="hidden" name="mode" value="edit">
                            <?php } else { ?>
                            <input type="hidden" name="mode" value="add">
                            <?php } ?>
                            <button type="submit" class="btn btn-info pull-right"><?php if(!empty($edata)) { ?> Edit Emirates <?php } else { ?> Create Emirates <?php } ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

