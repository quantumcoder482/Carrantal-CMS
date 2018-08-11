$(document).ready(function () {

    $("#faccount").select2({
        theme: "bootstrap"
    });
    $("#taccount").select2({
        theme: "bootstrap"
    });
    $("#pmethod").select2({
        theme: "bootstrap"
    });


    $('#tags').select2({
        tags: true,
        tokenSeparators: [','],
        theme: "bootstrap"
    });

    $("#a_hide").hide();
    $("#emsg").hide();
    $("#a_toggle").click(function(e){
        e.preventDefault();
        $("#a_hide").toggle( "slow" );
    });


    var _url = $("#_url").val();




    $("#submit").click(function (e) {
        e.preventDefault();
        $('#ibox_form').block({ message: null });
        var _url = $("#_url").val();
        $.post(_url + 'transactions/transfer-post/', {


            faccount: $('#faccount').val(),
            taccount: $('#taccount').val(),
            date: $('#date').val(),

            amount: $('#amount').val(),

            description: $('#description').val(),
            tags: $('#tags').val(),

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