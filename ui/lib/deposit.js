Dropzone.autoDiscover = false;
$(document).ready(function () {

    $('[data-toggle="datepicker"]').datepicker();

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
    $("#payer").select2({
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

    //$('.amount').autoNumeric('init');
    // $("#a_hide").hide();
    $("#emsg").hide();
    // $("#a_toggle").click(function(e){
    //     e.preventDefault();
    //     $("#a_hide").toggle( "slow" );
    // });
    /*
    * File upload
    * */

    //Dropzone.options.myAwesomeDropzone = {
    //
    //    autoProcessQueue: false,
    //    uploadMultiple: true,
    //    parallelUploads: 100,
    //    maxFiles: 100,
    //
    //    // Dropzone settings
    //    init: function() {
    //        var myDropzone = this;
    //
    //        this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
    //            e.preventDefault();
    //            e.stopPropagation();
    //            myDropzone.processQueue();
    //        });
    //        this.on("sendingmultiple", function() {
    //        });
    //        this.on("successmultiple", function(files, response) {
    //        });
    //        this.on("errormultiple", function(files, response) {
    //        });
    //    }
    //
    //}

    var _url = $("#_url").val();
    // $('#tags').select2({
    //    tags: true,
    //    tokenSeparators: [','],
    //    createSearchChoice: function (term) {
    //        return {
    //            id: $.trim(term),
    //            text: $.trim(term) + ' (new tag)'
    //        };
    //    },
    //    ajax: {
    //        url: _url+'tags/income/',
    //        dataType: 'json',
    //        data: function(term, page) {
    //            return {
    //                q: term
    //            };
    //        },
    //        results: function(data, page) {
    //            return {
    //                results: data
    //            };
    //        }
    //    },
    //
    //    // Take default tags from the input value
    //    initSelection: function (element, callback) {
    //        var data = [];
    //
    //        function splitVal(string, separator) {
    //            var val, i, l;
    //            if (string === null || string.length < 1) return [];
    //            val = string.split(separator);
    //            for (i = 0, l = val.length; i < l; i = i + 1) val[i] = $.trim(val[i]);
    //            return val;
    //        }
    //
    //        $(splitVal(element.val(), ",")).each(function () {
    //            data.push({
    //                id: this,
    //                text: this
    //            });
    //        });
    //
    //        callback(data);
    //    },
    //
    //    // Some nice improvements:
    //
    //    // max tags is 3
    //    maximumSelectionSize: 15,
    //
    //    // override message for max tags
    //    formatSelectionTooBig: function (limit) {
    //        return "Max tags is " + limit;
    //    }
    //});

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
        $.post(_url + 'transactions/deposit-post/', {


            account: $('#account').val(),
            date: $('#date').val(),

            amount: $('#amount').val(),
            cats: $('#cats').val(),
            description: $('#description').val(),
            attachments: $('#attachments').val(),
            tags: $('#tags').val(),
            payer: $('#payer').val(),
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