
Dropzone.autoDiscover = false;

$(document).ready(function () {

    // modal loading part....

    var _url = $("#_url").val();

    $.fn.modal.defaults.width = '850px';

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.add_loan').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_loan/', '', function () {

            $modal.modal();

        });
    });

    $('.add_expense').on('click', function (e) {

        var id = $('#loan_id').val();
        var index = this.id;
        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_loan_expense/' + id + '/'+index, '', function () {

            $modal.modal();

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

                } else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });


    $modal.on('click', '.expense_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        var id=$('#eid').val();

        $.post(_url + "transactions/expense-post/", $("#eform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'vehicle/loan_view/'+id;

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });



});