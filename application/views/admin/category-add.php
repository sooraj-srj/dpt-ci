<style type="text/css">
    #cke_1_template{
        height: 700px !important;
    }
    #template_ifr{
        height: 628px !important;
    }
</style>
<div class="content-wrapper" style="min-height: 946px !important;">
    <section class="content-header">
        <h1> <?php if(!empty($catdata)){ echo 'Edit Category';}  else { echo 'Add Category';} ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>
            <li><a href="<?php url('admin/categories');?>">List categories </a></li>
            <li class="breadcrumb-item active"><?php if(!empty($catdata)){ echo 'Edit Category'; } else {  echo 'Add Category'; } ?></li>
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
                <div class="col-md-8 col-md-offset-2">
                    <form role="form" method="POST" action="<?php if(!empty($catdata)) {$mode = 'edit';} else {$mode = 'add';} url('admin/categories/'.$mode); ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Category Name <span class="error">*</span>: </label>
                            <input type="text" value="<?php echo $catdata['title'] ?>"  class="form-control" name="title" placeholder="Category name">                                            
                        </div>
                        <div class="form-group">
                            <label>Mail Template <span style="color: red;">(Please do not change {{user_name}} these flags)</span></label>
                            <textarea class="form-control textarea" name="template" placeholder=""><?php echo $catdata['template']; ?></textarea>                                            
                        </div>
                        
                        <div class="form-group">
                            <label>Header Image: </label>
                            <input type="file" class="form-control" name="header_image" placeholder="Category Image">
                                           
                            <?php if(!empty($listcat['header_image'])) { ?>
                            <img src="<?php echo_image('images/categories/'.$listcat['header_image']) ?>" class="img-responsive" width="250">
                            <?php } ?>
                        </div>
                        
                        <div class="box-footer">
                            <?php if(!empty($catdata)) { ?>
                            <input type="hidden" name="id" value="<?php echo $catdata['id']; ?>">
                            <input type="hidden" name="image_name" value="<?php echo $catdata['header_image']; ?>">
                            <input type="hidden" name="mode" value="edit">
                            <?php } else { ?>
                            <input type="hidden" name="mode" value="add">
                            <?php } ?>
                            <button type="submit" class="btn btn-info pull-right"><?php if(!empty($catdata)) { ?> Edit Category <?php } else { ?> Create Category <?php } ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

