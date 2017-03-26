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
        <label for="flightName">Flight Name<span class="red">*</span></label>      
        <input type="text" class="form-control" name="flightName" id="flightName" placeholder="Flight Name" value="">
    </div>
    <!-- <div class="form-group">
        <label for="terminalName">Terminal Number<span class="red">*</span></label>      
        <input type="text" class="form-control" name="terminalName" id="terminalName" placeholder="Terminal Name" value="">
    </div> -->
    <div class="row">
        <div class="form-group col-md-6 col-sm-6">
            <label for="flightArrival">Arrival Time<span class="red">*</span></label>     
            <select name="flightArrivalTime" class="form-control" id="flightArrival">  
                <?php for($i=1; $i<=24; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>            
        </div>
        <div class="form-group col-md-6 col-sm-6">
            <label for="flightArrival">&nbsp;</label>       
            <select class="form-control" name="flightArrivalUnit">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6 col-sm-6">
            <label for="flightDeparture">Departure Time</label>     
            <select name="flightDeparture" class="form-control" id="flightDeparture">  
                <?php for($i=1; $i<=24; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>            
        </div>
        <div class="form-group col-md-6 col-sm-6">
            <label for="flightDeparture">&nbsp;</label>       
            <select class="form-control" name="flightDepartureUnit">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
        </div>
    </div>   
</div>
<!-- hide and show for ship name -->
<div id="shipDetails" style="display: none;">
    <div class="form-group">
        <label for="shipName">Ship Name<span class="red">*</span></label>
        <input type="text" class="form-control" name="shipName" id="shipName" placeholder="Ship Name" value=""> 
    </div>
</div>
<!-- hide and show for MAll name -->
<div id="mallDetails" style="display: none;">
    <div class="form-group">
        <label for="shipName">Mall Name<span class="red">*</span></label>
        <input type="text" class="form-control" name="mallName" id="mallName" placeholder="Mall Name" value=""> 
    </div>
</div>

<!-- hide and show for residence details -->
<div id="residenceDetails" style="display: none;">    
    <div class="form-group">
        <label for="hotelAddress">Residence Address<span class="red">*</span></label>       
        <input type="text" class="form-control" name="start_lr_address" placeholder="Residence Address" value="">
    </div>
    <div class="form-group">
        <label for="hotelPhoneNo">Residence Telephone<span class="red">*</span></label>
        <input type="text" class="form-control" name="start_lr_phone" placeholder="Residence Telephone" value="">
    </div>
</div>

<!-- hide and show for restaurant details -->
<div id="restaurantDetails" style="display: none;">    
    <div class="form-group">
        <label for="shipName">Restaurant Name<span class="red">*</span></label>
        <input type="text" class="form-control" name="start_rest_name" placeholder="Restaurant Name" value=""> 
    </div>
    <div class="form-group">
        <label for="hotelAddress">Restaurant Address<span class="red">*</span></label>       
        <input type="text" class="form-control" name="start_rest_address" placeholder="Residence Address" value="">
    </div>
    <div class="form-group">
        <label for="hotelPhoneNo">Restaurant Telephone<span class="red">*</span></label>
        <input type="text" class="form-control" name="start_rest_phone" placeholder="Residence Telephone" value="">
    </div>
</div>

