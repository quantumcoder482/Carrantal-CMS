// Dropzone.autoDiscover = false;

$(document).ready(function () {
    
    $(".progress").hide();
    $("#emsg").hide();

  
    var _url = $("#_url").val();
    var ib_submit = $("#submit");
    var close=$("#close");

    var id = $('#contract_id').val();
    

    $('#vehicle').select2({
        theme: "bootstrap"
    });

    $('#deposit').select2({
        theme: "bootstrap"
    });

    $('#invoice').select2({
        theme: "bootstrap"
    });

    $('#contact').select2({
        theme: "bootstrap"
    });


    $('#contact').on('change', function(e){
        e.preventDefault();
        var id = $('#contract_id').val();
        var customer_id = $('#contact').val();
        var vehicle_id = $('#vehicle').val()
        window.location.href = _url + "cd/generate_contract/"+id+"/"+customer_id+"/"+vehicle_id;
    });

    $('#vehicle').on('change', function (e) {
        e.preventDefault();
        var id = $('#contract_id').val();
        var customer_id = $('#contact').val();
        var vehicle_id = $('#vehicle').val()
        window.location.href = _url + "cd/generate_contract/" + id + "/" + customer_id + "/" + vehicle_id;
    });


    ib_submit.click(function (e) {
        e.preventDefault();
        $('#ibox_form').block({ message: null });
        var id = $('#contract_id').val();
        $.post(_url + 'cd/post_generate_contract/', $("#rform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {

                    location.href = _url + "cd/generate_contract/"+id;
                }
                else {
                    $('#ibox_form').unblock();

                    $("#emsgbody").html(data);
                    $("#emsg").show("slow");
                } 
            });
    });

    

    // New Make/Model 

    $.fn.modal.defaults.width = '700px';

    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();


    $('.modal_edit_contract').on('click', function (e) {

        e.preventDefault();
        var id=this.id;
        $('body').modalmanager('loading');

        $modal.load(_url + 'cd/modal_edit_contract/'+id, '', function () {

            $modal.modal();

        });
    });

    
    $modal.on('click', '.modal_submit', function (e) {

        e.preventDefault();
        var id = $('#contract_id').val();

        $modal.modal('loading');

        $.post(_url + "cd/post_generate_contract/", $("#mform").serialize())
            .done(function (data) {

                if ($.isNumeric(data)) {
                    location.href = _url + "cd/generate_contract/" + id;
                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });


    $(".cdelete").click(function (e) {

        e.preventDefault();
        id = this.id;
        var sure_msg = $('#sure_msg').val();

        bootbox.confirm(sure_msg, function (result) {

            if (result) {

                var _url = $("#_url").val();

                window.location.href = _url + "cd/del_generated_contract/" + id;
            }
        });
    });





});