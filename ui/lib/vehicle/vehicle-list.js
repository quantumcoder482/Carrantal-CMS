
//Dropzone.autoDiscover = false;

$(document).ready(function () {
    
    // modal loading part....

    var _url = $("#_url").val();
  
    $.fn.modal.defaults.width = '900px';
    
    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.edit_vehicle').on('click', function (e) {
        
        var id = this.id;
        
        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url + 'vehicle/edit-vehicle/'+id, '', function () {

            $modal.modal();

        });
    });

    $('.view_cert_img').on('click',function(e){
        
        var id=this.id;
        
        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load(_url+'vehicle/view-cert/'+id, '', function(){

            $modal.modal();

        });

    });
    
    $modal.on('click', '.modal_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        $.post(_url + "vehicle/post-vehicle/", $("#rform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'vehicle/list-vehicle/';
                   
                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });


    $modal.on('click', '.view_submit', function (e) {

        e.preventDefault();

        $modal.modal('loading');

        window.location = base_url + 'vehicle/list-vehicle/';

    });



    $(".cdelete").click(function (e) {

        e.preventDefault();
        id=this.id;
        var sure_msg=$('#sure_msg').val();

        bootbox.confirm(sure_msg, function (result) {
           
            if (result) {
                
                var _url = $("#_url").val();
                
                window.location.href = _url + "vehicle/del_vehicle/" + id;
            }
        });
    });

   


});