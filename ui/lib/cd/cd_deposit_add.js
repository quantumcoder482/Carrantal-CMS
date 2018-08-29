
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

    $('#customer').select2({
        theme:"bootstrap"
    });

    $('#repay_cycle_type').select2({
        theme:"bootstrap"
    });

    var _url = $("#_url").val();
    var ib_submit = $("#submit");
    var $ref_img = $("#ref_img");

    var upload_resp;


    // Vehicle Image upload
    var ib_file = new Dropzone("#upload_container",
        {
            url: _url + "cd/upload/",
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
        $('#balance').prop('disabled', false);
        e.preventDefault();
        $('#ibox_form').block({ message: null });

        $.post(_url + 'cd/post_deposit', $("#rform").serialize())
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