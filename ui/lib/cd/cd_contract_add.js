// Dropzone.autoDiscover = false;

$(document).ready(function () {
    
    $(".progress").hide();
    $("#emsg").hide();
    ib_editor('.sysedit');
  
    var _url = $("#_url").val();
    var ib_submit = $("#submit");
    var close=$("#close");

    $('#insert_name').click(function(){
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{name}}</span>");
    });
    $('#insert_address').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{address}}</span>");
    });
    $('#insert_nric').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{nric}}</span>");
    });
    $('#insert_contact').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{contact}}</span>");
    });
    $('#insert_date').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{date}}</span>");
    });
    $('#insert_passdate').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{pass_date}}</span>");
    });
    $('#insert_depositamount').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{deposit_amount}}</span>");
    });
    $('#insert_vstartdate').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{v_start_date}}</span>");
    });
    $('#insert_venddate').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{v_end_date}}</span>");
    });
    $('#insert_vduration').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{v_duration}}</span>");
    });
    $('#insert_vmakemodel').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{v_make_model}}</span>");
    });
    $('#insert_vehiclenum').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{vehicle_no}}</span>");
    });
    $('#insert_invoiceamount').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{invoice_amount}}</span>");
    });
    $('#insert_deposit').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{deposit}}</span>");
    });
    $('#insert_depositbalance').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{deposit_balance}}</span>");
    });
    $('#insert_depositrepayamount').click(function () {
        tinymce.get("content").execCommand('mceInsertContent', false, "<span style='color:#3366ff;'>{{deposit_repay_amount}}</span>");
    });
   


    ib_submit.click(function (e) {
        e.preventDefault();
        $('#ibox_form').block({ message: null });

        $.post(_url + 'cd/post_contract/', $("#rform").serialize())
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

    close.click(function (e) {
        e.preventDefault();
        $('#ibox_form').block({ message: null });

        $.post(_url + 'cd/post_contract/', $("#rform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location.href=_url+"cd/contract_list/";
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

                    window.location = base_url + 'vehicle/add_vehicle/';
                    // window.location = base_url + 'vehicle/add-vehicle/{$contact_type}/' + $("#group").val() + '/' + data;

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });





});