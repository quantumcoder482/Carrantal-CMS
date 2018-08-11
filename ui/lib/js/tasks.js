$(function () {

    for (var a = dragula($(".kanban-droppable-area").toArray()), r = a.containers, o = r.length, l = 0; l < o; l++)$(r[l]).addClass("dragula dragula-vertical");
    a.on("drop", function (a, r, o, l) {
        // console.log(a), console.log(r), console.log(o)
        // $(".kanban-col").block(
        //     {
        //         message: block_msg
        //     }
        // );

      //  console.log(a), console.log(r), console.log(o), console.log(l)

        var item = a.id;
        var target = r.id;

        $.post(base_url + 'tasks/set_status/',{task_id : item, target: target},function (data) {
         //   $(".kanban-col").unblock();

        })

    });

    $modal = $("#ajax-modal");

    $( ".mmnt" ).each(function() {
        //   alert($( this ).html());
        var ut = $( this ).html();
        $( this ).html(moment.unix(ut).fromNow());
    });


    var rel_type_val;

    $(".add_task").on('click',function (e) {
        e.preventDefault();

        $('body').modalmanager('loading');

        $modal.load( base_url + 'tasks/create/', '', function(){

            $modal.modal();
            ib_editor("#description");
            var ib_date_picker_options = {
                format: ib_date_format_picker
            };



            var $start_date = $('#start_date');

            $start_date.datetimepicker({
                format: 'YYYY-MM-DD'
            });

            var $due_date = $('#due_date');

            $due_date.datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $("#rel_type").select2({
                theme: "bootstrap"
            })
                .on("change", function(e) {
                    updateRelParams();
                });

        });


    });




    function updateRelParams() {

        rel_type_val = $("#rel_type").val();

        if(rel_type_val != 'None'){

            $("#rel_id_input").show();
            $("#lbl_rel_id").html(rel_type_val);



            var rel_id_select2 = $("#rel_id").select2({
                theme: "bootstrap",
                ajax: {
                    url: base_url + "json/"+rel_type_val,
                    processResults: function (data, params) {
                        return {
                            results: data

                        };
                    },
                    delay: 250,
                    cache: false

                }
            });

            // rel_id_select2.trigger('change');

            // var $option = $('<option selected>Loading...</option>').val('0');
            //
            // rel_id_select2.append($option).trigger('change'); // append the option and update Select2
            //
            // $.ajax({ // make the request for the selected data object
            //     type: 'GET',
            //     // url: '/api/for/single/creditor/' + initial_creditor_id,
            //     url: base_url + "json/contacts/",
            //     dataType: 'json'
            // }).then(function (data) {
            //     $option.removeData();
            //     $option.text(data.account).val(data.id); // update the text that is displayed (and maybe even the value)
            //     rel_id_select2.trigger('change');
            // });


        }

        else{
            $("#rel_id_input").hide();
        }
    }


    $modal.on('click', '.modal_submit', function(e){

        e.preventDefault();

        $modal.modal('loading');

        $.post( base_url + "tasks/post/", $("#ib-modal-form").serialize())
            .done(function( data ) {

                if ($.isNumeric(data)) {

                    window.location = base_url + 'tasks/list/' + data;

                }

                else {
                    $modal.modal('loading');
                    toastr.error(data);
                }

            });

    });


    $('.v_item').on('click',function (e) {
        e.preventDefault();
        $('body').modalmanager('loading');

        $modal.load( base_url + 'tasks/view/'+this.id, '', function(){

            $modal.modal();




        });


    });


    $modal.on('click', '.c_delete', function(e){
        e.preventDefault();
        var tid = this.id;
        bootbox.confirm(_L['are_you_sure'], function(result) {
            if(result){

                $.get( base_url + "delete/tasks/"+tid, function( data ) {
                    location.reload();
                });


            }
        });

    });


    $modal.on('click', '.c_edit', function(e){
        e.preventDefault();
        var tid = this.id;

        $('body').modalmanager('loading');

        $modal.load( base_url + 'tasks/create/'+tid, '', function(){
            $('body').modalmanager('loading');
            $modal.modal();
            ib_editor("#description");
            var ib_date_picker_options = {
                format: ib_date_format_picker
            };


            var jq_title = $('#title').val();

            $('#title').keyup(function () {

                var live_val = $(this).val();
                if(live_val == ''){
                    $("#txt_modal_header").html(jq_title);
                }
                else{
                    $("#txt_modal_header").html(live_val);
                }


            });

            var $start_date = $('#start_date');

            $start_date.datetimepicker({
                format: 'YYYY-MM-DD'
            });

            var $due_date = $('#due_date');

            $due_date.datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $("#rel_type").select2({
                theme: "bootstrap"
            })
                .on("change", function(e) {
                    updateRelParams();
                });

        });

    });


});