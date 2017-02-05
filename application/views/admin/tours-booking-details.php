<style type="text/css">
    .box-new{
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.23) !important;
        /*background: #f7f7f7 !important;*/
    }
    .box-body{
        font-weight: normal !important;
    }
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px; !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Tour Bookings </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li><a href="<?php url('admin/tour-booking') ?>"> List Bookings </a></li>
                <li class="active">List Tours</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->
                    <?php
                        foreach ($booking_details as $bd) { }
                    ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">View booking details of <b><?php echo $bd['user_name']; ?><b></h3>                            
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php include('alert-message.php'); ?>
                                        
                                        <div class="col-md-5">
                                            <div class="box box-solid box-new">
                                            <div class="box-header with-border">
                                              <i class="fa fa-user"></i>
                                              <h3 class="box-title text-danger">Personal Details</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table">
                                                    <tr>
                                                        <td>Name: </td>
                                                        <td><?php echo $bd['user_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email: </td>
                                                        <td><?php echo $bd['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nationality: </td>
                                                        <td><?php echo $bd['country_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone: </td>
                                                        <td>
                                                            Cell No1: <?php echo $bd['countryCode1'].' '.$bd['cell_no1']; ?> <br>
                                                            Cell No2: <?php echo $bd['countryCode2'].' '.$bd['cell_no2']; ?> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Special Requests: </td>
                                                        <td><?php echo $bd['specialRequests']; ?></td>
                                                    </tr>
                                                    
                                                </table>

                                              
                                            </div>
                                            <!-- /.box-body -->
                                            </div>
                                        <!-- /.box -->
                                        </div>
                                        <div class="col-md-5">
                                            <div class="box box-solid box-new">
                                            <div class="box-header with-border">
                                              <i class="fa fa-bookmark"></i>
                                              <h3 class="box-title text-danger">Tour/Booking Details</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table">
                                                    <tr>
                                                        <td>Tour Date: </td>
                                                        <td><?php echo $bd['tour_date']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Preferred Pickup Time: </td>
                                                        <td><?php echo $bd['pref_pickup_time']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pickup Location: </td>
                                                        <td><?php echo $bd['pickup_location']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hotel Details(Pickup): </td>
                                                        <td>
                                                            <small>Name:</small> <?php echo $bd['hotelName']; ?><br>
                                                            <small>Address:</small> <?php echo $bd['hotelAddress']; ?><br>
                                                            <small>Phone:</small> <?php echo $bd['hotelPhoneNo']; ?><br>
                                                        </td>
                                                    </tr>     
                                                    <tr>
                                                        <td>Flight Details: </td>
                                                        <td>
                                                            <small>Flight Name:</small> <?php echo $bd['flightName']; ?><br>
                                                            <small>Terminal Name:</small> <?php echo $bd['terminalName']; ?><br>
                                                            <small>Flight Arrival:</small> <?php echo $bd['flightArrival']; ?><br>
                                                            <small>Flight Departure:</small> <?php echo $bd['flightDeparture']; ?><br>
                                                        </td>
                                                    </tr>                                                  
                                                    <tr>
                                                        <td>Drop Location: </td>
                                                        <td><?php echo $bd['drop_location']; ?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Hotel Details(Drop): </td>
                                                        <td>
                                                            <small>Name:</small> <?php echo $bd['endhotelName']; ?><br>
                                                            <small>Address:</small> <?php echo $bd['endhotelAddress']; ?><br>
                                                            <small>Phone:</small> <?php echo $bd['endhotelPhoneNo']; ?><br>
                                                        </td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <td>Pref.currency: </td>
                                                        <td><?php echo $bd['currencyCode']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payment Mode: </td>
                                                        <td><?php echo $bd['currencyMode']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Number of Person: </td>
                                                        <td><small>Adults:</small> <?php echo $bd['adultNo']; ?>, 
                                                        <small>Children:</small>, <?php echo $bd['childNo']; ?> 
                                                        <small>Infant:</small> <?php echo $bd['childNo']; ?></td>
                                                    </tr>
                                                    
                                                    
                                                </table>
                                              
                                            </div>
                                            <!-- /.box-body -->
                                            </div>
                                        <!-- /.box -->
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <?php if($bd['booking_status'] != 'approved'){  ?>
                                                <a href="<?php url('admin/booking-appln/'.$bd['booking_id']); ?>/confirm" onclick="return confirm('Are you sure you want to confirm this booking?')" class="btn btn-success">Confirm Booking</a><br><br>
                                                <a href="<?php url('admin/booking-appln/'.$bd['booking_id']); ?>/cancel" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel Booking</a>                                                 
                                            <?php } else { ?>
                                                <h3 class="text-success">Approved</h3>
                                            <?php } ?>
                                        </div>                                       

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

   
