$(document).ready(function () {

    $('.amount').autoNumeric('init');



    $("#account").select2({
        theme: "bootstrap",
        language: {
            noResults: function () {
                return $("#_lan_no_results_found").val();
            }
        }
    });
    $("#cats").select2({
        theme: "bootstrap",
        language: {
            noResults: function () {
                return $("#_lan_no_results_found").val();
            }
        }
    });
    $("#pmethod").select2({
        theme: "bootstrap",
        language: {
            noResults: function () {
                return $("#_lan_no_results_found").val();
            }
        }
    });
    $(".s2").select2({
        theme: "bootstrap",
        language: {
            noResults: function () {
                return $("#_lan_no_results_found").val();
            }
        }
    });

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

    $("#a_hide").hide();
    $("#emsg").hide();
    $("#a_toggle").click(function(e){
        e.preventDefault();
        $("#a_hide").toggle( "slow" );
    });


    var trtype =  $('#trtype').val();
     trtype = trtype.toLowerCase();

    var _url = $("#_url").val();

    $("#submit").click(function (e) {
        e.preventDefault();
        $('#ibox_form').block({ message: null });
        var _url = $("#_url").val();
        $.post(_url + 'transactions/edit-post/', {



            date: $('#date').val(),

            id: $('#trid').val(),
            cats: $('#cats').val(),
            description: $('#description').val(),
            tags: $('#tags').val(),

            pmethod: $('#pmethod').val(),
            payee: $('#payee').val(),
            payer: $('#payer').val(),
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