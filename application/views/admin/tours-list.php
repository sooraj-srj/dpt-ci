<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Tours </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li class="active">List Tours</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List all tours</h3>
                            <div class="btn-group pull-right">                                
                                <a class="btn btn-info" href="<?php url('admin/tours/add'); ?>"><i class="fa fa-plus-circle"></i> Add new tours</a>
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
                                                <th>Tour Name</th>   
                                                <th>Category</th>
                                                <th>Emirates</th>
                                                <th>Intro</th>
                                                <th>Details</th>
                                                <th>Price(AED)</th>
                                                <th>Price(USD)</th>
                                                <th>Duration</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($tours as $index=> $tour) { ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php $tour['id'] ?>"><?php echo $index+1; ?></td>
                                                    <td><?php echo $tour['title']; ?></td>
                                                    <td><?php echo $tour['category']; ?></td>
                                                    <td><?php echo $tour['emirates']; ?></td>
                                                    <td><?php echo $tour['intro']; ?></td>
                                                    <td><a href="javascrpt:;" class="label label-primary"><i class="fa fa-eye"></i> View</a></td>
                                                    <td><?php echo $tour['price']; ?></td>
                                                    <td><?php echo $tour['usd_price']; ?></td>
                                                    <td><?php echo $tour['duration']; ?></td>
                                                    <td>
                                                        <?php if(!empty($tour['image'])) { ?>
                                                            <img src="<?php echo_image('images/tours/'.$tour['image']) ?>" class="img-responsive" width="50">
                                                        <?php } else { ?> 
                                                            <small class="text-gray">No image</small>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php if($tour['status'] == 'draft') echo '<span class="label label-default">Draft</span>'; else if($tour['status'] == 'live') echo '<span class="label label-success">Live</span>'; ?></td>
                                                    <td>
                                                        <a href="<?php url('admin/tours/edit/'.$tour['tour_id']) ?>" class="text-primary" title="Edit">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>  &nbsp;
                                                        <a href="<?php url('admin/tours/delete/'.$tour['tour_id']) ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this emirates?')" title="Delete">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </a>
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
   
