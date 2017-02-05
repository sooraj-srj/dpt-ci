
<div class="detail-img-div"></div>
<div class="clearfix"></div>
<div class="details-booking-div">
    <div class="booking-inn-div">
        <div class="container">
            <div class="col-md-3">
                <div class="price-decoration block-after-indent  screen-only">
                    <!--<div class="price-decoration__value"> <i class="fa fa-tag"></i> <span class="amount"><small>AED </small>580</span> <span class="amount"><small>USD </small>159</span> </div>-->
                    <div class="price-decoration__label"><h4>Select Your Package</h4></div>
                </div>
                <div class="clearfix"></div>
                <div class="left-package-list">
                    <ul id="mainNav" class="list-product-ul">
                        <?php
                        $i = 1;
                        foreach ($tours as $tour) {
                            ?>
                            <li class="mainNavItem <?php if ($tour['tour_id'] == $tour_id) {
                            echo 'active';
                        } ?>">
                                <div id="navItem<?php echo $i; ?>" data-url="<?php echo current_url() . '?plan=' . $tour['tour_id']; ?>" class="tour-nav">
                            <?php echo $tour['title'] ?>
                                </div>
                            </li>
                            <?php
                            $i++;
                        }
                        ?>

                    </ul>
                </div>
                <div class="clearfix"></div>
                <br>

                <img src="<?php echo assets_url(); ?>images/003.jpg" class="img-responsive">
                <br>
                <img src="<?php echo assets_url(); ?>images/7fdc3fb083f48a1.jpg" class="img-responsive">
                <br>
                <img src="<?php echo assets_url(); ?>images/004.jpg" class="img-responsive">
                <br>
                <img src="<?php echo assets_url(); ?>images/005.jpg" class="img-responsive">

            </div>
            <div class="col-md-9">
                <div class="row">
                    <div id="content-wrap1">
                        <div class="price-decoration2 block-after-indent  screen-only">
                            <div class="price-decoration__value"><i class="fa fa-tag"></i> <span class="amount"><small>AED </small><?php echo $tour_details['price']; ?></span>
                                <span class="amount"><small>USD </small><?php echo $tour_details['usd_price']; ?></span></div>
                            <div class="price-decoration__label"><i class="td-clock-2"></i> Duration <?php echo $tour_details['duration'] ?></div>
                        </div>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1default" data-toggle="tab">Book This Tour</a>
                                    </li>
                                    <li><a href="#tab2default" data-toggle="tab">Details</a></li>
                                    <li><a href="#tab3default" data-toggle="tab">Ask Questions</a></li>
                                    <li><a href="#tab4default" data-toggle="tab">Photos</a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1default">
                                        <div class="col-md-12"><h4><b>Booking Details</b></h4></div>
                                        <form name="selectPlanForm" id="selectPlanForm" method="post" action="<?php url('plan-appln'); ?>">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="arrival">Tour Date<span class="red">*</span></label>
                                                    <input type="text" class="form-control input-sm datepicker" name="tour_date" id="arrival" placeholder="">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="name">Preferred Pickup Time<span class="red">*</span></label>
                                                    <select class="form-control input-sm" name="pref_pickup_time" >
                                                        <option value="">Select</option>
                                                        <option value="00:00 am">12:00 am</option>
                                                        <option value="00:30 am">12:30 am</option>
                                                        <option value="01:00 am">01:00 am</option>
                                                        <option value="01:30 am">01:30 am</option>
                                                        <option value="02:00 am">02:00 am</option>
                                                        <option value="02:30 am">02:30 am</option>
                                                        <option value="03:00 am">03:00 am</option>
                                                        <option value="03:30 am">03:30 am</option>
                                                        <option value="04:00 am">04:00 am</option>
                                                        <option value="04:30 am">04:30 am</option>
                                                        <option value="05:00 am">05:00 am</option>
                                                        <option value="05:30 am">05:30 am</option>
                                                        <option value="06:00 am">06:00 am</option>
                                                        <option value="06:30 am">06:30 am</option>
                                                        <option value="07:00 am">07:00 am</option>
                                                        <option value="07:30 am">07:30 am</option>
                                                        <option value="08:00 am">08:00 am</option>
                                                        <option value="08:30 am">08:30 am</option>
                                                        <option value="09:00 am">09:00 am</option>
                                                        <option value="09:30 am">09:30 am</option>
                                                        <option value="10:00 am">10:00 am</option>
                                                        <option value="10:30 am">10:30 am</option>
                                                        <option value="11:00 am">11:00 am</option>
                                                        <option value="11:30 am">11:30 am</option>
                                                        <option value="12:00 pm">12:00 pm</option>
                                                        <option value="12:30 pm">12:30 pm</option>
                                                        <option value="13:00 pm">01:00 pm</option>
                                                        <option value="13:30 pm">01:30 pm</option>
                                                        <option value="14:00 pm">02:00 pm</option>
                                                        <option value="14:30 pm">02:30 pm</option>
                                                        <option value="15:00 pm">03:00 pm</option>
                                                        <option value="15:30 pm">03:30 pm</option>
                                                        <option value="16:00 pm">04:00 pm</option>
                                                        <option value="16:30 pm">04:30 pm</option>
                                                        <option value="17:00 pm">05:00 pm</option>
                                                        <option value="17:30 pm">05:30 pm</option>
                                                        <option value="18:00 pm">06:00 pm</option>
                                                        <option value="18:30 pm">06:30 pm</option>
                                                        <option value="19:00 pm">07:00 pm</option>
                                                        <option value="19:30 pm">07:30 pm</option>
                                                        <option value="20:00 pm">08:00 pm</option>
                                                        <option value="20:30 pm">08:30 pm</option>
                                                        <option value="21:00 pm">09:00 pm</option>
                                                        <option value="21:30 pm">09:30 pm</option>
                                                        <option value="22:00 pm">10:00 pm</option>
                                                        <option value="22:30 pm">10:30 pm</option>
                                                        <option value="23:00 pm">11:00 pm</option>
                                                        <option value="23:30 pm">11:30 pm</option>
                                                    </select>
                                                </div>
                                                

                                                <div class="col-md-6 col-sm-6"> <!-- ========= PICKUP LOCATION ========== -->
                                                    <div class="form-group">
                                                        <label for="name">Pickup Location<span class="red">*</span></label>
                                                        <select class="form-control input-sm" id="pickupLocation" name="pickup_location">
                                                            <option value="">Select</option>
                                                            <?php 
                                                            foreach ($pickup_location as $pl){
                                                            ?>
                                                            <option value="<?php echo $pl['id'] ?>"><?php echo $pl['location'] ?></option>
                                                            <?php
                                                            } 
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <!-- hide and show for hotel details -->
                                                    <div id="hotelDetails1" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="Hotel Name">Hotel Name<span class="red">*</span></label>                                 
                                                            <input type="text" class="form-control" name="hotelName" id="hotelName" placeholder="Hotel Name" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="hotelAddress">Hotel Address<span class="red">*</span></label>       
                                                            <input type="text" class="form-control" name="hotelAddress" id="hotelAddress" placeholder="Hotel Address" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="hotelPhoneNo">Hotel Telephone<span class="red">*</span></label>
                                                            <input type="text" class="form-control" name="hotelPhoneNo" id="hotelPhoneNo" placeholder="Hotel Phone No" value="">
                                                        </div>
                                                    </div>
                                                    <!-- hide and show for flight details -->
                                                    <div id="flightDetails1" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="flightName">Flight Name and No<span class="red">*</span></label>      
                                                            <input type="text" class="form-control" name="flightName" id="flightName" placeholder="Flight Name" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="terminalName">Terminal Name<span class="red">*</span></label>      
                                                            <input type="text" class="form-control" name="terminalName" id="terminalName" placeholder="Terminal Name" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="flightArrival">Arrival Time<span class="red">*</span></label>       
                                                            <input type="text" class="form-control" name="flightArrival" id="flightArrival" placeholder="Flight Arrival" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="flightDeparture">Departure Time</label>
                                                            <input type="text" class="form-control" name="flightDeparture" id="flightDeparture" placeholder="Flight Departure" value="">        
                                                        </div>
                                                    </div>
                                                    <!-- hide and show for ship name -->
                                                    <div id="shipDetails" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="shipName">Ship Name<span class="red">*</span></label>
                                                            <input type="text" class="form-control" name="shipName" id="shipName" placeholder="shipName" value=""> 
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6"> <!-- ========= END LOCATION ========== -->
                                                    <div class="form-group">
                                                        <label for="name">End Location<span class="red">*</span></label>
                                                        <select class="form-control input-sm" id="dropLocation" name="dropLocation">
                                                            <option value="">Select</option>
                                                            <?php 
                                                            foreach ($pickup_location as $pl){
                                                            ?>
                                                            <option value="<?php echo $pl['id'] ?>"><?php echo $pl['location'] ?></option>
                                                            <?php
                                                            } 
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div id="endloc" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="endhotel Name">End Hotel Name<span class="red">*</span></label>
                                                            <input type="text" class="form-control" name="endhotelName" id="endhotelName" placeholder="Hotel Name" value="">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="endhotelAddress">End Hotel Address<span class="red">*</span></label>       
                                                            <input type="text" class="form-control" name="endhotelAddress" id="endhotelAddress" placeholder="Hotel Address" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="endhotelPhoneNo">End Hotel Telephone<span class="red">*</span></label>
                                                            <input type="text" class="form-control" name="endhotelPhoneNo" id="endhotelPhoneNo" placeholder="Hotel Phone No" value="">                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-6">
                                                                <?php if($flag != "transfer") { ?>
                                                                    <label for="name">Preferred Guide Language<span class="red">*</span></label>
                                                                    <select class="form-control input-sm" id="months" name="preferedguide">
                                                                        <option value="">Select</option>
                                                                        <option value="English">English</option>
                                                                        <option value="Arabic">Arabic</option>
                                                                        <option value="Spanish">Spanish</option>
                                                                        <option value="Italian">Italian</option>
                                                                        <option value="German">German</option>
                                                                        <option value="French">French</option>
                                                                        <option value="Portuguese">Portuguese</option>
                                                                        <option value="Chinese">Chinese</option>
                                                                        <option value="Japanese">Japanese</option>
                                                                        <option value="Russian">Russian</option>                                
                                                                    </select>
                                                                    <?php } ?>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-sm-6">
                                                                    <label for="gender">Pref.currency</label>
                                                                    <select class="form-control input-sm" id="months" name="currencyCode">
                                                                        <option value="">Select</option>                                                                        
                                                                            <option value="USD($)">USD($)</option>
                                                                            <option value="AED">AED</option>
                                                                            <option value="EURO">EURO</option>
                                                                            <option value="AUD">AUD</option>
                                                                            <option value="UK POUND">UK POUND</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-6">
                                                                    <label for="gender">Payment Mode<span class="red">*</span></label>
                                                                    <select class="form-control input-sm" id="months" name="currencyMode">
                                                                        <option value="">Select</option>
                                                                        <option value="Credit Card">Credit Card</option>
                                                                        <option value="Cash">Cash</option>                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name">Adults<span class="red">*</span></label>
                                                            <input type="text" class="form-control input-sm" id="name" name="adultNo" placeholder="No.of Adults">
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name">Children</label>
                                                            <input type="text" class="form-control input-sm" id="name" name="childNo" placeholder="Age 5-12">
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name">Infants</label>
                                                            <input type="text" class="form-control input-sm" id="name" name="infantNo" placeholder="Age < 5">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                                <div class="col-md-12">
                                                    <h4><b>Personal Details</b></h4>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="firstName">First Name<span class="red">*</span></label>
                                                    <input type="text" class="form-control input-sm" id="fname" name="firstName" placeholder="First Name">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="lastName">Last Name<span class="red">*</span></label>
                                                    <input type="text" class="form-control input-sm" id="email" name="lastName" placeholder="Last Name">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="email">Email<span class="red">*</span></label>
                                                    <input type="text" class="form-control input-sm" id="email" name="email" placeholder="Email">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="confirm_email">Confirm Email<span class="red">*</span></label>
                                                    <input type="text" class="form-control input-sm" id="email" name="confirm_email" placeholder="Confirm Email">
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label for="nationality">Nationality<span class="red">*</span></label>
                                                    <select class="form-control input-sm" name="nationality">
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
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="city">Cell No<span class="red">*</span></label>
                                                            <select class="form-control input-sm" name="countryCode1">
                                                                <option value="">Select</option>
                                                                <?php
                                                                foreach ($isd_code as $isd){
                                                                ?>
                                                                <option value="<?php echo '('.$isd['country_name'].') +'.$isd['country_isd'] ?>">
                                                                    <?php echo $isd['country_name'].' (+'.$isd['country_isd'].')'; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="city">&nbsp;</label>
                                                            <input type="text" class="form-control input-sm" name="cell_no1" id="city" placeholder="Cell No 1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="city">Cell No2</label>
                                                            <select class="form-control input-sm" name="countryCode2">
                                                                <option value="">Select</option>
                                                                <?php
                                                                foreach ($isd_code as $isd){
                                                                ?>
                                                                <option value="<?php echo '('.$isd['country_name'].') +'.$isd['country_isd'] ?>">
                                                                    <?php echo $isd['country_name'].' (+'.$isd['country_isd'].')'; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="city">&nbsp;</label>
                                                            <input type="text" class="form-control input-sm" name="cell_no2" placeholder="Celle No 2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label for="email">How Did You Discover Us<span class="red">*</span></label>
                                                    <select class="form-control input-sm" name="howfind">
                                                        <option value="">Select</option>
                                                        <option value="Google Search">Google Search</option>
                                                        <option value="Trip adviser">Trip adviser</option>
                                                        <option value="Recommended by friend/relatives">Recommended by friend/relatives</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label for="address">Special Requests</label>
                                                    <textarea class="form-control input-sm" id="address" rows="5" name="specialResquest"></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>">
                                                    <button type="submit" class="btn main-btn-style">Confirm Booking</button>&nbsp;
                                                    <button type="button" class="btn main-btn-style">Clear</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="tab2default">                                        
                                        <?php echo $tour_details['body']; ?>
                                    </div>

                                    <div class="tab-pane fade" id="tab3default">
                                        <form name="askmeForm" id="askmeForm" method="post" action="<?php url('askme-appln') ?>">
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="firstName">First Name<span class="red">*</span></label>
                                                <input type="text" class="form-control input-sm" id="first_name" name="first_name" placeholder="First Name">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="email">Last Name<span class="red">*</span></label>
                                                <input type="text" class="form-control input-sm" id="last_name" name="last_name" placeholder="Last Name">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="email">Email<span class="red">*</span></label>
                                                <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Email">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="email">Phone Number</label>
                                                <input type="text" class="form-control input-sm" id="" name="phone_number" placeholder="Phone Number">
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="email">Nationality<span class="red">*</span></label>
                                                <select class="form-control input-sm" id="" name="nationality">
                                                    <option value="">Select</option>
                                                    <?php
                                                    foreach ($isd_code as $nation){
                                                    ?>
                                                    <option value="<?php echo $nation['country_name'] ?>"><?php echo $nation['country_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="address">Message<span class="red">*</span></label>
                                                <textarea class="form-control input-sm" id="address" rows="5" name="message"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>">
                                                <input type="hidden" name="qn_for" value="tour">
                                                <button type="submit" class="btn main-btn-style">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="tab4default">
                                    <?php if(empty($tour_gallery)) { echo '<h3 class="text-muted" align="center">No gallery images available!</h3>'; } ?>
                                        <div id="jssor_1"
                                             style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 456px; overflow: hidden; visibility: hidden; background-color: #24262e;">
                                            <!-- Loading Screen -->
                                            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                <div style="position:absolute;display:block;background:url('<?php echo assets_url(); ?>images/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
                                            <div data-u="slides"
                                                 style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 356px; overflow: hidden;">
                                                <?php 
                                                    $i=0;  
                                                    if(!empty($tour_gallery)) { 
                                                        foreach($tour_gallery as $tg){
                                                ?>
                                                            <div data-p="144.50">
                                                                <img data-u="image" src="<?php echo_image('images/tours/'.$tg['image_file']); ?>"/>
                                                                <img data-u="thumb" src="<?php echo_image('images/tours/'.$tg['image_file']);?>"/>
                                                            </div>
                                                <?php
                                                        $i++;
                                                        }
                                                    }
                                                    
                                                ?>
                                                
                                                
                                            </div>
                                            <!-- Thumbnail Navigator -->
                                            <div data-u="thumbnavigator" class="jssort01"
                                                 style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;"
                                                 data-autocenter="1">
                                                <!-- Thumbnail Item Skin Begin -->
                                                <div data-u="slides" style="cursor: default;">
                                                    <div data-u="prototype" class="p">
                                                        <div class="w">
                                                            <div data-u="thumbnailtemplate" class="t"></div>
                                                        </div>
                                                        <div class="c"></div>
                                                    </div>
                                                </div>
                                                <!-- Thumbnail Item Skin End -->
                                            </div>
                                            <!-- Arrow Navigator -->
                                            <span data-u="arrowleft" class="jssora05l"
                                                  style="top:158px;left:8px;width:40px;height:40px;"></span> <span
                                                  data-u="arrowright" class="jssora05r"
                                                  style="top:158px;right:8px;width:40px;height:40px;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="details-share-div">
                            <a class="share-btn share-btn-branded share-btn-twitter" href="#" title="Share on Twitter"> <span
                                    class="share-btn-icon"></span> <span class="share-btn-text"><i
                                        class="fa fa-twitter" aria-hidden="true"></i> Twitter</span> 
                            </a>

                            <!-- Branded Facebook button -->
                            <a class="share-btn share-btn-branded share-btn-facebook"
                               href="#"
                               title="Share on Facebook"> <span class="share-btn-icon"></span> <span
                                    class="share-btn-text"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</span>
                            </a>

                            <!-- Branded Google+ button -->
                            <a class="share-btn share-btn-branded share-btn-googleplus"
                               href="#"
                               title="Share on Google+"> <span class="share-btn-icon"></span> <span
                                    class="share-btn-text"><i class="fa fa-google-plus" aria-hidden="true"></i> Google+</span>
                            </a>

                            <!-- Branded LinkedIn button -->
                            <a class="share-btn share-btn-branded share-btn-linkedin"
                               href="#"
                               title="Share on LinkedIn"> <span class="share-btn-icon"></span> <span
                                    class="share-btn-text"><i class="fa fa-linkedin" aria-hidden="true"></i> LinkedIn</span>
                            </a>

                            <!-- Branded Pinterest button -->
                            <a class="share-btn share-btn-branded share-btn-pinterest"
                               href="#"
                               title="Share on Pinterest"> <span class="share-btn-icon"></span> <span
                                    class="share-btn-text"><i class="fa fa-pinterest-p" aria-hidden="true"></i> Pinterest</span>
                            </a>
                        </div>
                    </div>

                    <div class="details-div-last">
                        <h3>You May Also Like</h3>
                        <br>
                        <div class="col-md-4">
                            <div class="item-main-div1"><img src="<?php echo assets_url(); ?>images/carous1/fit (1).jpg"
                                                             class="img-responsive item-1-img">
                                <div class="price-first-position">
                                    <div class="price-div-bg-text">
                                        <center>
                                            <h4><b>AED 580</b></h4>
                                            <h5><b>USD 159</b></h5>
                                        </center>
                                    </div>
                                </div>
                                <div class="item-head-1">
                                    <center>
                                        <h4 class="atgrid__item__title"><a href="#">4 Hours Dubai Private Tour</a>
                                        </h4>
                                    </center>
                                </div>
                                <div class="item--footer-1">
                                    <div class="col-md-6"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;4
                                        Hours
                                    </div>
                                    <div class="col-md-6"><a href="#">Read More <i class="fa fa-long-arrow-right"
                                                                                   aria-hidden="true"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-main-div1"><img src="<?php echo assets_url(); ?>images/carous1/fit (2).jpg"
                                                             class="img-responsive item-1-img">
                                <div class="price-first-position">
                                    <div class="price-div-bg-text">
                                        <center>
                                            <h4><b>AED 580</b></h4>
                                            <h5><b>USD 159</b></h5>
                                        </center>
                                    </div>
                                </div>
                                <div class="item-head-1">
                                    <center>
                                        <h4 class="atgrid__item__title"><a href="#">4 Hours Dubai Private Tour</a>
                                        </h4>
                                    </center>
                                </div>
                                <div class="item--footer-1">
                                    <div class="col-md-6"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;4
                                        Hours
                                    </div>
                                    <div class="col-md-6"><a href="#">Read More <i class="fa fa-long-arrow-right"
                                                                                   aria-hidden="true"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-main-div1"><img src="<?php echo assets_url(); ?>images/carous1/fit (7).jpg"
                                                             class="img-responsive item-1-img">
                                <div class="price-first-position">
                                    <div class="price-div-bg-text">
                                        <center>
                                            <h4><b>AED 580</b></h4>
                                            <h5><b>USD 159</b></h5>
                                        </center>
                                    </div>
                                </div>
                                <div class="item-head-1">
                                    <center>
                                        <h4 class="atgrid__item__title"><a href="#">4 Hours Dubai Private Tour</a>
                                        </h4>
                                    </center>
                                </div>
                                <div class="item--footer-1">
                                    <div class="col-md-6"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;4
                                        Hours
                                    </div>
                                    <div class="col-md-6"><a href="#">Read More <i class="fa fa-long-arrow-right"
                                                                                   aria-hidden="true"></i></a></div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>