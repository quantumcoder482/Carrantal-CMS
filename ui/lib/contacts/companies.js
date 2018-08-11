$(function() {



  //  var tab = $("#_active_tab").val();
    var tab = 'summary';


    function updateDiv(action,base_url,cid,cb){

        var $ibox_form = $('#ibox_form');
        $ibox_form.block({ message: block_msg });

        // if (window.history.replaceState) {
        //     window.history.replaceState( {} , '',  _url + 'contacts/view/'+ cid +'/' + action + '/' );
        // }


        $('.list-group a.active').removeClass('active');
        $("#"+action).addClass("active");



        $.post(base_url +  "contacts/company_" +action + '/', {
            cid: cid

        })
            .done(function (data) {

                $("#application_ajaxrender").html(data);
                $ibox_form.unblock();

                cb();


                $('.amount').autoNumeric('init');

            });

    }

    var cb  =  function cb(){



        switch(tab) {
            case "memo":

                ib_editor('#v_memo',400);



                break;





            default:

            //cb = function cb (){
            //    //  return;
            //};

        }




    };



    var _url = $("#_url").val();

    $.fn.modal.defaults.width = '700px';




    var $modal = $('#ajax-modal');

    $('[data-toggle="tooltip"]').tooltip();

    $('.add_company').on('click', function(e){

        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load( _url + 'contacts/modal_add_company/', '', function(){

            $modal.modal();

            $modal.css("width", "700px");
            $modal.css("margin-left", "-349px");

            $modal.modal();

            $("#ajax-modal .country").select2({
                theme: "bootstrap"
            });

        });
    });



    function sendEmail(email,loader) {

        $('body').modalmanager('loading');

        $modal.load( base_url + 'handler/email/' + email + '/', '', function(){

            $modal.modal();

            if(loader){
                $('body').modalmanager('loading');
            }

            ib_editor('#email_content',300,false);

        });

    }


    $modal.on('click', '.modal_submit', function(e){

        e.preventDefault();

        $modal.modal('loading');

        $.post( _url + "contacts/add_company_post/", $("#ib_modal_form").serialize())
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

    $modal.on('click', '.cedit', function(e){

        e.preventDefault();
        var id = this.id;

        $('body').modalmanager('loading');

        $modal.css("width", "700px");
        $modal.css("margin-left", "-349px");

        $modal.load( _url + 'contacts/modal_add_company/'+ id + '/', '', function(){

            $modal.modal();

            $('body').modalmanager('loading');

        });

    });


    $(".cdelete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm(_L['are_you_sure'], function(result) {
            if(result){
                var _url = $("#_url").val();
                window.location.href = _url + "delete/company/" + id + '/';
            }
        });
    });


    $(".cedit").click(function (e) {
        e.preventDefault();
        var id = this.id;

        $('body').modalmanager('loading');



        $modal.load( _url + 'contacts/modal_add_company/'+ id + '/', '', function(){
            $modal.modal();
            $modal.css("width", "700px");
            $modal.css("margin-left", "-349px");

        });

    });

    $(".cview").click(function (e) {
        $.fn.modal.defaults.width = '90%';
        e.preventDefault();
        var id = this.id;



        $('body').modalmanager('loading');

        $modal.load( base_url + 'contacts/modal_view_company/'+ id + '/', '', function(){

            $modal.modal();

            updateDiv('summary',base_url,id,cb);

        });

    });


    $modal.on('click', '.act_memo_update', function(e){

        e.preventDefault();

        $modal.modal('loading');

        $.post( base_url + "contacts/company_update_notes/", { id: $('#base_cid').val(), memo:$("#v_memo").val() })
            .done(function( data ) {

                $modal.modal('loading');
                toastr.success(data);

            });

    });







    $modal.on('click', '.li_memo', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'memo';

        updateDiv(tab,base_url,cid,cb);

    });


    $modal.on('click', '.li_customers', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'customers';

        updateDiv(tab,base_url,cid,cb);

    });

    $modal.on('click', '.li_summary', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'summary';

        updateDiv(tab,base_url,cid,cb);

    });


    $modal.on('click', '.li_summary', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'summary';

        updateDiv(tab,base_url,cid,cb);

    });

    $modal.on('click', '.li_invoices', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'invoices';

        updateDiv(tab,base_url,cid,cb);

    });


    $modal.on('click', '.li_quotes', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'quotes';

        updateDiv(tab,base_url,cid,cb);

    });


    $modal.on('click', '.li_orders', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'orders';

        updateDiv(tab,base_url,cid,cb);

    });


    $modal.on('click', '.li_files', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'files';

        updateDiv(tab,base_url,cid,cb);

    });


    $modal.on('click', '.li_transactions', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'transactions';

        updateDiv(tab,base_url,cid,cb);

    });


    $modal.on('click', '.li_tickets', function(e){

        var cid = $('#base_cid').val();

        e.preventDefault();

        tab = 'tickets';

        updateDiv(tab,base_url,cid,cb);

    });


    $modal.on('click', '.send_email', function(e){
        e.preventDefault();
        sendEmail($(this).html(),true);

    });

    $("#ib_data_table").on('click', '.send_email', function(e){
        e.preventDefault();
        sendEmail($(this).html(),false);
    });


    $modal.on('click', '#btn_send_email', function(e){

        e.preventDefault();
        $modal.modal('loading');
        $.post( base_url + "handler/send_email_post/", {
            to: $('#toemail').val(),
            subject: $('#subject').val(),
            message: tinyMCE.activeEditor.getContent()

        })
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








});