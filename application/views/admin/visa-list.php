<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage tourist visa </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li class="active">List visa application</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List all visa application</h3>
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
                                                <th>ApplnDate</th>      
                                                <th>User Details</th>                                                   
                                                <th>Cell No</th>                                                   
                                                <th>Arvl:/Dep: Date</th>  
                                                <th>No.of People</th>                                             
                                                <th>Discover Us</th>                                             
                                                <th>Documents</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($visa_list as $index=> $vl) { ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php $review['id'] ?>"><?php echo $index+1; ?></td>
                                                    <td><?php echo $vl['visa_date'] ?></td>
                                                    <td class="sorting_1">
                                                        <b>Name:</b> <?php echo $vl['name'] ?><br>
                                                        <b>Email:</b> <?php echo $vl['email'] ?><br>
                                                        <b>Country:</b> <?php echo $vl['nationality'] ?><br>

                                                    </td>
                                                    <td><?php echo $vl['contact_no'] ?></td>
                                                    <td>Arrival Date: <b><?php echo $vl['arrival_date'] ?></b><br>
                                                    Departure Date: <b><?php echo $vl['departure_date'] ?></b></td>
                                                    <td><?php echo $vl['people'] ?></td>
                                                    <td><?php echo $vl['how_discover_us'] ?></td>
                                                    <td>
                                                        <?php
                                                            $hotel      = explode(',',$vl['hotel_booking']);
                                                            $flight     = explode(',',$vl['flight_ticket']);
                                                            $passport   = explode(',',$vl['passport_copy']);

                                                        ?>
                                                        <small>Hotel Booking: </small> <?php  
                                                            $j=1;
                                                            for($i=0; $i<sizeof($hotel); $i++){
                                                                ?>
                                                                <a href="<?php url('assets/files/'.$hotel[$i]); ?>" target="_blank" class="label label-default">Doc-<?php echo $j; ?></a>
                                                                <?php
                                                                $j++;
                                                            }
                                                        ?><br>
                                                        <small>Flight Ticket: </small><?php  
                                                            $j=1;
                                                            for($i=0; $i<sizeof($flight); $i++){
                                                                ?>
                                                                <a href="<?php url('assets/files/'.$flight[$i]); ?>" target="_blank" class="label label-default">Doc-<?php echo $j; ?></a>
                                                                <?php
                                                                $j++;
                                                            }
                                                        ?><br>
                                                        <small>Passport Copy: </small><?php  
                                                            $j=1;
                                                            for($i=0; $i<sizeof($passport); $i++){
                                                                ?>
                                                                <a href="<?php url('assets/files/'.$passport[$i]); ?>" target="_blank" class="label label-default">Doc-<?php echo $j; ?></a>
                                                                <?php
                                                                $j++;
                                                            }
                                                        ?>
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
