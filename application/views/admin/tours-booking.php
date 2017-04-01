<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px; !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Tour Bookings </h1>
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
                            <h3 class="box-title">List all tour bookings</h3>                            
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-inline">
                                      <div class="form-group">
                                        <label for="email">Booking Date</label>
                                        <input type="text" class="form-control" id="booking_date" name="td">
                                      </div>                                      
                                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php include('alert-message.php'); ?>
                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="index">#</th>
                                                <th>TourName</th>   
                                                <th>Emirates</th>
                                                <th>BookedBy</th>
                                                <th>BookingDate </th>
                                                <th>TourDate</th>                                                
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $i=1;
                                                foreach ($tour_bookings as $index=> $tb) { 
                                                    if($tb['tour_id'] != 0) {
                                                ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php $tour['id'] ?>"><?php echo $i++; ?></td>
                                                    <td><?php echo $tb['title']; ?></td>
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
                                                        <a href="<?php url('admin/tour-booking/'.$tb['booking_id']);  ?>" class="label label-info" data-id="<?php echo $tb['booking_id'] ?>">Review and Confirm</a>
                                                    </td>                                                    

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

   
