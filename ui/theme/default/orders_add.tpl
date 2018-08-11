{extends file="$layouts_admin"}

{block name="content"}
    <div class="wrapper wrapper-content">
        <div class="row">

            <div class="col-md-8">



                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{$_L['Add New Order']}</h5>



                    </div>
                    <div class="ibox-content" id="ibox_form">


                        <form class="form-horizontal" id="ib_form">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <div class="form-group"><label class="col-md-4 control-label" for="pid">{$_L['Product_Service']}</label>

                                        <div class="col-lg-8">

                                            <select id="pid" name="pid" class="form-control">
                                                <option value="">{$_L['Select']}...</option>
                                                {foreach $p as $ps}
                                                    <option value="{$ps['id']}">{$ps['name']}</option>
                                                {/foreach}

                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-md-4 control-label" for="cid">{$_L['Customer']} </label>

                                        <div class="col-lg-8">

                                            <select id="cid" name="cid" class="form-control">
                                                <option value="">{$_L['Select']}...</option>
                                                {foreach $c as $cs}
                                                    <option value="{$cs['id']}"
                                                            {if $p_cid eq ($cs['id'])}selected="selected" {/if}>{$cs['account']} {if $cs['email'] neq ''}- {$cs['email']}{/if}</option>
                                                {/foreach}

                                            </select>

                                        </div>
                                    </div>



                                    <div class="form-group"><label class="col-md-4 control-label" for="status">{$_L['Status']}</label>

                                        <div class="col-lg-8">

                                            <select id="status" name="status" class="form-control">

                                                <option value="Pending">{$_L['Pending']}</option>
                                                <option value="Active">{$_L['Active']}</option>


                                            </select>

                                        </div>
                                    </div>


                                    <div class="form-group"><label class="col-md-4 control-label" for="price">{$_L['Price']}</label>

                                        <div class="col-lg-4 col-md-4 col-sm-8"><input type="text" id="price" name="price" class="form-control amount">

                                        </div>
                                    </div>


                                    <div class="form-group"><label class="col-md-4 control-label" for="qty">{$_L['Qty']}</label>

                                        <div class="col-lg-4 col-md-4 col-sm-8"><input type="text" id="qty" name="qty" class="form-control" value="1">

                                        </div>
                                    </div>


                                    <div class="form-group"><label class="col-md-4 control-label" for="payterm">{$_L['Billing Cycle']}</label>

                                        <div class="col-lg-8">

                                            <select id="billing_cycle" name="billing_cycle" class="form-control">

                                                <option value="Free Account">{$_L['Free']}</option>
                                                <option value="One Time" selected>{$_L['One Time']}</option>
                                                <option value="Monthly">{$_L['Monthly']}</option>
                                                <option value="Quarterly">{$_L['Quarterly']}</option>
                                                <option value="Semi-Annually">{$_L['Semi-Annually']}</option>
                                                <option value="Annually">{$_L['Annually']}</option>
                                                <option value="Biennially">{$_L['Biennially']}</option>
                                                <option value="Triennially">{$_L['Triennially']}</option>

                                            </select>

                                        </div>
                                    </div>




                                    <div class="form-group"><label class="col-md-4 control-label" for="generate_invoice">{$_L['Generate Invoice']}</label>

                                        <div class="col-lg-8">


                                            <input type="checkbox" checked data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="generate_invoice" name="generate_invoice" value="Yes">


                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-md-4 control-label" for="send_email">{$_L['Send Email']}</label>

                                        <div class="col-lg-8">


                                            <input type="checkbox" checked data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="send_email" name="send_email" value="Yes">


                                        </div>
                                    </div>


                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-lg-8">

                                            <button class="md-btn md-btn-primary waves-effect waves-light" type="submit" id="submit"><i class="fa fa-check"></i> {$_L['Submit']}</button> | <a href="{$_url}orders/list/">{$_L['Or Cancel']}</a>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <input type="hidden" id="_lan_btn_save" value="{$_L['Save']}">

    <input type="hidden" id="_lan_no_results_found" value="{$_L['No results found']}">
{/block}