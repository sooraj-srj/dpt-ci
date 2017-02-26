<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Agents </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li class="active">List all agents</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List all agents</h3>
                            <div class="btn-group pull-right">                                
                                <a class="btn btn-info" href="<?php url('admin/agents/add'); ?>"><i class="fa fa-plus-circle"></i> Add new agent</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php include('alert-message.php'); ?>
                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="index">#</th>
                                                <th>Agent Name</th>   
                                                <th>Email</th>   
                                                <th>Phone Number</th>   
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($agents as $index=> $agent) { ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php $agent['id'] ?>"><?php echo $index+1; ?></td>
                                                    <td class="sorting_1"><?php echo $agent['name']; ?></td>
                                                    <td class="sorting_1"><?php echo $agent['email']; ?></td>
                                                    <td class="sorting_1"><?php echo $agent['phone']; ?></td>
                                                                         
                                                    <td>
                                                        <a href="<?php url('admin/agents/edit/'.$agent['id']) ?>" class="text-primary">Edit</a>  &nbsp;&nbsp;
                                                        <a href="<?php url('admin/agents/delete/'.$agent['id']) ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>

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
    
   