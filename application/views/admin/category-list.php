<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage tour categories </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li class="active">List categories</li>
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
                                <a class="btn btn-info" href="<?php url('admin/categories/add'); ?>"><i class="fa fa-plus-circle"></i> Add new category</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php include('alert-message.php'); ?>
                                        <table id="sort_order_list" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="index">#</th>
                                                <th>Category</th>   
                                                <th>Header Image</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($categories as $index=> $cat) { ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php echo $cat['id']; ?>" data-flag="category"><?php echo $index+1; ?></td>
                                                    <td class="sorting_1"><?php echo $cat['title']; ?></td>
                                                    <td class="sorting_1">
                                                        <?php if(!empty($cat['header_image'])) { ?>
                                                            <img src="<?php echo_image('images/category/'.$cat['header_image']) ?>" class="img-responsive" width="50">
                                                        <?php } else { ?> 
                                                            <small class="text-gray">No image</small>
                                                        <?php } ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <a href="<?php url('admin/categories/edit/'.$cat['id']) ?>" class="text-primary">Edit</a>  &nbsp;|&nbsp;
                                                        <a href="<?php url('admin/categories/delete/'.$cat['id']) ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
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

