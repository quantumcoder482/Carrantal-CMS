
$(document).ready(function () {
   
    var _url = $("#_url").val();
    

    // Edit Make/Model 

    $.fn.modal.defaults.width = '700px';
    

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.add_make_model').on('click', function (e) {

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_mk/', '', function () {

            $modal.modal();

        });
    });


    $('.edit_make_model').on('click', function (e) {
        
        var id = this.id;
        
        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/modal_add_mk/'+id, '', function () {

            $modal.modal();

        });
    });

    
    $modal.on('click', '.modal_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        $.post(_url + "vehicle/update_mk_post/", $("#ib_modal_form").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'vehicle/m_k/';
                    // window.location = base_url + 'vehicle/add-vehicle/{$contact_type}/' + $("#group").val() + '/' + data;

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });

    $(".cdelete").click(function (e) {

        e.preventDefault();
        id=this.id;
        var sure_msg=$('#sure_msg').val();

        bootbox.confirm(sure_msg, function (result) {
            if (result) {
                
                var _url = $("#_url").val();
                
                window.location.href = _url + "vehicle/del_mk/" + id;
            }
        });
    });

   






});