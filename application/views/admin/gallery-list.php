<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Galleries </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li class="active">List galleries</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List all categories</h3>
                            <div class="btn-group pull-right">                                
                                <a class="btn btn-info" href="<?php url('admin/gallery/add'); ?>"><i class="fa fa-plus-circle"></i> Add new gallery</a>
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
                                                <th>Gallery Name</th>   
                                                <th>Gallery Images</th>   
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($gallery as $index=> $gal) { ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php $gal['id'] ?>"><?php echo $index+1; ?></td>
                                                    <td class="sorting_1"><?php echo $gal['title']; ?></td>
                                                    <td><a href="<?php url('admin/gallery-images/'.$gal['id']) ?>" class="label label-info"><i class="fa fa-upload"></i> Upload Images</a></td>                         
                                                    <td>
                                                        <a href="<?php url('admin/gallery/edit/'.$gal['id']) ?>" class="text-primary">Edit</a>  &nbsp;&nbsp;
                                                        <a href="<?php url('admin/gallery/delete/'.$gal['id']) ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this gallery?')">Delete</a>
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
    
    <!-- sub-category model template -->
    <div class="modal fade" id="subcategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Sub-categories</h4>
                </div>
                <div class="modal-body" id="subcategoryContents">

                </div>
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- sub-category model template -->

