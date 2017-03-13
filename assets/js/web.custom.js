/**
 * Created by sooraj on 2/1/17.
 */

//Scroll top js
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#scroll').fadeIn();
        } else {
            $('#scroll').fadeOut();
        }
    });
    $('#scroll').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

    //------------- TAB NAVIGATION ---------------
    $("#navItem1").on('click', function () {
        $('#content-wrap1').hide();
        $('#content-wrap2').hide();
        $('#content-wrap3').hide();
        $('#content-wrap4').hide();
        $('#content-wrap5').hide();
        $('#content-wrap1').fadeIn(1000);
    });
    $("#navItem2").on('click', function () {
        $('#content-wrap1').hide();
        $('#content-wrap2').hide();
        $('#content-wrap3').hide();
        $('#content-wrap4').hide();
        $('#content-wrap5').hide();
        $('#content-wrap2').fadeIn(1000);
    });
    $("#navItem3").on('click', function () {
        $('#content-wrap1').hide();
        $('#content-wrap2').hide();
        $('#content-wrap3').hide();
        $('#content-wrap4').hide();
        $('#content-wrap5').hide();
        $('#content-wrap3').fadeIn(1000);
    });
    $("#navItem4").on('click', function () {
        $('#content-wrap1').hide();
        $('#content-wrap2').hide();
        $('#content-wrap3').hide();
        $('#content-wrap4').hide();
        $('#content-wrap5').hide();
        $('#content-wrap4').fadeIn(1000);
    });
    $("#navItem5").on('click', function () {
        $('#content-wrap1').hide();
        $('#content-wrap2').hide();
        $('#content-wrap3').hide();
        $('#content-wrap4').hide();
        $('#content-wrap5').hide();
        $('#content-wrap5').fadeIn(1000);
    });

});



function fadeInFirstContent() {
    $('#content-wrap1').fadeIn(1000);

}
fadeInFirstContent();
//------------- TAB NAVIGATION ---------------

//------------- CALENDER ------------
$(function () {
    //calendar call function
    $('.datepicker').dcalendar();
    $('.datepicker').dcalendarpicker();

    var max_fields = 10; //maximum input boxes allowed
    var x = 1; //initlal text box count

    $('#add').click(function () {
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $("#addblock").before('<div class="col-md-12 col-sm-12" id="deceased">	<a href="#" class="remove_field" title="Remove">X</a>	<div class="form-group col-md-3 col-sm-3">            <label for="name">Name*</label>            <input type="text" class="form-control input-sm" id="name" placeholder="">        </div>	<div class="form-group col-md-3 col-sm-3">            <label for="gender">Gender*</label>            <input type="text" class="form-control input-sm" id="gender" placeholder="">        </div>	<div class="form-group col-md-3 col-sm-3">            <label for="age">Age*</label>            <input type="text" class="form-control input-sm" id="age" placeholder="">        </div>	<div class="form-group col-md-3 col-sm-3">            <label for="DOB">Date of Birth or Exact Birth Year*</label>            <input type="text" class="form-control input-sm datepicker" id="DOB' + x + '" placeholder="">        </div>	<div class="form-group col-md-3 col-sm-3">            <label for="DOD">Date of Death or Exact Death Year*</label>             <input type="text" class="form-control input-sm datepicker" id="DOD' + x + '" placeholder="">        </div>	<div class="form-group col-md-3 col-sm-3">            <label for="mother">Deceased Person\'s Mother Name*</label>            <input type="text" class="form-control input-sm" id="mother" placeholder="">        </div>	<div class="form-group col-md-3 col-sm-3">            <label for="father">Deceased Person\'s Father Name*</label>            <input type="text" class="form-control input-sm" id="father" placeholder="">        </div>	<div class="form-group col-md-3 col-sm-3">	    <label for="photo">Upload Photo*</label>	    <input type="file" id="photo">	    <p class="help-block">Please upload individual photo. Group photo is not acceptable.</p>	</div></div>');

            $('.datepicker').dcalendarpicker();
        } else {
            alert("Only 10 Names Allowed");
        }
    });
    $(document).on('click', '.remove_field', function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });

});
//------------- CALENDER ------------

//------------- Share button ------------
(function () {

    var shareButtons = document.querySelectorAll(".share-btn");

    if (shareButtons) {
        [].forEach.call(shareButtons, function (button) {
            button.addEventListener("click", function (event) {
                var width = 650,
                        height = 450;

                event.preventDefault();

                window.open(this.href, 'Share Dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=' + width + ',height=' + height + ',top=' + (screen.height / 2 - height / 2) + ',left=' + (screen.width / 2 - width / 2));
            });
        });
    }

})();
//------------- Share button ------------

//------------- Lightbox ------------
$(document).ready(function () {
    var $lightbox = $('#lightbox');

    $('[data-target="#lightbox"]').on('click', function (event) {
        var $img = $(this).find('img'),
                src = $img.attr('src'),
                alt = $img.attr('alt'),
                css = {
                    'maxWidth': $(window).width() - 100,
                    'maxHeight': $(window).height() - 100
                };

        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('img').attr('src', src);
        $lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);
    });

    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');

        $lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
});
//------------- Lightbox ------------

