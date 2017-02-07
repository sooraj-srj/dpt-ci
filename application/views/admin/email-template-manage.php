
<div class="content-wrapper" style="min-height: 946px; !important;">
    <section class="content-header">
        <h1> Manage Email Template</h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>        
            <li class="breadcrumb-item active">Update Booking Email</li>
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
                    <form role="form" method="POST" action="<?php url('admin/email-template'); ?>" enctype="multipart/form-data">

                        
                        <div class="form-group">
                            <label>Template Body <span class="error">*</span> </label>
                            <textarea name="body" class="form-control ckeditor" placeholder="Template Body"><?php echo $email_template['body'] ?></textarea>         
                        </div>
                                                
                        <div class="box-footer">
                            <input type="hidden" name="update_et" value="edit">
                            <button type="submit" class="btn btn-info pull-right">Update Template</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

