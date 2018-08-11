$(document).ready(function () {

    // function updateOption(option) {
    //     $('#ui_settings').block({ message: null });
    //
    //
    //     if($(this).prop('checked')){
    //
    //         $.post( base_url+'settings/update_option/', { opt: option, val: "1" })
    //             .done(function( data ) {
    //                 $('#ui_settings').unblock();
    //                 location.reload();
    //             });
    //
    //     }
    //     else{
    //         $.post( base_url+'settings/update_option/', { opt: option, val: "0" })
    //             .done(function( data ) {
    //                 $('#ui_settings').unblock();
    //                 location.reload();
    //             });
    //     }
    // }






    var _url = $("#_url").val();
    $('#config_accounting').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "accounting", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "accounting", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

    $('#config_invoicing').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "invoicing", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "invoicing", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_kb').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "kb", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "kb", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

    $('#config_quotes').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "quotes", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "quotes", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_orders').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "orders", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "orders", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_documents').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "documents", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "documents", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_inventory').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "inventory", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "inventory", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });



    $('#config_leads').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "leads", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "leads", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_suppliers').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "suppliers", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "suppliers", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_support').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "support", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "support", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_purchase').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "purchase", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "purchase", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_tasks').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "tasks", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "tasks", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_calendar').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "calendar", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "calendar", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_hrm').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "hrm", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "hrm", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_companies').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "companies", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "companies", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_plugins').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "plugins", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "plugins", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

    $('#config_customer_custom_username').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "customer_custom_username", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "customer_custom_username", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_projects').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "projects", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "projects", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_add_fund').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "add_fund", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "add_fund", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_invoice_receipt_number').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "invoice_receipt_number", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "invoice_receipt_number", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $("#add_fund_minimum_deposit").on("blur",function(e){
        $('#ui_settings').block({ message: null });
        $.post(base_url + 'settings/update_option/',{ opt: "add_fund_minimum_deposit", val: $("#add_fund_minimum_deposit").val() },function (data) {
            if ($.isNumeric(data)) {
                $('#ui_settings').unblock();
                toastr.success(_L['Saved Successfully']);

            }

            else {
                $('#ui_settings').unblock();
                toastr.error(data);
            }
        })
    });

    $("#add_fund_maximum_deposit").on("blur",function(e){
        $('#ui_settings').block({ message: null });
        $.post(base_url + 'settings/update_option/',{ opt: "add_fund_maximum_deposit", val: $("#add_fund_maximum_deposit").val() },function (data) {
            if ($.isNumeric(data)) {
                $('#ui_settings').unblock();
                toastr.success(_L['Saved Successfully']);

            }

            else {
                $('#ui_settings').unblock();
                toastr.error(data);
            }
        })
    });


    $("#config_order_method").on("change",function(e){
        $('#ui_settings').block({ message: null });
        $.post(base_url + 'settings/update_option/',{ opt: "order_method", val: $("#config_order_method").val() },function (data) {
            if (data === 'ok') {
                $('#ui_settings').unblock();
                toastr.success(_L['Saved Successfully']);

            }

            else {
                $('#ui_settings').unblock();
                toastr.error(data);
            }
        })
    });


    $('#config_add_fund_client').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "add_fund_client", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "add_fund_client", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_allow_customer_registration').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "allow_customer_registration", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "allow_customer_registration", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

    $('#config_client_drive').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "client_drive", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "client_drive", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_show_business_number').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "show_business_number", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "show_business_number", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $("#label_business_number").on("blur",function(e){
        $('#ui_settings').block({ message: null });
        $.post(base_url + 'settings/update_option/',{ opt: "label_business_number", val: $("#label_business_number").val() },function (data) {
            toastr.success(_L['Saved Successfully']);
            $('#ui_settings').unblock();
        })
    });


    $('#config_fax_field').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "fax_field", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "fax_field", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_sms').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "sms", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "sms", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

});