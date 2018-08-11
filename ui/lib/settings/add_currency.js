$(function() {

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();

    $.fn.modal.defaults.width = '600px';

    var _url = $("#_url").val();

    $('#add_currency').on('click', function(e){

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load( _url + 'settings/modal_add_currency/', '', function(){

            $modal.modal();

        });
    });


    $modal.on('click', '.modal_submit', function(e){

        e.preventDefault();

        $modal.modal('loading');

        $.post( _url + "settings/add_currency_post/", $("#ib_modal_form").serialize())
            .done(function( data ) {

                if ($.isNumeric(data)) {

                    location.reload();

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });


    $(".cdelete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm(_L['are_you_sure'], function(result) {
            if(result){
                var _url = $("#_url").val();
                window.location.href = _url + "delete/currency/" + id + '/';
            }
        });
    });


    $(".cedit").click(function (e) {
        e.preventDefault();
        var id = this.id;

        $('body').modalmanager('loading');

        $modal.load( _url + 'settings/modal_add_currency/'+ id + '/', '', function(){

            $modal.modal();

        });

    });





});