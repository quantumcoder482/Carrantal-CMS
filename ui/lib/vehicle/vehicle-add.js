Dropzone.autoDiscover = false;

$(document).ready(function () {
    
    $(".progress").hide();
    $("#emsg").hide();
    $('#description').redactor(
        {
            minHeight: 200 // pixels
        }
    );
    var $vehicle_type = $('#vehicle_type');

    $vehicle_type.select2({
        theme: "bootstrap"
    });

    var _url = $("#_url").val();
    var ib_submit = $("#submit");

    var $vehicle_file= $("#vehicle_file");
    var $cert_file=$("#cert_file");

    var upload_resp;


    // Vehicle Image upload
    var ib_file1 = new Dropzone("#upload_container1",
        {
            url: _url + "vehicle/upload/",
            maxFiles: 1
        }
    );

    ib_file1.on("sending", function () {

        ib_submit.prop('disabled', true);

    });

    ib_file1.on("success", function (file, response) {

        ib_submit.prop('disabled', false);

        upload_resp = response;

        if (upload_resp.success == 'Yes') {

            toastr.success(upload_resp.msg);
            $vehicle_file.val(upload_resp.file);
        }
        else {
            toastr.error(upload_resp.msg);
        }

    });

    // Cert file upload
    var ib_file2 = new Dropzone("#upload_container2",
        {
            url: _url + "vehicle/upload/",
            maxFiles: 1
        }
    );

    ib_file2.on("sending", function () {

        ib_submit.prop('disabled', true);

    });

    ib_file2.on("success", function (file, response) {

        ib_submit.prop('disabled', false);

        upload_resp = response;

        if (upload_resp.success == 'Yes') {

            toastr.success(upload_resp.msg);
            $cert_file.val(upload_resp.file);

        }
        else {
            toastr.error(upload_resp.msg);
        }
    });


    ib_submit.click(function (e) {
        e.preventDefault();
        $('#ibox_form').block({ message: null });

        $.post(_url + 'vehicle/post-vehicle/', $("#rform").serialize())
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



    // New Make/Model 

    $.fn.modal.defaults.width = '700px';

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();

    $('.add_make_model').on('click', function (e) {

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_mk/', '', function () {

            $modal.modal();

        });
    });

    
    $modal.on('click', '.modal_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        $.post(_url + "vehicle/update_mk_post/", $("#ib_modal_form").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'vehicle/add-vehicle/';
                    // window.location = base_url + 'vehicle/add-vehicle/{$contact_type}/' + $("#group").val() + '/' + data;

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });





});