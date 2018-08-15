
//Dropzone.autoDiscover = false;

$(document).ready(function () {
    

    $('#description').redactor(
        {
            minHeight: 200 // pixels
        }
    );

    var _url = $("#_url").val();

    var $vehicle_file = $("#vehicle_file");
    var $cert_file = $("#cert_file");

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


    

});