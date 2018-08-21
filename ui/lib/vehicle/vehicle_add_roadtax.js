
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
    var upload_resp;

    var roadtax_amount=$('#roadtax_amount');
    var rebate_amount=$('#rebate_amount');
    var roadtax_total=$('#roadtax_total');

    roadtax_amount.on("keyup", function(){
        var amount=roadtax_amount.val().slice(2);
        var rebate = rebate_amount.val().slice(2);
        amount = parseFloat(amount.replace(',', ''));
        if(rebate){
            rebate = parseFloat(rebate.replace(',', ''));
        }else{
            rebate=parseFloat(0);
        }
        if(!isNaN(amount-rebate)){
            roadtax_total.val("$ " + (amount - rebate));
        }

    });
    rebate_amount.on("keyup",function(){
        var amount = roadtax_amount.val().slice(2);
        var rebate = rebate_amount.val().slice(2);
        rebate = parseFloat(rebate.replace(',', ''));
        if (amount) {
            amount = parseFloat(amount.replace(',', ''));
        } else {
            amount = parseFloat(0);
        }
        if (!isNaN(amount - rebate)) {
            roadtax_total.val("$ "+(amount - rebate));
        }

    });
    

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
        e.preventDefault();
        $('#ibox_form').block({ message: null });

        $.post(_url + 'vehicle/post_roadtax', $("#rform").serialize())
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