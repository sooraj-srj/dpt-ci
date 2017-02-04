
<div class="content-wrapper" style="min-height: 946px !important;">
    <section class="content-header">
        <h1> <?php if(!empty($tourdata)){ echo 'Edit Tour';}  else { echo 'Add Tour';} ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>
            <li><a href="<?php url('admin/tours');?>">List tours </a></li>
            <li class="breadcrumb-item active"><?php if(!empty($tourdata)){ echo 'Edit Tour'; } else {  echo 'Add Tour'; } ?></li>
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
                    <form role="form" method="POST" action="<?php if(!empty($tourdata)) {$mode = 'edit';} else {$mode = 'add';} url('admin/tours/'.$mode); ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Tour Name <span class="error">*</span> </label>
                            <input type="text" value="<?php echo $tourdata['title'] ?>"  class="form-control" name="title" placeholder="Tour name">                        
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Category <span class="error">*</span> </label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select category</option>
                                    <?php 
                                    foreach ($categories as $cat) {
                                        ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $tourdata['category_id']) echo 'selected'; ?>>
                                            <?php echo $cat['title']; ?>
                                        </option>
                                        <?php
                                    } 
                                    ?>
                                </select>                   
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Emirates <span class="error">*</span> </label>
                                <select name="emirates_id" class="form-control">
                                    <option value="">Select emirates</option>
                                    <?php 
                                    foreach ($emirates as $em) {
                                        ?>
                                        <option value="<?php echo $em['id']; ?>" <?php if($em['id'] == $tourdata['emirates_id']) echo 'selected'; ?>>
                                            <?php echo $em['name']; ?>
                                        </option>
                                        <?php
                                    } 
                                    ?>
                                </select>                      
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Intro</label>
                            <textarea name="intro" class="form-control" placeholder="Tour intro"><?php echo $tourdata['title'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tour Details <span class="error">*</span> </label>
                            <textarea name="body" class="form-control ckeditor" placeholder="Tour Details"><?php echo $tourdata['body'] ?></textarea>         
                        </div>
                        <div class="form-group">
                            <label>Mail Body (<small><i>This is the tour content for email template</i></small>) </label>
                            <textarea name="mail_body" class="form-control ckeditor" placeholder="Tour Mail Details"><?php echo $tourdata['mail_body'] ?></textarea>         
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Tour Price (AED) <span class="error">*</span> </label>
                                <input type="text" value="<?php echo $tourdata['price'] ?>"  class="form-control" name="price" placeholder="Tour Price">                        
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tour Price (USD) <span class="error">*</span> </label>
                                <input type="text" value="<?php echo $tourdata['usd_price'] ?>"  class="form-control" name="usd_price" placeholder="Tour Price(USD)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tour Duration <span class="error">*</span> </label>
                            <input type="text" value="<?php echo $tourdata['duration'] ?>"  class="form-control" name="duration" placeholder="Tour Duration">            
                        </div>         
                        <div class="form-group">
                            <label>Tour Image </label>
                            <input type="file" class="form-control" name="image" placeholder="Tour Image">   
                            <?php if(!empty($tourdata['image'])) { ?>
                            <br>
                            <img src="<?php echo_image('images/tours/'.$tourdata['image']) ?>" class="img-responsive" width="250">
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label>Tour Status <span class="error">*</span> </label>
                            <select class="form-control" name="status">
                                <option value="draft" <?php if($tourdata['status'] == 'draft') echo 'selected'; ?>>Draft</option>
                                <option value="live" <?php if($tourdata['status'] == 'live') echo 'selected'; ?>>Live</option>
                            </select>        
                        </div> 
                        
                        <div class="box-footer">
                            <?php if(!empty($tourdata)) { ?>
                            <input type="hidden" name="tour_id" value="<?php echo $tourdata['id']; ?>">
                            <input type="hidden" name="image_name" value="<?php echo $tourdata['image']; ?>">
                            <input type="hidden" name="mode" value="edit">
                            <?php } else { ?>
                            <input type="hidden" name="mode" value="add">
                            <?php } ?>
                            <button type="submit" class="btn btn-info pull-right"><?php if(!empty($tourdata)) { ?> Edit Tour <?php } else { ?> Create Tour <?php } ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

