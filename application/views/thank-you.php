
    <div class="detail-img-div"></div>
    <div class="clearfix"></div>
    <div class="details-booking-div">
        <div class="booking-inn-div">
            <div class="container">
                <div class="col-md-3">
                    <div class="clearfix"></div>
                    <div class="left-package-list">
                        <div class="widget banners">
                            <div class="banner">
                                <?php include('common/tripadvisor-widget.php'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <?php $this->load->view('common/left-ad'); ?>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div id="content-wrap1">
                            <div class="panel with-nav-tabs panel-default">
                                <div class="panel-heading">                                    
                                    <?php if ( f('success_message') != '' ){ ?> 
                                    <h2 class="text-success">Thank you! </h2> 
                                    <?php } ?>
                                    <?php if( f('error_message') != '' ){ ?> 
                                    <h2 class="text-danger">Sorry! </h2> 
                                    <?php } ?>
                                    
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab1default">
                                            <div class="col-md-12">
                                                <div class="row text-success">
                                                    <!-- Your booking has been completed successfully. Please check your email for further details. -->
                                                    <?php echo f('success_message'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="details-div-last">
                            <?php $this->load->view('popular-tours'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
