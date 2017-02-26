<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px; !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Transfer Service Bookings </h1>
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
                            <h3 class="box-title">List all transfer service bookings</h3>                            
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
                                                <th>Emirates</th>
                                                <th>BookingFrom</th>
                                                <th>BookingDate </th>
                                                <th>TourDate</th>                                                
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                foreach ($tour_bookings as $index=> $tb) { 
                                                    if($tb['tour_id'] == 0) {
                                                ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php $tour['id'] ?>"><?php echo $index+1; ?></td>
                                                    <td><?php echo $tb['emirates']; ?></td>
                                                    <td>
                                                        <?php echo $tb['user_name']; ?> <small class="text-primary"><?php echo $tb['email']; ?></small> <br>
                                                        <small class="text-muted"><?php echo $tb['countryCode1'].' '.$tb['cell_no1']; ?></small>
                                                    </td>
                                                    <td><?php echo $tb['booking_date']; ?></td>
                                                    <td><?php echo $tb['tour_date']; ?></td>                                                    
                                                    <td>
                                                        <?php if($tb['booking_status'] == 'initiated') { ?>
                                                            <span class="label label-warning">Initiated</span>
                                                        <?php } else if ($tb['booking_status'] == 'approved') { ?>
                                                            <span class="label label-success">Approved</span>
                                                        <?php } else if ($tb['booking_status'] == 'cancelled') { ?>
                                                            <span class="label label-danger">Cancelled</span>
                                                        <?php } ?>
                                                        
                                                    </td>
                                                    <td>
                                                        <a href="<?php url('admin/transfer-service-booking/'.$tb['booking_id'].'?type=ts');  ?>" class="label label-info" data-id="<?php echo $tb['booking_id'] ?>">Review and Confirm</a>
                                                    </td>
                                                    <!-- <td>
                                                        <?php if($tb['booking_status'] == 'initiated') { ?>
                                                            <a class="label label-warning" title="Please approve this booking">APPROVE/CONFIRM</a>
                                                        <?php } else if ($tb['booking_status'] == 'approved') { ?>
                                                            <a class="label label-danger">CANCEL/REJECT</a>
                                                        <?php } ?>
                                                    </td> -->

                                                </tr>
                                            <?php
                                                    }
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

   
