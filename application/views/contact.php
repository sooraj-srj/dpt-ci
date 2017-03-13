
<div class="detail-img-div"></div>
<div class="clearfix"></div>
<div class="contact-us-div">
    <div class="container">
        <div class="col-md-6">
            <div class="price-decoration__label">
                <h4>Contact Us</h4>
            </div>
            <div class="clearfix"></div>
            <br>

            <form name="contactForm" id="contactForm" method="post" action="<?php url('contact-appln') ?>">
                <div class="form-group col-md-12 col-sm-6">
                    <label for="name">Name<span class="red">*</span></label>
                    <input type="text" class="form-control input-sm" id="name" name="name" placeholder="Your Name">
                </div>
                <div class="form-group col-md-12 col-sm-6">
                    <label for="email">Email<span class="red">*</span></label>
                    <input type="email" class="form-control input-sm" id="contactEmail" name="email" placeholder="Your Email">
                </div>

                <div class="form-group col-md-12 col-sm-6">
                    <label for="email">Confirm Email<span class="red">*</span></label>
                    <input type="email" class="form-control input-sm" id="contactEmailConfirm" name="confirm_email" placeholder="Confirm Email">
                </div>
                <div class="form-group col-md-12 col-sm-6">
                    <label for="name">Nationality</label>
                    <select class="form-control input-sm" id="months" name="nationality">
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
                    <label for="email">How Did You Discover Us<span class="red">*</span></label>
                    <select class="form-control input-sm" id="years" name="how_discover_us">
                        <option value="">Select</option>
                        <option value="Google Search">Google Search</option>
                        <option value="Trip adviser">Trip adviser</option>
                        <option value="Recommended by friend/relatives">Recommended by friend/relatives</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="col-md-12 col-sm-6">
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6">
                            <label for="city">Country Code<span class="red">*</span></label>
                            <select class="form-control input-sm" id="years" name="isd_code">
                                <option value="">Select</option>
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
                            <label for="city">Cell No<span class="red">*</span></label>
                            <input type="text" class="form-control input-sm" id="city" name="phone_number" placeholder="Cell Nummber">
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 col-sm-12">
                    <label for="address">Address</label>
                    <textarea class="form-control input-sm" id="address" rows="5" name="address"></textarea>
                </div>

                <div class="form-group col-md-12 col-sm-6">
                    <label for="email">Subject</label>
                    <input type="text" class="form-control input-sm" id="email" name="subject" placeholder="Subject">
                </div>
                <div class="form-group col-md-12 col-sm-12">
                    <label for="address">Message</label>
                    <textarea class="form-control input-sm" id="address" rows="5" name="message"></textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn main-btn-style">Send</button>
                </div>

            </form>

        </div>
        <div class="col-md-6">
            <div class="price-decoration__label">
                <h4>Contact Address</h4>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="footer-div-contact-styl">
                <div class="footer-contact-icon">
                    <div class="footer-icon-div"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                </div>
                <div class="footer-contact-text">
                    <ul class="footer-contact-ul-style">
                        <?php echo get_settings('contact_address'); ?>
                    </ul>
                </div>
            </div>
            <div class="footer-div-contact-styl">
                <div class="footer-contact-icon">
                    <div class="footer-icon-div"><i class="fa fa-phone" aria-hidden="true"></i></div>
                </div>
                <div class="footer-contact-text">
                    <ul class="footer-contact-ul-style">
                        <?php $contact_no = get_settings('contact_no'); ?>
                        <li><a href="tel:<?php echo $contact_no; ?>" style="color: #333;">Tel: <?php echo $contact_no; ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-div-contact-styl">
                <div class="footer-contact-icon">
                    <div class="footer-icon-div"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                </div>
                <div class="footer-contact-text">
                    <ul class="footer-contact-ul-style">
                        <?php $cell_no = get_settings('contact_cell_no'); ?>
                        <li><a href="tel:<?php echo $cell_no; ?>" style="color: #333;">Cell: <?php echo $cell_no; ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-div-contact-styl">
                <div class="footer-contact-icon">
                    <div class="footer-icon-div"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                </div>
                <div class="footer-contact-text">
                    <ul class="footer-contact-ul-style">                        
                        <li><?php echo get_settings('contact_email_addr'); ?></li>
                    </ul>
                </div>
            </div>
            <div class="footer-social-icon">
                <div class="foot-soc-icon-div col-1"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-2"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-3"><i class="fa fa-google-plus" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-4"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-5"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-6"><i class="fa fa-youtube" aria-hidden="true"></i></div>
            </div>
            <div class="clearfix"></div>
            <br><br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3608.812258535883!2d55.30872441544949!3d25.243247636024403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f42d4657c0f21%3A0x20ec659ccdfe5933!2sDubai+Private+Tour!5e0!3m2!1sen!2sus!4v1457163195889" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>

        </div>

    </div>
</div>
