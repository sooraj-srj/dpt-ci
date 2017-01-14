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
//
//------------ dropzone ---------------

//------------ dropzone ---------------

