$(function() {

    var _url = $("#_url").val();

    var $calendar_wrap = $("#calendar_wrap");

    var ib_date_picker_options = {
        format: ib_date_format_picker
    };


    var $modal = $("#modal_add_event");

    var $ib_modal_form = $("#ib_modal_form");

    var $start = $('#start');

    var start_picker = $start.pickadate(ib_date_picker_options);
    var picker = start_picker.pickadate('picker');

    var $ib_act = $("#ib_act");
    var $event_id = $("#event_id");

    var $end = $('#end');

    var end_picker = $end.pickadate(ib_date_picker_options);
    var picker2 = end_picker.pickadate('picker');

    var $description = $("#description");
    var $title = $("#title");

    var $all_day_event = $("#all_day_event");

    var $start_time_div = $("#start_time_div");
    var $end_time_div = $("#end_time_div");

    var $btn_del_event = $("#btn_del_event");

    $btn_del_event.hide();

    $btn_del_event.on('click', function(e) {

        e.preventDefault();

        bootbox.confirm(_L['are_you_sure'], function(result) {

            if(result){

                window.location.href = _url + "delete/event/" + $event_id.val();

            }

        });

    });


    $('#color').spectrum({
        preferredFormat: "hex",
        showInput: true,
        showPalette: true,
        palette: [["#F44336", "#E91E63", "#9C27B0", "#673AB7", "#3F51B5", "#2196F3", "#03A9F4", "#00BCD4", "#009688", "#4CAF50", "#8BC34A", "#CDDC39", "#FFEB3B", "#FFC107", "#FF9800", "#FF5722", "#795548", "#9E9E9E", "#607D8B", "#000000"]],
        color: "#2196f3"
    });


    function view_event(id) {

        $btn_del_event.show();

        $ib_act.val('edit');
        $event_id.val(id);

        $.post(_url + 'calendar/view_event/' + id + '/').success(function(data) {
            $modal.modal('show');
            $title.val(data.title);
            $modal_title.html(data.title);
            $description.html(data.description);
            $start.val(data.start_date);
            picker.set('select', data.start_date, { format: ib_date_format_picker });
            picker2.set('select', data.end_date, { format: ib_date_format_picker });

            if(data.allDay == 1){
                $start_time_div.hide();
                $end_time_div.hide();
              //  $all_day_event.iCheck('check');
            }
            else{
                $start_time_div.show();
                $end_time_div.show();
              //  $all_day_event.iCheck('uncheck');
            }



        });
    }


    var ib_calendar_options = {
        customButtons: {},
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,viewFullCalendar'
        },
        loading: function(isLoading, view) {
            if (isLoading) {
                $calendar_wrap.block({ message: block_msg });
            } else {
                $calendar_wrap.unblock();
                $('[data-toggle="tooltip"]').tooltip();
            }
        },
        editable: true,
        eventLimit: 3,
        lang: ib_lang,
        isRTL: ib_rtl,
        eventSources: [{
            url: _url + 'calendar/data/',
            type: 'GET',
            error: function() {
                bootbox.alert("Unable to load data.");
            }
        } ],
        eventRender: function(event, element) {
            element.attr('title', event._tooltip);
            element.attr('onclick', event.onclick);
            element.attr('data-toggle', 'tooltip');
            if (!event.url) {
                element.click(function() {
                    view_event(event.eventid);
                });
            }
        },
        eventStartEditable: false,
        dayClick: function(date) {
            $modal.modal('show');
            date = date.toDate();

            $ib_act.val('create');

            $btn_del_event.hide();

            $.post(_url+'calendar/js_date',{date:date}).success(function(data){

                $start.val(data);
                $title.val("");
                $description.html();
                $end.val(data);
                 picker.set('select', data, { format: ib_date_format_picker });
                 picker2.set('select', data, { format: ib_date_format_picker });

            });




            return false;
        },
        firstDay: parseInt(ib_calendar_first_day),
    };




    $('#calendar').fullCalendar(ib_calendar_options);

    $('.clockpicker').clockpicker({
        donetext: 'Done'

    });

    $all_day_event.iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
    });


    // $(".colors div").click(function(){
    //
    //     $("#event_color").val($(this).attr("data-ib"));
    //
    //     if (!$(this).hasClass("active")) {
    //         // Remove the class from anything that is active
    //         $(".colors div.active").removeClass("active");
    //         // And make this active
    //         $(this).addClass("active");
    //     }
    // });






var ib_validate = $ib_modal_form.parsley();

    ib_validate.on('form:submit', function() {
            $modal.modal('loading');
            $.post( _url + "calendar/save_event/", $ib_modal_form.serialize())
                .done(function( data ) {

                    if ($.isNumeric(data)) {

                        location.reload();

                    }

                    else {
                        $modal.modal('loading');
                        toastr.error(data);
                    }

                });


            return false;

        });





    var $modal_title = $("#modal_title");

    var txt_original_title = $modal_title.html();


    $title.bind("change paste keyup", function() {
        var txt_title = $(this).val();
        if(txt_title.trim() == ''){

            $modal_title.html(txt_original_title);

        }
        else{
            $modal_title.html(txt_title);
        }

    });



    $all_day_event.on('ifChecked', function(){

        $start_time_div.hide("slow");
        $end_time_div.hide("slow");

    });

    $all_day_event.on('ifUnchecked', function(){

        $start_time_div.show("slow");
        $end_time_div.show("slow");

    });





    $(".add_event").on('click', function(e) {
        e.preventDefault();
        $modal.modal('show');

    });



});


