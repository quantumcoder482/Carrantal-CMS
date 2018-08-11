{extends file="$layouts_admin"}

{block name="content"}


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">

                    <a href="{$_url}tickets/admin/create/" class="btn btn-primary"><i class="fa fa-plus"></i> {$_L['Open Ticket']}</a>




                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">



                    <div class="row">

                        <div class="col-md-3 col-sm-6">

                            <form>

                                <div class="form-group">
                                    <label for="filter_account">{$_L['Customer']}</label>
                                    <input type="text" id="filter_account" name="filter_account" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="filter_company">{$_L['Company']}</label>
                                    <input type="text" id="filter_company" name="filter_company" class="form-control">
                                </div>





                                <div class="form-group">
                                    <label for="filter_email">{$_L['Email']}</label>
                                    <input type="email" id="filter_email" name="filter_email" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label for="filter_subject">{$_L['Subject']}</label>
                                    <input type="text" id="filter_subject" name="filter_subject" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label for="filter_status">{$_L['Status']}</label>
                                    <select class="form-control" id="filter_status" name="filter_status" size="1">
                                        <option value="">All</option>
                                        <option value="Open">Open</option>
                                        <option value="On Hold">On Hold</option>
                                        <option value="Escalated">Escalated</option>
                                        <option value="Closed">Closed</option>

                                    </select>
                                </div>



                                <button type="submit" id="ib_filter" class="btn btn-primary">{$_L['Filter']}</button>

                                <br>
                            </form>


                        </div>
                        <div class="col-md-9 col-sm-6 ib_right_panel">

                            <div id="ib_act_hidden" style="display: none;">

                                <a href="#" id="set_status" class="btn btn-primary"><i class="fa fa-tags"></i> Set Status</a>

                                <a href="#" id="delete_multiple_customers" class="btn btn-danger"><i class="fa fa-trash"></i> {$_L['Delete']}</a>

                                <hr>
                            </div>

                            <div class="table-responsive" id="ib_data_panel">


                                <table class="table table-bordered display" id="ib_dt" width="100%">
                                    <thead>
                                    <tr class="heading">
                                        <th width="100px;">#</th>
                                        <th width="60px;">{$_L['Image']}</th>
                                        <th width="50%">{$_L['Subject']}</th>
                                        <th>{$_L['Name']}</th>
                                        <th class="text-right" style="width: 80px;">{$_L['Status']}</th>
                                    </tr>
                                    </thead>




                                </table>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary waves-effect waves-light add_item" href="{$_url}tickets/admin/create/">
            <i class="fa fa-plus"></i>
        </a>
    </div>

{/block}



