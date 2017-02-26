<style type="text/css">
/*    tr{
        cursor: move !important;
    }*/
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 946px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage user questions </h1>
            <ol class="breadcrumb">
                <li><a href="<?php url('admin') ?>"><i class="fa fa-dashboard"></i> </a></li>
                <li class="active">List questions</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List all questions and type from users</h3>
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
                                                <th>Type</th>                                                     
                                                <th>Question/Enquiry</th>                                                   
                                                <!--<th>Action</th>-->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($questions as $index=> $qn) { ?>
                                                <tr role="row" class="odd">
                                                    <td class="index" data-id="<?php $qn['id'] ?>"><?php echo $index+1; ?></td>
                                                    <td><?php echo $qn['qdate'] ?></td>
                                                    <td class="sorting_1">
                                                        <b>Name:</b> <?php echo $qn['first_name'].' '.$qn['last_name'] ?><br>
                                                        <b>Email:</b> <?php echo $qn['email'] ?><br>
                                                        <b>Phone:</b> <?php echo $qn['phone_number'] ?><br>
                                                        <b>Nationality:</b> <?php echo $qn['nationality'] ?><br>

                                                    </td>
                                                    <td><b><?php echo strtoupper($qn['qn_for']); ?></b></td>
                                                    <td><?php echo $qn['message'] ?></td>
                                                    <!--<td>
                                                        <a href="<?php url('admin/questions/'.$qn['id']) ?>" class="text-primary">Delete</a>  
                                                    </td>-->
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
