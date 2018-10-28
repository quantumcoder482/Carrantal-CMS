
Dropzone.autoDiscover = false;

$(document).ready(function () {

    // modal loading part....

    var _url = $("#_url").val();

    $.fn.modal.defaults.width = '850px';

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.edit_loan').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_loan/' + id, '', function () {

            $modal.modal();

        });
    });

    $('.add_loan').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_loan/', '', function () {

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

    $('.loan_view').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        window.location.href = _url + "vehicle/loan_view/" + id;

    });

    $('.view_ref_img').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/view_img/' + id + '/loan', '', function () {

            $modal.modal();

        });

    });

    $modal.on('click', '.view_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        window.location = base_url + 'vehicle/loans/';

    });

    $(".cdelete").click(function (e) {

        e.preventDefault();
        id = this.id;
        var sure_msg = $('#sure_msg').val();

        bootbox.confirm(sure_msg, function (result) {

            if (result) {

                var _url = $("#_url").val();

                window.location.href = _url + "vehicle/del_loan/" + id;
            }
        });
    });


    $modal.on('click', '.modal_submit', function (e) {
        $('#total_days').prop('disabled', false);
        e.preventDefault();

        $modal.modal('loading');

        $.post(_url + "vehicle/post_loan/", $("#rform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'vehicle/loans/';

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });



});