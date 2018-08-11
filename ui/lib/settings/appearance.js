$(document).ready(function () {



    var _url = $("#_url").val();



    // $('#config_animate').change(function() {
    //
    //     $('#ui_settings').block({ message: null });
    //
    //
    //     if($(this).prop('checked')){
    //
    //         $.post( _url+'settings/update_option/', { opt: "animate", val: "1" })
    //             .done(function( data ) {
    //                 $('#ui_settings').unblock();
    //                 location.reload();
    //             });
    //
    //     }
    //     else{
    //         $.post( _url+'settings/update_option/', { opt: "animate", val: "0" })
    //             .done(function( data ) {
    //                 $('#ui_settings').unblock();
    //                 location.reload();
    //             });
    //     }
    // });


    $('#config_show_country_flag').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "show_country_flag", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "show_country_flag", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });



    $('#config_rtl').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "rtl", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "rtl", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

    $('#config_mininav').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "mininav", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "mininav", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

    $('#config_hide_footer').change(function() {

        $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "hide_footer", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "hide_footer", val: "0" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });



    var $contentAnimation = $("#contentAnimation");


    $contentAnimation.change(function() {

        $('#ui_settings').block({ message: null });

        $.post( _url+'settings/update_option/', { opt: "contentAnimation", val: $contentAnimation.val() })
            .done(function( data ) {
                $('#ui_settings').unblock();
                location.reload();
            });


    });

    var $contact_set_view_mode = $("#contact_set_view_mode");

    $contact_set_view_mode.change(function() {

        window.location = base_url + 'contacts/set_view_mode/' + $contact_set_view_mode.val() + '/';


    });



});