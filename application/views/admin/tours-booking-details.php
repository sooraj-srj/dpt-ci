<style type="text/css">
    .box-new{
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.23) !important;
        /*background: #f7f7f7 !important;*/
    }
    .box-body{
        font-weight: normal !important;
    }
    #cke_1_contents{
        height: 700px !important;
    }
    #mail_body_ifr{
        height: 628px !important;
    }
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px; !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Tour Bookings </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <?php if($tour_type == 'ts'){ ?>
                <li><a href="<?php url('admin/transfer-service-booking') ?>"> List Transfer Service Bookings </a></li>
                <?php } else {?>
                <li><a href="<?php url('admin/tour-booking') ?>"> List Tour Bookings </a></li>
                <?php } ?>
                <li class="active">Booking Details</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->
                    <?php
                        foreach ($booking_details as $bd) { }
                            //p($bd);
                    ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">View booking details of <b><?php echo $bd['user_name'];  
                            if($bd['booking_status'] == 'approved'){?> <span style="color: #30ca32;">(Approved!)</span> <?php } ?><b></h3>                            
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                             
                                
                                    <div class="col-md-12">
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

                                            <!-- Tour details -->
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
                                                    <?php if($bd['pl_id'] == '1') { ?>
                                                        <tr>
                                                            <td>Hotel Details </td>
                                                            <td>
                                                                <small>Name:</small> <?php echo $bd['hotelName']; ?><br>
                                                                <small>Address:</small> <?php echo $bd['hotelAddress']; ?><br>
                                                                <small>Phone:</small> <?php echo $bd['hotelPhoneNo']; ?><br>
                                                            </td>
                                                        </tr> 
                                                    <?php } else if($bd['pl_id'] == '2' || $bd['pl_id'] == '3' || $bd['pl_id'] == '4' || $bd['pl_id'] == '5' || $bd['pl_id'] == '6') { ?>
                                                        <tr>
                                                            <td>Flight Details: </td>
                                                            <td>
                                                                <small>Flight Name:</small> <?php echo $bd['flightName']; ?><br>
                                                                <small>Terminal Name:</small> <?php echo $bd['terminalName']; ?><br>
                                                                <small>Flight Arrival:</small> <?php echo $bd['flightArrival']; ?><br>
                                                                <small>Flight Departure:</small> <?php echo $bd['flightDeparture']; ?><br>
                                                            </td>
                                                        </tr>   
                                                    <?php } else if($bd['pl_id'] == '7' || $bd['pl_id'] == '8') { ?>    
                                                        <tr>
                                                            <td>Ship Details: </td>
                                                            <td>
                                                                <small>Ship Name:</small> <?php echo $bd['shipName']; ?><br>
                                                            </td>
                                                        </tr>
                                                 
                                                    <?php } else if($bd['pl_id'] == '12') { ?>    
                                                        <tr>
                                                            <td>Local Residence Details: </td>
                                                            <td>
                                                                <small>Address:</small> <?php echo $bd['start_lr_address']; ?><br>
                                                                <small>Phone:</small> <?php echo $bd['start_lr_phone']; ?><br>
                                                            </td>
                                                        </tr>
                                                   
                                                    <?php } else if($bd['pl_id'] == '13') { ?>    
                                                        <tr>
                                                            <td>Restaurant Details: </td>
                                                            <td>
                                                                <small>Name:</small> <?php echo $bd['start_rest_name']; ?><br>
                                                                <small>Address:</small> <?php echo $bd['start_rest_address']; ?><br>
                                                                <small>Phone:</small> <?php echo $bd['start_rest_phone']; ?><br>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                                                                  
                                                    <tr>
                                                        <td>Drop Location: </td>
                                                        <td><?php echo $bd['drop_location']; ?></td>
                                                    </tr>
                                                    <?php if($bd['el_id'] == '1') { ?> 
                                                        <tr>
                                                            <td>Hotel Details: </td>
                                                            <td>
                                                                <small>Name:</small> <?php echo $bd['endhotelName']; ?><br>
                                                                <small>Address:</small> <?php echo $bd['endhotelAddress']; ?><br>
                                                                <small>Phone:</small> <?php echo $bd['endhotelPhoneNo']; ?><br>
                                                            </td>
                                                        </tr>  
                                                    <?php } else if($bd['el_id'] == '12') { ?>  
                                                        <tr>  
                                                            <td>Residence Details: </td>
                                                            <td>
                                                                <small>Address:</small> <?php echo $bd['end_lr_address']; ?><br>
                                                                <small>Phone:</small> <?php echo $bd['end_lr_phone']; ?><br>
                                                            </td>
                                                        </tr>                                                   
                                                    <?php } else if($bd['el_id'] == '13') { ?>  
                                                        <tr>
                                                            <td>Restaurant Details: </td>
                                                            <td>
                                                                <small>Name:</small> <?php echo $bd['end_rest_name']; ?><br>
                                                                <small>Address:</small> <?php echo $bd['end_rest_address']; ?><br>
                                                                <small>Phone:</small> <?php echo $bd['end_rest_phone']; ?><br>
                                                            </td>
                                                        </tr>                                                                                      
                                                    <?php } else if($bd['el_id'] == '16') { ?>  
                                                        <tr>
                                                            <td>Place Details: </td>
                                                            <td>
                                                                <small>Name:</small> <?php echo $bd['end_place_name']; ?><br>
                                                                <small>Address:</small> <?php echo $bd['end_place_address']; ?><br>
                                                                <small>Phone:</small> <?php echo $bd['end_place_phone']; ?><br>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>   
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
                                        <div class="col-md-7">
                                            <form name="confirmForm1" method="post" action="<?php url('admin/booking-appln') ?>" role="form">      
                                                <!--<div class="form-group">
                                                    <label>Select Agents</label><div class="clearfix"></div>
                                                    <select name="agent_email" class="form-control">
                                                        <option value="">Select Agent</option>
                                                        <?php foreach($agents as $agent) {
                                                            ?>
                                                            <option value="<?php echo $agent['email'] ?>">
                                                            <?php echo $agent['name'].' ('.$agent['email'].')'; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>-->
                                                <div class="form-group">
                                                    <label>Mail Subject</label><div class="clearfix"></div>
                                                    <textarea name="subject" id="subject" class="form-control"><?php if($tour_type == 'ts') echo 'Your '. $emirates.' transfer service'; else echo $bd['title']; ?>: Booking Confirmed!</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email content to the user</label>
                                                    <textarea name="mail_body" class="form-control textarea" placeholder="Template Body">
                                                    <?php echo $mail_content; ?></textarea>    
                                                </div>
                                                <div class="form-group">
                                                    <label>Price in AED <small>(This is for tracking pupose)</small></label>
                                                    <input type="text" name="price" class="form-control" value="<?php echo $bd['price'] ?>"> 
                                                </div>
                                                
                                                <div class="form-group pull-right">
                                                    <input type="hidden" name="booking_id" value="<?php echo $bd['booking_id']; ?>">
                                                    <br>
                                                    <button type="button" name="print" class="btn btn-default" onclick="PrintElem('PrintDiv');"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                                    <?php if($bd['booking_status'] != 'approved'){  ?>                                                
                                                        <button type="submit" class="btn btn-danger" name="btn-booking" onclick="return confirm('Are you sure you want to cancel this booking?')" value="cancel"><i class="fa fa-close" aria-hidden="true"></i> Cancel Booking</button>    
                                                        <button type="submit" value="confirm" name="btn-booking" onclick="return confirm('Are you sure you want to confirm this booking?')" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Confirm Booking</button>                                             
                                                    <?php } else { ?>
                                                        <h3 class="text-success" style="color: #30ca32;"><b>Approved!</b></h3>
                                                    <?php } ?>
                                                </div>
                                            </form>  
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

   <div id="PrintDiv" style="display: none;">
    <?php echo $mail_content; ?>
   </div>
