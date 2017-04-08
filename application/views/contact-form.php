<form name="contactForm" id="contactForm" method="post" action="<?php url('contact-appln') ?>">
    <div class="form-group col-md-12 col-sm-6">
        <label for="name">Name<span class="red">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
    </div>
    <div class="form-group col-md-12 col-sm-6">
        <label for="email">Email<span class="red">*</span></label>
        <input type="email" class="form-control" id="contactEmail" name="email" placeholder="Your Email">
    </div>

    <div class="form-group col-md-12 col-sm-6">
        <label for="email">Confirm Email<span class="red">*</span></label>
        <input type="email" class="form-control" id="contactEmailConfirm" name="confirm_email" placeholder="Confirm Email">
    </div>
    <div class="form-group col-md-12 col-sm-6">
        <label for="name">Nationality</label>
        <select class="form-control" id="months" name="nationality">
            <option value="">Select Nationality</option>
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
        <select class="form-control" id="years" name="how_discover_us">
            <option value="">Select an Option</option>
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
                <select class="form-control" id="years" name="isd_code">
                    <option value="">Select Country Code</option>
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
                <input type="text" class="form-control" id="city" name="phone_number" placeholder="Cell Number">
            </div>
        </div>
    </div>

    <div class="form-group col-md-12 col-sm-12">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" rows="5" name="address"></textarea>
    </div>

    <div class="form-group col-md-12 col-sm-6">
        <label for="email">Subject</label>                    
        <select class="form-control" name="subject">
            <option value="Feedback">Feedback</option>
            <option value="Enquiry">Enquiry</option>
        </select>
    </div>
    <div class="form-group col-md-12 col-sm-12">
        <label for="address">Message</label>
        <textarea class="form-control" id="address" rows="5" name="message"></textarea>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn main-btn-style">Send</button>
    </div>

</form>