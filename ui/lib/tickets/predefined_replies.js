$(function() {

    var _url = $("#_url").val();

    var $modal_add_item = $("#modal_add_item");

    var $message = $("#message");

    $modal_add_item.on('shown.bs.modal', function() {
        $message.redactor({
            minHeight: 200,
            paragraphize: false,
            replaceDivs: false,
            linebreaks: true
        });
    });

    var $btn_modal_action = $("#btn_modal_action");


    $btn_modal_action.on('click', function(e) {
        e.preventDefault();

        $modal_add_item.block({ message: block_msg });
        $.post( _url + "tickets/admin/predefined_replies_post/", $("#ib_modal_form").serialize())
            .done(function( data ) {

                if ($.isNumeric(data)) {

                    location.reload();

                }

                else {
                    $modal_add_item.unblock();
                    toastr.error(data);
                }

            });

    });


    $(".cdelete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm('Are you sure?', function(result) {
            if(result){

                window.location.href = _url + "tickets/admin/predefined_replies_delete/" + id + "/";
            }
        });
    });



});