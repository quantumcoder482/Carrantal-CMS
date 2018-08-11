Dropzone.autoDiscover = false;
$(document).ready(function () {
    //$('.amount').autoNumeric('init');

    $("#account").select2({
            theme: "bootstrap",
            language: {
                noResults: function () {
                    return $("#_lan_no_results_found").val();
                }
            }
        }
    );
    $("#cats").select2({
            theme: "bootstrap",
            language: {
                noResults: function () {
                    return $("#_lan_no_results_found").val();
                }
            }
        }
    );
    $("#pmethod").select2({
            theme: "bootstrap",
            language: {
                noResults: function () {
                    return $("#_lan_no_results_found").val();
                }
            }
        }
    );
    $("#payee").select2({
            theme: "bootstrap",
            language: {
                noResults: function () {
                    return $("#_lan_no_results_found").val();
                }
            }
        }
    );

    $('#tags').select2({
        tags: true,
        tokenSeparators: [','],
        theme: "bootstrap",
        language: {
            noResults: function () {
                return $("#_lan_no_results_found").val();
            }
        }
    });



    $("#emsg").hide();

    var _url = $("#_url").val();




    //  file attach

    var upload_resp;

    var $ib_form_submit = $("#submit");


    var ib_file = new Dropzone("#upload_container",
        {
            url: _url + "transactions/handle_attachment/",
            maxFiles: 1,
            acceptedFiles: "image/*,application/pdf"
        }
    );


    ib_file.on("sending", function() {

        $ib_form_submit.prop('disabled', true);

    });

    ib_file.on("success", function(file,response) {

        $ib_form_submit.prop('disabled', false);

        upload_resp = response;

        if(upload_resp.success == 'Yes'){

            toastr.success(upload_resp.msg);
            // $file_link.val(upload_resp.file);
            // files.push(upload_resp.file);
            //
            // console.log(files);

            $('#attachments').val(function(i,val) {
                return val + (!val ? '' : ',') + upload_resp.file;
            });


        }
        else{
            toastr.error(upload_resp.msg);
        }







    });


    $ib_form_submit.click(function (e) {
        e.preventDefault();
        $('#ibox_form').block({ message: null });
        var _url = $("#_url").val();
        $.post(_url + 'transactions/expense-post/', {


            account: $('#account').val(),
            date: $('#date').val(),

            amount: $('#amount').val(),
            sub_type: $('#sub_type').val(),
            cats: $('#cats').val(),
            description: $('#description').val(),
            attachments: $('#attachments').val(),
            tags: $('#tags').val(),
            payee: $('#payee').val(),
            pmethod: $('#pmethod').val(),
            ref: $('#ref').val()

        })
            .done(function (data) {
                var sbutton = $("#submit");
                var _url = $("#_url").val();
                if ($.isNumeric(data)) {

                    location.reload();
                }
                else {
                    $('#ibox_form').unblock();
                    var body = $("html, body");
                    body.animate({scrollTop:0}, '1000', 'swing');
                    $("#emsgbody").html(data);
                    $("#emsg").show("slow");
                }
            });
    });
});