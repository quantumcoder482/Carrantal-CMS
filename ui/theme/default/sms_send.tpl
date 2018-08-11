{extends file="$layouts_admin"}

{block name="content"}

    <div class="row">

        <div class="col-md-8">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>{$_L['Send SMS']}</h4>
                </div>
                <div class="panel-body">

                    <div id="result"></div>

                    <form class="form-horizontal" action="{$_url}sms/init/send_post/" method="post" id="iform">

                        <div class="form-group"><label class="col-lg-2 control-label" for="from">From </label>

                            <div class="col-lg-6"><input type="text" name="from" id="from" class="form-control " value="{$config['sms_sender_name']}">

                            </div>
                        </div>

                        <div class="form-group"><label class="col-lg-2 control-label" for="sms_to">To </label>

                            <div class="col-lg-6">
                                <input type="text" name="sms_to" id="sms_to" class="form-control ">

                                <span class="help-block"><a data-toggle="modal" href="#modal_find_contact">| Or Choose from Contact</a> </span>

                            </div>
                        </div>


                        <div class="form-group"><label class="col-lg-2 control-label" for="message">SMS </label>

                            <div class="col-lg-6">

                                <textarea class="form-control" name="message" id="message" rows="4"></textarea>

                                <p class="help-block" id="sms-counter">
                                    Remaining: <span class="remaining"></span> | Length: <span class="length"></span> | Messages: <span class="messages"></span>
                                </p>

                                {*<p class="help-block"><a href="#">Choose from Template</a> </p>*}

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-6">
                                <button class="btn btn-primary" type="submit" id="send"><i
                                            class="fa fa-check"></i> {$_L['Send']}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>

    <div id="modal_find_contact" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Find Phone Number</h4>
        </div>
        <div class="modal-body">
            <div class="row">


                <select id="cid" name="cid" class="form-control">
                    <option value="">Search Contact...</option>
                    {foreach $c as $cs}
                        <option value="{$cs['phone']}">{$cs['account']} - {$cs['phone']}  {if $cs['email'] neq ''} [ {$cs['email']} ]{/if}</option>
                    {/foreach}

                </select>



            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="file_link" id="file_link" value="">
            <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>

        </div>
    </div>


{/block}