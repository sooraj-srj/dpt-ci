
<style type="text/css">
    #cke_1_contents{
        height: 700px !important;
    }
    #content_ifr{
        height: 628px !important;
    }
</style>
<div class="content-wrapper" style="min-height: 946px !important;">
    <section class="content-header">
        <h1> Edit Page Contents</h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>            
            <li class="breadcrumb-item active">Edit contents </li>
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
                    <form role="form" method="POST" action="<?php url('admin/content-appln'); ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label><?php echo $content_name; ?></label>
                            <textarea class="form-control textarea" name="content" placeholder=""><?php echo $content; ?></textarea>                                            
                        </div>
                        <div class="box-footer">
                            <?php if(!empty($flag)) { ?>
                            <input type="hidden" name="flag" value="<?php echo $flag; ?>">                            
                            <?php } ?>
                            
                            <button type="submit" class="btn btn-info pull-right">Update Contents</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

