
<div class="content-wrapper" style="min-height: 946px !important;">
    <section class="content-header">
        <h1> <?php if(!empty($agent_data)){ echo 'Edit Agent';}  else { echo 'Add Agent';} ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php url('admin'); ?>"><i class="fa fa-dashboard"></i> </a></li>
            <li><a href="<?php url('admin/agents');?>">List Agent </a></li>
            <li class="breadcrumb-item active"><?php if(!empty($agent_data)){ echo 'Edit Agent'; } else {  echo 'Add Agent'; } ?></li>
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
                    <form role="form" method="POST" action="<?php if(!empty($agent_data)) {$mode = 'edit';} else {$mode = 'add';} url('admin/agents/'.$mode); ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Agent Name <span class="error">*</span>: </label>
                            <input type="text" value="<?php echo $agent_data['name'] ?>"  class="form-control" name="name" placeholder="Agent name">
                        </div>
                        <div class="form-group">
                            <label>Email <span class="error">*</span>: </label>
                            <input type="text" value="<?php echo $agent_data['email'] ?>"  class="form-control" name="email" placeholder="Agent email">
                        </div>
                        <div class="form-group">
                            <label>Phone Number <span class="error">*</span>: </label>
                            <input type="text" value="<?php echo $agent_data['phone'] ?>"  class="form-control" name="phone" placeholder="Agent phone">
                        </div>
                        <div class="box-footer">
                            <?php if(!empty($agent_data)) { ?>
                            <input type="hidden" name="id" value="<?php echo $agent_data['id']; ?>">                            
                            <input type="hidden" name="mode" value="edit">
                            <?php } else { ?>
                            <input type="hidden" name="mode" value="add">
                            <?php } ?>
                            <button type="submit" class="btn btn-info pull-right"><?php if(!empty($agent_data)) { ?> Edit Agent <?php } else { ?> Create Agent <?php } ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>

