
<div class="content-wrapper" style="min-height: 946px !important;">
    <section class="content-header">
        <h1> <?php if(!empty($gdata)){ echo 'Edit Gallery';}  else { echo 'Add Gallery';} ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>
            <li><a href="<?php url('admin/gallery');?>">List Gallery </a></li>
            <li class="breadcrumb-item active"><?php if(!empty($gdata)){ echo 'Edit Gallery'; } else {  echo 'Add Gallery'; } ?></li>
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
                    <form role="form" method="POST" action="<?php if(!empty($gdata)) {$mode = 'edit';} else {$mode = 'add';} url('admin/gallery/'.$mode); ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Gallery Name <span class="error">*</span>: </label>
                            <input type="text" value="<?php echo $gdata['title'] ?>"  class="form-control" name="title" placeholder="Gallery name">                                            
                        </div>
                        <div class="box-footer">
                            <?php if(!empty($gdata)) { ?>
                            <input type="hidden" name="id" value="<?php echo $gdata['id']; ?>">                            
                            <input type="hidden" name="mode" value="edit">
                            <?php } else { ?>
                            <input type="hidden" name="mode" value="add">
                            <?php } ?>
                            <button type="submit" class="btn btn-info pull-right"><?php if(!empty($gdata)) { ?> Edit Gallery <?php } else { ?> Create Gallery <?php } ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

