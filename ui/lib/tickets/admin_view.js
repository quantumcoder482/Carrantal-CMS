Dropzone.autoDiscover = false;
$(function() {

    var _url = $("#_url").val();

    var $ib_form_submit = $("#ib_form_submit");

    var $create_ticket = $("#create_ticket");


    ib_editor("#content",200);

    var $modal = $('#ajax-modal');

    var reply_type = 'public';


    var upload_resp;


    var ib_file = new Dropzone("#upload_container",
        {
            url: _url + "tickets/client/upload_file/",
            maxFiles: 10,
            acceptedFiles: "image/jpeg,image/png,image/gif"
        }
    );

    ib_file.on("sending", function() {

        $ib_form_submit.prop('disabled', true);

    });

    ib_file.on("success", function(file,response) {

        $ib_form_submit.prop('disabled', false);

        upload_resp = response;

        if(upload_resp.success == 'Yes'){

            toastr.success(upload_resp.msg);
            // $file_link.val(upload_resp.file);
            // files.push(upload_resp.file);
            //
            // console.log(files);

            $('#attachments').val(function(i,val) {
                return val + (!val ? '' : ',') + upload_resp.file;
            });


        }
        else{
            toastr.error(upload_resp.msg);
        }







    });



    $ib_form_submit.on('click', function(e) {
        e.preventDefault();
        $create_ticket.block({ message: block_msg });
        $.post( _url + "tickets/admin/add_reply/", {  message: tinyMCE.activeEditor.getContent(), reply_type: reply_type, attachments: $("#attachments").val(), f_tid: $("#f_tid").val()} )
            .done(function( data ) {

                if(data.success == "Yes"){
                    location.reload();
                }

                else {
                    $create_ticket.unblock();
                    toastr.error(data.msg);
                }

            });


    });


    $("#add_reply").on('click', function(e) {
        e.preventDefault();

        $('html, body').animate({
            scrollTop: $("#section_add_reply").offset().top - 60
        }, 500);

        tinyMCE.activeEditor.focus();

    });

    $('#notes').redactor(
        {
            minHeight: 150, // pixels
            plugins: ['fontcolor']
        }
    );

    $("#btn_save_note").on('click', function(e) {
        e.preventDefault();

        $('#t_options').block({ message: null });

        $.post(base_url + 'tickets/admin/save_note', {
            tid: $('#tid').val(),

            notes: $('#notes').val()

        })
            .done(function () {
                toastr.success(_L['Saved Successfully']);
                $('#t_options').unblock();

            });

    });

    $(".cdelete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm(_L['are_you_sure'], function(result) {
            if(result){
                window.location.href = base_url + "tickets/admin/delete/" + id;
            }
        });
    });


    $(".t_edit").click(function (e) {
        e.preventDefault();
        var id = this.id;

        $('body').modalmanager('loading');


        $modal.load( base_url + 'tickets/admin/edit_modal/'+id, '', function(){

            $modal.modal();

            ib_editor("#edit_content",300,true,false);

        });
    });


    $(".reply_edit").click(function (e) {
        e.preventDefault();
        var id = this.id;

        $('body').modalmanager('loading');


        $modal.load( base_url + 'tickets/admin/edit_modal/'+id+'/reply', '', function(){

            $modal.modal();

            ib_editor("#edit_content",300,true,false);

        });
    });


    $(".c_view").click(function (e) {
        e.preventDefault();
        var id = this.id;

        $('body').modalmanager('loading');

        $modal.load( base_url + 'tickets/admin/view_modal/'+id, '', function(){

            $modal.modal();

        });
    });


    $('[data-toggle="tooltip"]').tooltip();

    $modal.on('hidden.bs.modal', function () {
        location.reload();
    });

    $modal.on('click', '.update_ticket_message', function(e){

        e.preventDefault();

        $modal.modal('loading');

        $.post( _url + "tickets/admin/edit_modal_post/", {
            tid: $('#edit_tid').val(),
            type: $('#edit_type').val(),
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


    $(".reply_delete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm(_L['are_you_sure'], function(result) {
            if(result){
                window.location.href = base_url + "tickets/admin/delete_reply/" + id;
            }
        });
    });


    // $.fn.editable.defaults.mode = 'inline';
    // $('#editable_phone').editable({
    //     emptytext: _L['Empty'],
    //     url: base_url + 'handler/update_phone/',
    //     success: function(response, newValue) {
    //         toastr.success(_L['Saved Successfully']);
    //     }
    // });
    //
    // var editable_cc = $('#editable_cc').editable({
    //     emptytext: _L['Empty'],
    //     url: base_url + 'tickets/admin/update_cc',
    //     success: function(response, newValue) {
    //         if ($.isNumeric(response)) {
    //
    //             toastr.success(_L['Saved Successfully']);
    //
    //         }
    //
    //         else {
    //
    //             toastr.error(response);
    //         }
    //
    //     }
    // });
    //
    // $('#editable_bcc').editable({
    //     emptytext: _L['Empty'],
    //     url: base_url + 'tickets/admin/update_bcc',
    //     success: function(response, newValue) {
    //         if ($.isNumeric(response)) {
    //
    //             toastr.success(_L['Saved Successfully']);
    //
    //         }
    //
    //         else {
    //             toastr.error(response);
    //         }
    //     }
    // });
    //
    // $('#editable_status').editable({
    //     emptytext: _L['Empty'],
    //     url: base_url + 'tickets/admin/update_status',
    //     source: [
    //         {value: 'Open', text: 'Open'},
    //         {value: 'On Hold', text: 'On Hold'},
    //         {value: 'Escalated', text: 'Escalated'},
    //         {value: 'Closed', text: 'Closed'}
    //     ],
    //     inputclass: 'input-md',
    //     success: function(response, newValue) {
    //         if ($.isNumeric(response)) {
    //
    //             toastr.success(_L['Saved Successfully']);
    //
    //         }
    //
    //         else {
    //             toastr.error(response);
    //         }
    //     }
    // });
    //
    // $('#editable_department').editable({
    //     emptytext: _L['Empty'],
    //     url: base_url + 'tickets/admin/update_department',
    //     source: departments,
    //     inputclass: 'input-md',
    //     success: function(response, newValue) {
    //         if ($.isNumeric(response)) {
    //
    //             toastr.success(_L['Saved Successfully']);
    //
    //         }
    //
    //         else {
    //             toastr.error(response);
    //         }
    //     }
    // });
    //
    // $('#editable_assigned_to').editable({
    //     emptytext: _L['Empty'],
    //     url: base_url + 'tickets/admin/update_assigned_to',
    //     source: agents,
    //     inputclass: 'input-md',
    //     success: function(response, newValue) {
    //         if ($.isNumeric(response)) {
    //
    //             toastr.success(_L['Saved Successfully']);
    //
    //         }
    //
    //         else {
    //             toastr.error(response);
    //         }
    //     }
    // });
    //
    //
    // $('#editable_email').editable({
    //     emptytext: _L['Empty'],
    //     url: base_url + 'tickets/admin/update_email',
    //     success: function(response, newValue) {
    //         if ($.isNumeric(response)) {
    //
    //             toastr.success(_L['Saved Successfully']);
    //
    //         }
    //
    //         else {
    //             toastr.error(response);
    //         }
    //     }
    // });



    $("#editable_cc").on("blur",function(e){
        $.post(base_url + 'tickets/admin/update_cc',{id: tid, value: $(this).val()},function (data) {
            if ($.isNumeric(data)) {

                toastr.success(_L['Saved Successfully']);

            }

            else {

                toastr.error(data);
            }
        })
    });


    $("#editable_bcc").on("blur",function(e){
        $.post(base_url + 'tickets/admin/update_bcc',{id: tid, value: $(this).val()},function (data) {
            if ($.isNumeric(data)) {

                toastr.success(_L['Saved Successfully']);

            }

            else {

                toastr.error(data);
            }
        })
    });


    $("#editable_email").on("blur",function(e){
        $.post(base_url + 'tickets/admin/update_email',{id: tid, value: $(this).val()},function (data) {
            if ($.isNumeric(data)) {

                toastr.success(_L['Saved Successfully']);

            }

            else {

                toastr.error(data);
            }
        })
    });


    $("#editable_phone").on("blur",function(e){
        $.post(base_url + 'tickets/admin/update_phone',{id: tid, value: $(this).val()},function (data) {
            if ($.isNumeric(data)) {

                toastr.success(_L['Saved Successfully']);

            }

            else {

                toastr.error(data);
            }
        })
    });


    $("#editable_department").on("change",function(e){
        $.post(base_url + 'tickets/admin/update_department',{id: tid, value: $(this).val()},function (data) {
            if ($.isNumeric(data)) {

                toastr.success(_L['Saved Successfully']);

            }

            else {

                toastr.error(data);
            }
        })
    });


    $("#editable_assigned_to").on("change",function(e){
        $.post(base_url + 'tickets/admin/update_assigned_to',{id: tid, value: $(this).val()},function (data) {
            if ($.isNumeric(data)) {

                toastr.success(_L['Saved Successfully']);

            }

            else {

                toastr.error(data);
            }
        })
    });

    $("#editable_status").on("change",function(e){
        $.post(base_url + 'tickets/admin/update_status',{id: tid, value: $(this).val()},function (data) {
            if ($.isNumeric(data)) {

                toastr.success(_L['Saved Successfully']);

                $("#inline_status").html($("#editable_status option:selected").text());

            }

            else {

                toastr.error(data);
            }
        })
    });



    var $reply_public = $("#reply_public");
    var $reply_internal = $("#reply_internal");


    $reply_public.click(function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $reply_internal.removeClass('active');
        reply_type = 'public';
        tinymce.activeEditor.getBody().style.backgroundColor = '#FFFFFF';
    });


    $reply_internal.click(function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $reply_public.removeClass('active');
        reply_type = 'internal';
        tinymce.activeEditor.getBody().style.backgroundColor = '#FFF6D9';
    });


    $(".reply_make_public").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm(_L['are_you_sure'], function(result) {
            if(result){
                window.location.href = base_url + "tickets/admin/reply_make_public/" + id;
            }
        });
    });

    function loadTasks() {

        $("#tasks_list").html(block_msg);

        $.get( base_url + "tickets/admin/tasks_list/"+tid, function( data ) {

            $("#tasks_list").html(data);

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'icheckbox_square-blue',
                increaseArea: '20%' // optional
            });

            $('.i-checks').on('ifChanged', function (event) {

                var i_check_id = $(this)[0].id;

                if($(this).iCheck('update')[0].checked){

                    $.get(base_url + 'tickets/admin/set_task_completed/'+i_check_id,function () {
                        loadTasks();
                    });

                }
                else{

                    $.get(base_url + 'tickets/admin/set_task_not_started/'+i_check_id,function () {
                        loadTasks();
                    });

                }

            });

        });
    }


    loadTasks();


    $("#btn_add_task").click(function (e) {
        e.preventDefault();



        if($("#task_subject").val() == ''){

            $("#task_subject").focus();

        }

        else {

            $("#btn_add_task").prop('disabled', true);

            $.post( base_url + "tasks/post/", { title: $("#task_subject").val(), rel_type: 'Ticket', rel_id: tid })
                .done(function( data ) {

                    $("#btn_add_task").prop('disabled', false);

                    if ($.isNumeric(data)) {

                        $("#task_subject").val('');

                        loadTasks();

                    }
                    else{
                        toastr.error(data);
                    }

                });

        }
    });

    var task_id;

    function has_selected_task_items() {
        if($('.selected').length > 0){

            $("#tasks_tools").show(200);

        }
        else{
            $("#tasks_tools").hide(200);
        }
    }

    $("#tasks_list").on('click', '.task_item', function () {

        task_id = this.id;



        if($("#" + task_id).hasClass('selected')){
            $("#" + task_id).removeClass('selected');
        }
        else{
            $("#" + task_id).addClass('selected');
        }

        has_selected_task_items();


        // alert(task_id);


    });

    $("#btn_mark_tasks_completed").on('click',function (e) {
        e.preventDefault();
        var arrayOfIds = $.map($(".selected"), function(n, i){
            return n.id;
        });

        $("#btn_mark_tasks_completed").prop('disabled', true);

        $.post( base_url + "tickets/admin/do_task/", { action: 'completed', ids: arrayOfIds })
            .done(function( data ) {

                $("#btn_mark_tasks_completed").prop('disabled', false);

                loadTasks();

                $("#tasks_tools").hide(200);

            });

    });


    $("#btn_mark_tasks_not_started").on('click',function (e) {
        e.preventDefault();
        var arrayOfIds = $.map($(".selected"), function(n, i){
            return n.id;
        });

        $("#btn_mark_tasks_completed").prop('disabled', true);

        $.post( base_url + "tickets/admin/do_task/", { action: 'not_started', ids: arrayOfIds })
            .done(function( data ) {

                $("#btn_mark_tasks_completed").prop('disabled', false);

                loadTasks();

                $("#tasks_tools").hide(200);

            });

    });


    $("#btn_delete_tasks").on('click',function (e) {
        e.preventDefault();

        bootbox.confirm(_L['are_you_sure'], function(result) {
            if(result){
                var arrayOfIds = $.map($(".selected"), function(n, i){
                    return n.id;
                });

                $("#btn_delete_tasks").prop('disabled', true);

                $.post( base_url + "tickets/admin/do_task/", { action: 'delete', ids: arrayOfIds })
                    .done(function( data ) {

                        $("#btn_delete_tasks").prop('disabled', false);

                        loadTasks();

                        $("#tasks_tools").hide(200);

                    });
            }
        });



    });








});