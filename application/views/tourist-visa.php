
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
                <img src="<?php echo assets_url(); ?>images/003.jpg" class="img-responsive"> <br>
                <a href="<?php url('tourist-visa') ?>"><img src="<?php echo assets_url(); ?>images/7fdc3fb083f48a1.jpg" class="img-responsive"></a>
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
                                                    <input type="text" class="form-control input-sm" id="name" name="name" placeholder="Name">
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="email">Email<span class="red">*</span></label>
                                                    <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Email">
                                                </div>


                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="city">Cell No<span class="red">*</span></label>
                                                            <select class="form-control input-sm" name="isd_code">
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
                                                            <input type="text" class="form-control input-sm" name="contact_no" placeholder="Contact Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="nat">Nationality<span class="red">*</span></label>
                                                    <select class="form-control input-sm" name="nationality" id="nat">
                                                        <option value="">Select</option>
                                                        <?php
                                                        foreach ($nationalities as $nation){
                                                        ?>
                                                        <option value="<?php echo $nation['nationality'] ?>"><?php echo $nation['nationality'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="arrival">Arrival Date<span class="red">*</span></label>
                                                    <input type="text" class="form-control input-sm datepicker" id="arrival" name="arrival_date" placeholder="Arrival Date">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="departure">Departure Date<span class="red">*</span></label>
                                                    <input type="text" class="form-control input-sm datepicker" id="departure" name="departure_date" placeholder="Departure Date">
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="">No of People<span class="red">*</span></label>
                                                    <input type="text" class="form-control input-sm" id="" name="people" placeholder="No. of people">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="hdu">How Did You Discover Us<span class="red">*</span></label>
                                                    <select class="form-control input-sm" id="hdu" name="how_discover_us">
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
                                                            <label for="email">Upload Hotel Booking<span class="red">*</span></label>
                                                            <input type="file" name="hotel_booking" class="form-control input-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-6 col-sm-12">
                                                            <label for="email">Upload Your Flight Ticket<span class="red">*</span></label>
                                                            <input type="file" name="flight_ticket" class="form-control input-sm">
                                                        </div>     
                                                    </div>                                               
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-6 col-sm-12">
                                                            <label for="email">Upload Passport Copy<span class="red">*</span></label>
                                                            <input type="file" name="passport_copy" class="form-control input-sm">
                                                        </div>     
                                                    </div>                                               
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn main-btn-style">Save</button>
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
                                            <span style="color:#000000;"><span style="font-size:14px;"><span style="font-size:16px;">We can assist you with acquiring UAE Tourist visa. Tourist visa, can be used to travel in all 7 emirates of UAE. No matter if you arrive and depart at / from Dubai / Abu Dhabi / Sharjah / Ajman / Ras Al Khaimah / Umm Al Quain / Fujairah.</span><br>
                                            &nbsp;</span></span><br>
                                            <span style="color:#3399ff;"><span style="font-size:14px;"><strong>We require clear scanned passport copies + hotel booking confirmations OR Flight tickets copy 30 days prior to your arrival date to apply for Tourist Visa.&nbsp;<br>
                                            &nbsp;<br>
                                            <span style="font-size:16px;">Cost for Single Entry Visa is &nbsp;</span>&nbsp;</strong></span></span><br>
                                            <span style="color:#FF0000;"><span style="font-size:14px;"><strong>USD 95 / AED 350 </strong></span></span><span style="color:#3399ff;"><span style="font-size:14px;"><strong>per person. (14 days)</strong></span></span><br>
                                            <span style="color:#FF0000;"><span style="font-size:14px;"><strong>USD 129 / AED 470</strong></span></span><span style="color:#3399ff;"><span style="font-size:14px;"><strong>&nbsp; &nbsp;per person. (30 days)</strong></span></span><br>
                                            <span style="color:#FF0000;"><span style="font-size:14px;"><strong>USD 399 / AED 1455&nbsp;</strong></span></span><span style="color:#3399ff;"><span style="font-size:14px;"><strong>per person. (90 days)<br>
                                            &nbsp;<br>
                                            <span style="font-size:16px;">Cost for Multiple entry visa is </span></strong></span></span><br>
                                            <span style="color:#FF0000;"><span style="font-size:14px;"><strong>USD 384 / AED 1400</strong></span></span><span style="color:#3399ff;"><span style="font-size:14px;"><strong> per person. (30 days)</strong></span></span><br>
                                            <span style="color:#FF0000;"><span style="font-size:14px;"><strong>USD 699 / AED 2550</strong></span></span><span style="color:#3399ff;"><span style="font-size:14px;"><strong> per person. (90 days)</strong></span></span><br>
                                            <span style="color:#000000;"><span style="font-size:14px;">&nbsp;<br>
                                            &nbsp;</span></span><br>
                                            <span style="color:#3399ff;"><span style="font-size:14px;"><span style="font-size:16px;"><strong>Do I need to apply for visa to come to UAE?</strong></span></span></span><br>
                                            <span style="color:#000000;"><span style="font-size:14px;">The Below nationalities can get visas on arrival:</span></span>
                                        </div>
                                        <table border="1" cellpadding="0" cellspacing="0" class="table">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Andorra</strong></td>
                                                    <td><strong>France</strong></td>
                                                    <td><strong>Lithuania</strong></td>
                                                    <td><strong>Singapore</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Australia</strong></td>
                                                    <td><strong>Denmark</strong></td>
                                                    <td><strong>Luxembourg</strong></td>
                                                    <td><strong>Slovakia</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Austria</strong></td>
                                                    <td><strong>Germany</strong></td>
                                                    <td><strong>Malaysia</strong></td>
                                                    <td><strong>Slovenia</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Belgium</strong></td>
                                                    <td><strong>Greece</strong></td>
                                                    <td><strong>Malta</strong></td>
                                                    <td><strong>Spain</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Brune</strong></td>
                                                    <td><strong>Holland (Netherlands)</strong></td>
                                                    <td><strong>Monaco</strong></td>
                                                    <td><strong>South Korea</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Bulgaria</strong></td>
                                                    <td><strong>Hong Kong</strong></td>
                                                    <td><strong>Netherlands (Holland)</strong></td>
                                                    <td><strong>Sweden</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Canada</strong></td>
                                                    <td><strong>Hungary</strong></td>
                                                    <td><strong>New Zealand</strong></td>
                                                    <td><strong>Switzerland</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Croatia</strong></td>
                                                    <td><strong>Iceland</strong></td>
                                                    <td><strong>Norway</strong></td>
                                                    <td><strong>United Kingdom</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Czech Republic</strong></td>
                                                    <td><strong>Ireland</strong></td>
                                                    <td><strong>Poland</strong></td>
                                                    <td><strong>United States&nbsp;&nbsp;</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Cyprus</strong></td>
                                                    <td><strong>Italy</strong></td>
                                                    <td><strong>Liechtenstein</strong></td>
                                                    <td><strong>Vatican City</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Denmark</strong></td>
                                                    <td><strong>Japan</strong></td>
                                                    <td><strong>Portugal</strong></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Estonia</strong></td>
                                                    <td><strong>Latvia</strong></td>
                                                    <td><strong>Romania</strong></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Finland</strong></td>
                                                    <td><strong>Liechtenstein</strong></td>
                                                    <td><strong>San Marino</strong></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div style="text-align: justify;"><span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">Do I need to make a security deposit for visa processing.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">No we do not require security deposit. However for certain African countries passport holders, yes, you will need to make a security deposit as per emigration rule. &nbsp; &nbsp;&nbsp;<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">I’m visiting Dubai for less than 7 days. How many days visa I require.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">You may kindly apply for 14 days visa<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">I have USA / UK Visa on my passport. Do I still need to apply visa for UAE.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Yes, you will still require a visa to enter UAE<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">My travel dates are 3 months ahead from now. Do I need to apply for visa now?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Every tourist visa is issued with a validity of 2 months. If we apply for your visa now, it will be expired in 2 months. You may kindly send your documents 30 days before your travel date and we can get your visa issued in 3 working days<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><span style="font-size:16px;"><strong>My travel dates are in next 2 days. Can I get an express visa / entry.?</strong></span></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">We require minimum of 3 working days to get visa issued. Emigration remains closed on Friday and Saturday and no visas will be issued in these 2 days. However we can for express entry in 2 days’ time for which an additional amount of USD 200 will be applicable on top of above visa cost<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">How long / in how many days’ time I can get my visa.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">We can get your visas in 3 working days’ time. Emigration remains closed on Friday and Saturday. Hence visa processing will not be possible on these 2 days.<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">How should I apply for my Tourist visa.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Kindly visit our website and upload your documents. Our customer support team shall get in touch with you with payment options.</span></span><br>
                                        <br>
                                        <span style="font-size:16px;"><strong><span style="color:#3399ff;">I will be staying with my friend. Hence do not have hotel booking. Can I still get a visa?</span></strong></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Yes, you can. You may kindly forward us with your Flight tickets copy OR your friends Emirates ID as a proof instead of Hotel booking<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">Do I need to book any of your tours to get visa.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">No. you need not book any tours with us to apply and get your visa. However we do have many tours matching short layover guest and packages tours. &nbsp; Kindly contact us for further details &nbsp;</span>&nbsp;</span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">&nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><span style="font-size:16px;"><strong>How do I make the payment.?</strong></span></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Once we receive your documents, &nbsp;we shall send you the invoice number and payment link http://www.milantoursdubai.com/pay.php to pay using (VISA / MASTERCARD)<br>
                                        In case you payment gets denied, kindly contact your bank along with the card you used and they shall help you resolve the issue and make the payment again using the same invoice number<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">Do you accept PayPal or AMEX.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">We are sorry. Unfortunately for online payment we do not accept AMEX and we do not have PayPal account<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">My visa has been issued. What is the next step.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Kindly cross check your visa with your passport and verify your name, DOB and passport number are correct. &nbsp;<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">Is there any age limit for visa processing.?</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Generally, there is no age limit to get Tourist visa. However for certain African countries, yes, there is age limit &amp; gender restriction to get visa . Kindly cross check with our customer support team for more information<br>
                                        &nbsp;</span></span><br>
                                        <span style="font-size:16px;"><span style="color:#3399ff;"><strong>How can I check or get to know the status of my visa.?</strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Once the payment is made, to get update on your visa status, kindly Whatsapp / SMS us on +971552501818<br>
                                        &nbsp;</span></span><br>
                                        <span style="font-size:16px;"><span style="color:#3399ff;"><strong>Do I need original visa or how the visa will be sent to me.?</strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">You do not require original visa. You will be issued with an e-visa from UAE emigration. You may kindly print the same and present this at emigration upon your arrival. They shall stamp your entry on it.<br>
                                        &nbsp;</span></span><br>
                                        <span style="font-size:16px;"><span style="color:#3399ff;"><strong>My visa has been issued. My travel plan has changed. Can I cancel and get refund?</strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Once we submit your documents at emigration, we will not be able to cancel your application and refund the amount. If would like to cancel your application once after we apply, an additional USD 30 / AED 110 will be applicable for same &nbsp;<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><strong><span style="font-size:16px;">Do you wish to live in Dubai.? &nbsp;</span></strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Yes, we can arrange for residence visa. Kindly contact us &nbsp;for further details &nbsp;&nbsp;<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:14px;"><span style="font-size:16px;"><strong>Do you wish to do business / invest in Dubai.? &nbsp;</strong></span></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:14px;">Yes, we can assist you set up business including local sponsor. Kindly contact us for further details&nbsp;</span></span></div>
                                        <!-- end details -->
                                    </div>

                                    <div class="tab-pane fade" id="tab4default">
                                        <div class="title title--big title--center title--underline title--decoration-bottom-center">
                                            <h3 class="title__primary">UAE Residence visa</h3>
                                        </div>
                                        <span style="color:#3399ff;"><span style="font-size:16px;"><strong>Do you wish to live in Dubai.? &nbsp;</strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:16px;">Yes, we can arrange for residence visa. Kindly contact us &nbsp;for further details &nbsp;&nbsp;<br>
                                        &nbsp;</span></span><br>
                                        <span style="color:#3399ff;"><span style="font-size:16px;"><strong>Do you wish to do business / invest in Dubai.? &nbsp;</strong></span></span><br>
                                        <span style="color:#000000;"><span style="font-size:16px;">Yes, we can assist you set up business including local sponsor. Kindly contact us for further details&nbsp;</span></span> 

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
                                                    <option value="<?php echo $nation['country_name'] ?>"><?php echo $nation['country_name']; ?></option>
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
                                                <input type="hidden" name="qn_for" value="visa">
                                                <button type="submit" class="btn main-btn-style">Send</button>
                                            </div>
                                        </form>
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
