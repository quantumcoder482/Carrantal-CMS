
Dropzone.autoDiscover = false;

$(document).ready(function () {

    // modal loading part....

    var _url = $("#_url").val();

    $.fn.modal.defaults.width = '850px';

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.edit_deposit').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'cd/edit_deposit/' + id, '', function () {

            $modal.modal();

        });
    });

    $('.view_deposit').on('click', function (e) {

        var id = this.id;
        e.preventDefault();
        window.location.href = _url + "cd/view_deposit/" + id;
       
    });

    $(".cdelete").click(function (e) {

        e.preventDefault();
        id = this.id;
        var sure_msg = $('#sure_msg').val();

        bootbox.confirm(sure_msg, function (result) {

            if (result) {

                var _url = $("#_url").val();

                window.location.href = _url + "cd/del_deposit/" + id;
            }
        });
    });


    $modal.on('click', '.modal_submit', function (e) {
        $('#balance').prop('disabled',false);
        e.preventDefault();

        $modal.modal('loading');

        $.post(_url + "cd/post_deposit/", $("#rform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'cd/deposit_list/';

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });

    

});