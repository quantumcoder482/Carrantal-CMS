
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

        $modal.load(_url + 'vehicle/modal_insurance_expense/' + id, '', function () {

            $modal.modal();

        });

    });

    $('.renew').on('click', function (e) {
        var id = this.id;
        e.preventDefault();
        var _url = $('#_url').val();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_insurance/' + id + '/clone', '', function () {

            $modal.modal();

        });


    });

    $('.view_ref_img').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/view_img/' + id + '/insurance', '', function () {

            $modal.modal();

        });

    });

    $modal.on('click', '.view_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        window.location = base_url + 'vehicle/insurance/';

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
        $('#insurance_total').prop('disabled',false);
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

    $modal.on('click', '.expense_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        $.post(_url + "transactions/expense-post/", $("#eform").serialize())
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