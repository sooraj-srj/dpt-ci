
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
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1default" data-toggle="tab">Apply UAE Tourist
                                            Visa</a></li>
                                    <li><a href="#tab2default" data-toggle="tab">About UAE tourist Visa</a></li>
                                    <li><a href="#tab4default" data-toggle="tab">About UAE Residence visa</a></li>
                                    <li><a href="#tab3default" data-toggle="tab">Ask Questions</a></li>

                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1default">

                                        <form name="visaForm" id="visaForm" method="post" action="<?php url('visa-appln'); ?>" enctype="multipart/form-data">
                                            <div class="col-md-12 col-sm-12">

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="name">Name<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="email">Email<span class="red">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                </div>


                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="city">Cell No<span class="red">*</span></label>
                                                            <select class="form-control" name="isd_code">
                                                                <option value="">Select ISD Code</option>
                                                                <?php
                                                                foreach ($isd_code as $isd){
                                                                ?>
                                                                <option value="<?php echo '+'.$isd['country_isd']; ?>">
                                                                    <?php echo $isd['country_name'].' (+'.$isd['country_isd'].')'; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="city">&nbsp;</label>
                                                            <input type="text" class="form-control" name="contact_no" placeholder="Contact Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="nat">Nationality<span class="red">*</span></label>
                                                    <select class="form-control" name="nationality" id="nat">
                                                        <option value="">Select</option>
                                                        <?php
                                                        foreach ($isd_code as $nation){
                                                        ?>
                                                        <option value="<?php echo $nation['country_id'] ?>"><?php echo $nation['country_name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="arrival">Arrival Date<span class="red">*</span></label>
                                                    <input type="text" class="form-control datepicker" id="arrival" name="arrival_date" placeholder="Arrival Date">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="departure">Departure Date<span class="red">*</span></label>
                                                    <input type="text" class="form-control datepicker" id="departure" name="departure_date" placeholder="Departure Date">
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="">No of People<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="" name="people" placeholder="No. of people">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="hdu">How Did You Discover Us<span class="red">*</span></label>
                                                    <select class="form-control" id="hdu" name="how_discover_us">
                                                        <option value="">Select</option>
                                                        <option value="Google Search">Google Search</option>
                                                        <option value="Trip adviser">Trip adviser</option>
                                                        <option value="Recommended by friend/relatives">Recommended by friend/relatives</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-6 col-sm-12">
                                                            <label for="email">Upload Hotel Booking<span class="red">*</span> <small><i>(You can choose multiple files here)</i></small></label>
                                                            <input type="file" name="hotel_booking[]" class="form-control" multiple="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-6 col-sm-12">
                                                            <label for="email">Upload Your Flight Ticket<span class="red">*</span> <small><i>(You can choose multiple files here)</i></small></label>
                                                            <input type="file" name="flight_ticket[]" class="form-control" multiple="">
                                                        </div>     
                                                    </div>                                               
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-6 col-sm-12">
                                                            <label for="email">Upload Passport Copy<span class="red">*</span> <small><i>(You can choose multiple files here)</i></small></label>
                                                            <input type="file" name="passport_copy[]" class="form-control" multiple="">
                                                        </div>     
                                                    </div>                                               
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn main-btn-style">Apply</button>
                                                    &nbsp;
                                                    <button type="button" class="btn main-btn-style">Clear</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="tab2default">
                                        <div class="title title--big title--center title--underline title--decoration-bottom-center">
                                            <h3 class="title__primary">TOURIST VISA</h3>
                                        </div>
                                        <!-- details start -->
                                        <div>
                                        <?php echo $contents['tourist_visa']; ?>
                                        </div>
                                        <!-- end details -->
                                    </div>

                                    <div class="tab-pane fade" id="tab4default">
                                        <div class="title title--big title--center title--underline title--decoration-bottom-center">
                                            <h3 class="title__primary">UAE Residence visa</h3>
                                        </div>
                                        <?php echo $contents['uae_residence_visa']; ?>

                                    </div>

                                    <div class="tab-pane fade" id="tab3default">
                                        <?php $this->load->view('contact-form'); ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="details-share-div">
                            <?php $this->load->view('addthis'); ?>
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
