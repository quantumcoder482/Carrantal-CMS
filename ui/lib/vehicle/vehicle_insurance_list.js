
Dropzone.autoDiscover = false;

$(document).ready(function () {

    // modal loading part....

    var _url = $("#_url").val();

    $.fn.modal.defaults.width = '850px';

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.edit_insurance').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_insurance/' + id, '', function () {

            $modal.modal();

        });
    });

    $('.add_insurance').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_insurance/', '', function () {

            $modal.modal();

        });
    });

    $('.add_expense').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/add_expense/' + id, '', function () {

            $modal.modal();

        });

    });


    $(".cdelete").click(function (e) {

        e.preventDefault();
        id = this.id;
        var sure_msg = $('#sure_msg').val();

        bootbox.confirm(sure_msg, function (result) {

            if (result) {

                var _url = $("#_url").val();

                window.location.href = _url + "vehicle/del_insurance/" + id;
            }
        });
    });


    $modal.on('click', '.modal_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        $.post(_url + "vehicle/post_insurance/", $("#rform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'vehicle/insurance/';

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });



});