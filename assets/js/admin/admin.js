
function updateDisplayOrder(id,order) {
        console.log('ID: '+id+', Order: '+order);
//        $.ajax({
//            url: 'update_category_order',
//            type: "post",
//            data: {
//                'id': id,
//                'order': order
//            },
//            success: function (response) { }
//        });
    }
$(document).ready(function () {
        // ========== DRAG AND PLACE ORDERING ========
        var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function (i) {
                var order   = i + 1;
                var id      = $(this).data('id');
                $(this).html(order);
                updateDisplayOrder(id,order);
            });
        };

        $("#example1 tbody").sortable({
            helper: fixHelperModified,
            stop: updateIndex
        }).disableSelection();
        // ========== DRAG AND PLACE ORDERING ========
    

    // Prevent ente key submit
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

   
    //************* data tables ************
    var table = $("#example1").DataTable();
    
    $('#city_table').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });

    //************** MENU HIGHLITER
    var strarr = window.top.location.href;
    var loc = strarr.split("/").reverse();
    var admin_url = $("#admin_url").data('href');
    console.log(admin_url);
    if (loc[0]) {
        $("[href='" + admin_url + loc[0].split("?")[0] + "']").parents().removeClass("collapse");
        //$("[href='" + admin_url + loc[0].split("?")[0] + "']").addClass("active");
        $("[href='" + admin_url + loc[0].split("?")[0] + "']").parents("li").addClass("active");
    } else {
        $("[href='" + admin_url + "dashboard" + "']").parents("li").addClass("active");
    }
    //************** MENU HIGHLITER

    

    // Select all and delete
    $('#select_all').click(function (event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function () {
                this.checked = false;
            });
        }
    });

    
    //DATE PICKERS
    //Date picker - for events
    $('#event_date_from').datepicker({
        autoclose: true,
        startDate: new Date(),
        format: "yyyy-mm-dd"
    });
    $('#event_date_to').datepicker({
        autoclose: true,
        startDate: new Date(),
        format: "yyyy-mm-dd"
    });

});
//******* END OF DOCUMENT.READY() ***************//

//For select and type form fields
$(function () {
    //Initialize Select2 Elements - For keywords in product edit page
    $(".select2").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    // For attribute names
    $(".attribute_names").select2({
        tags: true
    });
});


