$(document).ready(function () {

    var _url = $("#_url").val();





    $('#cid').select2({
        theme: "bootstrap",
        language: {
            noResults: function () {
                return $("#_lan_no_results_found").val();
            }
        }
    })
        .on("change", function(e) {

        });

    var $pid = $("#pid");

    var $price = $("#price");

    function update_ps(pid) {

        $.get( _url + "ps/json_get/"+pid, function( data ) {
            if(data){



                $price.autoNumeric('set', data.sales_price);


            }
        });

    }


    $pid.select2({
        theme: "bootstrap",
        language: {
            noResults: function () {
                return $("#_lan_no_results_found").val();
            }
        }
    })
        .on("change", function(e) {


            update_ps($pid.val());



        });



    var $submit = $("#submit");
    var $ibox_form = $('#ibox_form');

    $submit.on('click', function(e) {
        e.preventDefault();

        $ibox_form.block({ message:block_msg });

        $.post( _url + "orders/post/", $("#ib_form").serialize())
            .done(function( data ) {

                if ($.isNumeric(data)) {


                    window.location = _url + 'orders/view/' + data;

                }

                else {
                    $ibox_form.unblock();
                    toastr.error(data);
                }

            });

    });




});