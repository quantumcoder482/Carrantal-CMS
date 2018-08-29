
Dropzone.autoDiscover = false;

$(document).ready(function () {

    // modal loading part....

    var _url = $("#_url").val();

    $.fn.modal.defaults.width = '850px';

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.first_deposit').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'cd/modal_deposit/'+id+"/firstdeposit", '', function () {

            $modal.modal();

        });
    });

    $('.add_deposit').on('click', function (e) {

        var id = this.id;

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'cd/modal_deposit/' + id, '', function () {

            $modal.modal();

        });

    });


    $modal.on('click', '.deposit_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        var id=$('#did').val();

        $.post(_url + "transactions/deposit-post/", $("#eform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'cd/view_deposit/'+id;

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });



});