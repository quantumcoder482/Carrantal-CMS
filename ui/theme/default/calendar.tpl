{extends file="$layouts_admin"}

{block name="content"}
    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default" style="min-height: 400px;" id="calendar_wrap">

                <div class="panel-body">


                    <div id="calendar"></div>


                </div>
            </div>
        </div>



    </div>

    <div id="modal_add_event" class="modal fade-scale" tabindex="-1" data-width="800" style="display: none;">
        <form id="ib_modal_form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal_title">{$_L['Add Event']}</h4>
            </div>
            <div class="modal-body">
                <div class="row">





                    <div class="form-group col-md-12">
                        <label for="title">{$_L['Event Name']}</label>
                        <input type="text" class="form-control" id="title" name="title" value="" required>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="start">{$_L['Start Date']}</label>
                        <input type="text" class="form-control datepicker" id="start" placeholder="Select Date" name="start" value="{$mdate}">
                    </div>

                    <div class="form-group col-md-6" id="start_time_div">
                        <label for="start_time">{$_L['Start Time']}</label>
                        <div class="input-group clockpicker">

                            <input type="text" id="start_time" name="start_time" class="form-control" value="09:30">
                            <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="end">{$_L['End Date']}</label>
                        <input type="text" class="form-control datepicker" id="end" name="end" value="">
                    </div>

                    <div class="form-group col-md-6" id="end_time_div">
                        <label for="end_time">{$_L['End Time']}</label>
                        <div class="input-group clockpicker">

                            <input type="text" class="form-control" id="end_time" name="end_time" value="11:30">
                            <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
                        </div>
                    </div>



                    <div class="form-group col-md-12">

                        <input class="i-checks" type="checkbox" name="all_day_event" value="yes" id="all_day_event">
                        <label for="all_day_event">{$_L['All day event']}</label>


                    </div>


                    <div class="form-group col-md-12">
                        <label for="color">{$_L['Color']}</label>
                        <input type="text" class="form-control color" id="color" name="color" value="#2196f3">
                    </div>


                    <div class="form-group col-md-12">
                        <label for="description">{$_L['Description']}</label>
                        <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                    </div>



                    <input type="hidden" id="ib_act" name="ib_act" value="create">
                    <input type="hidden" id="event_id" name="event_id" value="0">






                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="btn_del_event" class="btn btn-danger"><i class="fa fa-trash"></i> {$_L['Delete']}</a>
                <button type="button" data-dismiss="modal" class="btn btn-warning">{$_L['Close']}</button>
                <button type="submit" id="btn_save_event" class="btn btn-primary">{$_L['Submit']}</button>
            </div>
        </form>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary waves-effect waves-light add_event" href="#">
            <i class="fa fa-plus"></i>
        </a>
    </div>

{/block}
