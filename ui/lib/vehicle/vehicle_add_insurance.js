
Dropzone.autoDiscover = false;

$(document).ready(function () {
    
    $(".progress").hide();
    $("#emsg").hide();
    $('#description').redactor(
        {
            minHeight: 200 // pixels
        }
    );
    var $vehicle_num = $('#vehicle_num');

    $vehicle_num.select2({
        theme: "bootstrap"
    });

    $('#expiry_todate').select2({
        theme:"bootstrap"
    });

    var _url = $("#_url").val();
    var ib_submit = $("#submit");
    var $ref_img = $("#ref_img");

    var insurance_amount = $('#insurance_amount');
    var rebate_amount = $('#rebate_amount');
    var insurance_total = $('#insurance_total');

    insurance_amount.on("keyup", function () {
        var amount = insurance_amount.val().slice(2);
        var rebate = rebate_amount.val().slice(2);
        amount = parseFloat(amount.replace(',', ''));
        
        if (rebate) {
            rebate = parseFloat(rebate.replace(',', ''));
        } else {
            rebate = parseFloat(0);
        }
        if (!isNaN(amount - rebate)) {
            insurance_total.val("$ " + (amount - rebate));
        }

    });
    rebate_amount.on("keyup", function () {
        var amount = insurance_amount.val().slice(2);
        var rebate = rebate_amount.val().slice(2);
        rebate = parseFloat(rebate.replace(',', ''));
        if (amount) {
            amount = parseFloat(amount.replace(',', ''));
        } else {
            amount = parseFloat(0);
        }
        if (!isNaN(amount - rebate)) {
            insurance_total.val("$ " + (amount - rebate));
        }

    });

    var upload_resp;


    // Vehicle Image upload
    var ib_file = new Dropzone("#upload_container",
        {
            url: _url + "vehicle/upload/",
            maxFiles: 1
        }
    );

    ib_file.on("sending", function () {

        ib_submit.prop('disabled', true);

    });

    ib_file.on("success", function (file, response) {

        ib_submit.prop('disabled', false);

        upload_resp = response;

        if (upload_resp.success == 'Yes') {

            toastr.success(upload_resp.msg);
            $ref_img.val(upload_resp.file);
        }
        else {
            toastr.error(upload_resp.msg);
        }

    });


    ib_submit.click(function (e) {
        $('#insurance_total').prop('disabled', false);
        e.preventDefault();
        $('#ibox_form').block({ message: null });

        $.post(_url + 'vehicle/post_insurance', $("#rform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    location.reload();
                }
                else {
                    $('#ibox_form').unblock();

                    $("#emsgbody").html(data);
                    $("#emsg").show("slow");
                }
            });
    });


});