<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage reviews </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li class="active">List reviews</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List all reviews</h3>
                            <div class="btn-group pull-right">                                
                                
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
                                                <th>Date</th>      
                                                <th>User Details</th>                                                   
                                                <th>Rating</th>                                                   
                                                <th>Comments</th>                                                   
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($reviews as $index=> $review) { ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php $review['id'] ?>"><?php echo $index+1; ?></td>
                                                    <td><?php echo $review['review_date'] ?></td>
                                                    <td class="sorting_1">
                                                        <b>Name:</b> <?php echo $review['name'] ?><br>
                                                        <b>Email:</b> <?php echo $review['email'] ?><br>
                                                        <b>Country:</b> <?php echo $review['country'] ?><br>

                                                    </td>
                                                    <td><?php echo $review['rating'] ?></td>
                                                    <td><?php echo $review['comments'] ?></td>
                                                    <td>
                                                        <a href="<?php url('admin/reviews/delete/'.$review['id']) ?>" class="text-primary" onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>  
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
