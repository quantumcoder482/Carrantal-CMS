

$(document).ready(function () {
    
    // modal loading part....

    var _url = $("#_url").val();
  
    $.fn.modal.defaults.width = '900px';
    
    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.add_contract').on('click', function (e) {

        e.preventDefault();

        window.location.href = _url + "cd/add_contract/";


    });

    $('.generate_contract').on('click', function (e) {
        
        var id=this.id;

        e.preventDefault();
       
        window.location.href=_url+"cd/generate_contract/"+id;


    });

    $('.edit_contract').on('click', function (e) {
        
        var id = this.id;
        
        e.preventDefault();
        
        window.location.href = _url + "cd/add_contract/"+id;
        
    });


    $(".cdelete").click(function (e) {

        e.preventDefault();
        id=this.id;
        var sure_msg=$('#sure_msg').val();

        bootbox.confirm(sure_msg, function (result) {
           
            if (result) {
                
                var _url = $("#_url").val();
                
                window.location.href = _url + "cd/del_contract/" + id;
            }
        });
    });

   


});