//list page
$(document).ready(function () {
    //left category navigation
    $('.cat-nav').on('click', function () {
        var url = $(this).data('url');
        window.location = url;
    });
    //left tour navigation
    $('.tour-nav').on('click', function () {
        var url = $(this).data('url');
        window.location = url;
    });
});
// == bootstrap form validation 
$(document).ready(function () {
    //========== Tour booking form validation ==============
    $('#selectPlanForm').bootstrapValidator({
        message: 'This value is not valid',        
        fields: {
            tour_date: {
                validators: {
                    notEmpty: {
                        message: 'The select tour-date'
                    }
                }
            },            
            pref_pickup_time: {
                validators: {
                    notEmpty: {
                        message: 'Please choose pickup time'
                    }
                }
            },
            pickup_location: {
                validators: {
                    notEmpty: {
                        message: 'Please choose pickup location'
                    }
                }
            },
            dropLocation: {
                validators: {
                    notEmpty: {
                        message: 'Please choose drop location'
                    }
                }
            },
            hotelName: {
                validators: {
                    notEmpty: {
                        message: 'Please enter hotel name'
                    }
                }
            },
            hotelAddress: {
                validators: {
                    notEmpty: {
                        message: 'Please enter hotel address'
                    }
                }
            },
            hotelPhoneNo: {
                validators: {
                    notEmpty: {
                        message: 'Please enter hotel phone number'
                    }
                }
            },
            endhotelName: {
                validators: {
                    notEmpty: {
                        message: 'Please enter end hotel name'
                    }
                }
            },
            endhotelAddress: {
                validators: {
                    notEmpty: {
                        message: 'Please enter end hotel address'
                    }
                }
            },
            endhotelPhoneNo: {
                validators: {
                    notEmpty: {
                        message: 'Please enter end hotel phone number'
                    }
                }
            },
            flightName: {
                validators: {
                    notEmpty: {
                        message: 'Please enter flight name'
                    }
                }
            },
            terminalNmae: {
                validators: {
                    notEmpty: {
                        message: 'Please enter terminal name'
                    }
                }
            },
            flightArrival: {
                validators: {
                    notEmpty: {
                        message: 'Please enter flight arrival time'
                    }
                }
            },
            shipName: {
                validators: {
                    notEmpty: {
                        message: 'Please enter ship name'
                    }
                }
            },
            preferedguide: {
                validators: {
                    notEmpty: {
                        message: 'Please choose preferred guide language'
                    }
                }
            },
            currencyMode: {
                validators: {
                    notEmpty: {
                        message: 'Please choose payment mode'
                    }
                }
            },
            adultNo: {
                validators: {
                    notEmpty: {
                        message: 'Please enter number of adults'
                    },
                    integer:{
                        message: 'Please enter a number'
                    }
                    
                }
            },
            childNo: {
                validators: {
                    integer:{
                        message: 'Please enter a number'
                    }
                    
                }
            },
            infantNo: {
                validators: {
                    integer:{
                        message: 'Please enter a number'
                    }
                    
                }
            },            
            cell_no1: {
                validators: {
                    integer:{
                        message: 'This is not a number'
                    }
                    
                }
            },
            cell_no2: {
                validators: {
                    integer:{
                        message: 'This is not a number'
                    }
                    
                }
            },
            firstName: {
                validators: {
                    notEmpty: {
                        message: 'Please enter first name'
                    }
                }
            },
            lastName: {
                validators: {
                    notEmpty: {
                        message: 'Please enter last name'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a valid email address'
                    },
                    emailAddress: {
                        message: 'The is not a valid email address'
                    }
                }
            },
            confirm_email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter confirm email address'
                    },
                    emailAddress: {
                        message: 'Please enter confirm email address'
                    }
                }
            },
            nationality: {
                validators: {
                    notEmpty: {
                        message: 'Please choose nationality'
                    },                    
                }
            },
            countryCode1: {
                validators: {
                    notEmpty: {
                        message: 'Please choose country code'
                    },                    
                }
            },
            cell_no1: {
                validators: {
                    notEmpty: {
                        message: 'Please enter cell no'
                    },                    
                }
            },
            howfind: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },                    
                }
            },
        }
    });

    //========== Tourist visa form validation ==============
    $('#visaForm').bootstrapValidator({
        message: 'This value is not valid',        
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your name'
                    }
                }
            },            
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a valid email address'
                    },
                    emailAddress: {
                        message: 'The is not a valid email address'
                    }
                }
            },
            isd_code: {
                validators: {
                    notEmpty: {
                        message: 'Please choose an isd code'
                    }
                }
            },  
            contact_no: {
                validators: {
                    notEmpty: {
                        message: 'Please enter contact number'
                    }
                }
            },  
            nationality: {
                validators: {
                    notEmpty: {
                        message: 'Please choose ypur nationality'
                    }
                }
            },
            arrival_date: {
                validators: {
                    notEmpty: {
                        message: 'Please choose arrival date'
                    }
                }
            },
            departure_date: {
                validators: {
                    notEmpty: {
                        message: 'Please choose departure date'
                    }
                }
            },
            people: {
                validators: {
                    notEmpty: {
                        message: 'Please enter No.of people'
                    }
                }
            },
            how_discover_us: {
                validators: {
                    notEmpty: {
                        message: 'Please choose an option'
                    },
                    
                }
            },
            hotel_booking: {
                validators: {
                    notEmpty: {
                        message: 'Please upload your hotel booking'
                    }
                }
            },
            flight_ticket: {
                validators: {
                    notEmpty: {
                        message: 'Please upload your flight ticket'
                    }
                }
            },
            
            passport_copy: {
                validators: {
                    notEmpty: {
                        message: 'Please upload passport copy'
                    }
                }
            },            
        }
    });

    //========== Ask question form validation ==============
    $('#askmeForm').bootstrapValidator({
        message: 'This value is not valid',        
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your first name'
                    }
                }
            },  
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your last name'
                    }
                }
            },            
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a valid email address'
                    },
                    emailAddress: {
                        message: 'The is not a valid email address'
                    }
                }
            },
            nationality: {
                validators: {
                    notEmpty: {
                        message: 'Please select ypur nationality'
                    }
                }
            },
            message: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a message/question'
                    }
                }
            },
                   
        }
    });

    //========== Ask question form validation ==============
    $('#reviewForm').bootstrapValidator({
        message: 'This value is not valid',        
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your name'
                    }
                }
            },                      
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a valid email address'
                    },
                    emailAddress: {
                        message: 'The is not a valid email address'
                    }
                }
            },
            rating: {
                validators: {
                    notEmpty: {
                        message: 'Please select ypur rating'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'Please select your counry'
                    }
                }
            },
            comments: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a comment'
                    }
                }
            },
                   
        }
    });

    //contact form application
    $('#contactForm').bootstrapValidator({
        message: 'This value is not valid',        
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your name'
                    }
                }
            },        
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a valid email address'
                    },
                    emailAddress: {
                        message: 'The is not a valid email address'
                    }
                }
            },
            confirm_email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter confirm email address'
                    },
                    emailAddress: {
                        message: 'Please enter confirm email address'
                    },
                    identical: {
                        field: 'email',
                        message: 'Email and confirm email should be same'
                    }

                }
            },    
            nationality: {
                validators: {
                    notEmpty: {
                        message: 'Please select your nationality'
                    }
                }
            },
            how_discover_us: {
                validators: {
                    notEmpty: {
                        message: 'Please select an option'
                    }
                }
            },
            isd_code: {
                validators: {
                    notEmpty: {
                        message: 'Please select code'
                    }
                }
            },
            phone_number: {
                validators: {
                    notEmpty: {
                        message: 'Please enter cell number'
                    }
                }
            },            
        }
    });



});
// == bootstrap form validation 
function resetPickupLocationDiv(){

}
// == Tour form management
$(document).ready(function() {
    $("#pickupLocation").on("change",function(){    //pickup location onchange
        var id = $(this).val();
        if(id != '1'){
            $("#hotelDetails1").hide();
        }
        if(id == '1'){
            $("#shipDetails").hide();
            $("#flightDetails1").hide();
            $("#mallDetails").hide();
            $("#hotelDetails1").show();
        }
        else if(id == '2' || id == '3' || id == '4'){
            $("#hotelDetails1").hide();
            $("#shipDetails").hide();
            $("#mallDetails").hide();
            $("#flightDetails1").show();
        }
        else if(id == '5' || id == '6' || id == '7'){
            $("#hotelDetails1").hide();
            $("#flightDetails1").hide();
            $("#mallDetails").hide();
            $("#shipDetails").show();
        }
        else if(id == '11'){
            $("#hotelDetails1").hide();
            $("#flightDetails1").hide();
            $("#shipDetails").hide();
            $("#mallDetails").show();
        }
        else{
            $("#hotelDetails1").hide();
            $("#flightDetails1").hide();
            $("#shipDetails").hide();
            $("#mallDetails").hide();
        }
    });

    $("#dropLocation").on("change",function(){    //drop location onchange
        var id = $(this).val();
        if(id=='1'){
             $("#endloc").show();
        }
        else{
            $("#endloc").hide();
        }
    });

    //Admin section - booking details
    $(".booking_details").on('click',function(){
        var booking_id = $(this).data('id');
        var post_url = "";
        $.ajax({
            url: post_url,
            type: "post",
            data: { 'booking_id':data_id },
            success: function (response) {
                
            }
        });
    });

    //Disable cut/copy/paste
      $('#contactEmail').bind("cut copy paste",function(e) {
          e.preventDefault();
          alert("Sory! This option is not available.");
      });
      $('#contactEmailConfirm').bind("cut copy paste",function(e) {
          e.preventDefault();
          alert("Sory! This option is not available.");
      });


});
// == Tour form management

//------------ dropzone ---------------

//------------ dropzone ---------------

