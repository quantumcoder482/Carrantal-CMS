{extends file="$layouts_admin"}

{block name="style"}

    <link href="{$app_url}ui/lib/editable/css/bootstrap-editable.css" rel="stylesheet">

{/block}

{block name="content"}
    <div class="row">
        <div class="col-md-6">






            <div class="ibox float-e-margins" id="ui_settings">
                <div class="ibox-title">
                    <h5>{$_L['Choose Features']}</h5>


                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <tbody>

                        <tr>
                            <td width="80%"><label for="config_accounting">{$_L['Accounting']} </label></td>
                            <td> <input type="checkbox" {if get_option('accounting') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_accounting"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_invoicing">{$_L['Invoicing']} </label></td>
                            <td> <input type="checkbox" {if get_option('invoicing') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_invoicing"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_invoice_receipt_number">{$_L['Invoicing']} - {$_L['Receipt Number']}</label></td>
                            <td> <input type="checkbox" {if get_option('invoice_receipt_number') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_invoice_receipt_number"></td>
                        </tr>


                        <tr>
                            <td width="80%"><label for="config_show_business_number">{$_L['Invoicing']} - Show Business Number</label></td>
                            <td> <input type="checkbox" {if get_option('show_business_number') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_show_business_number"></td>
                        </tr>

                        <tr>
                            <td width="80%">
                                <label for="add_fund_minimum_deposit">Business Number Label Name </label> <br>

                            </td>
                            <td> <div class="form-material floating">
                                    <input class="form-control" type="text" id="label_business_number" name="add_fund_minimum_deposit" value="{$config['label_business_number']}">
                                    <label for="label_business_number">Name</label>

                                </div></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_quotes">{$_L['Quotes']} </label></td>
                            <td> <input type="checkbox" {if get_option('quotes') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_quotes"></td>
                        </tr>





                        <tr>
                            <td width="80%"><label for="config_companies">{$_L['Companies']} </label></td>
                            <td> <input type="checkbox" {if get_option('companies') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_companies"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_fax_field">{$_L['Fax']} field </label></td>
                            <td> <input type="checkbox" {if get_option('fax_field') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_fax_field"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_leads">{$_L['Leads']} </label></td>
                            <td> <input type="checkbox" {if get_option('leads') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_leads"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_orders">{$_L['Orders']} </label></td>
                            <td> <input type="checkbox" {if get_option('orders') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_orders"></td>
                        </tr>

                        {if $config['orders'] eq '1'}

                            <tr>
                                <td width="80%">
                                    <label for="config_order_method">Order Method </label> <br>
                                </td>
                                <td>

                                    <select class="form-control" name="config_order_method" id="config_order_method">
                                        <option value="default" {if $config['order_method'] eq 'default'} selected{/if}>Default</option>
                                        <option value="create_invoice_later" {if $config['order_method'] eq 'create_invoice_later'} selected{/if}>Place Order, Create Invoice Later</option>

                                    </select>

                                </td>
                            </tr>





                        {/if}

                        <tr>
                            <td width="80%"><label for="config_support">{$_L['Support']} </label></td>
                            <td> <input type="checkbox" {if get_option('support') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_support"></td>
                        </tr>


                        <tr>
                            <td width="80%"><label for="config_kb">{$_L['Knowledgebase']} </label></td>
                            <td> <input type="checkbox" {if get_option('kb') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_kb"></td>
                        </tr>


                        <tr>
                            <td width="80%"><label for="config_hrm">{$_L['HRM']} </label></td>
                            <td> <input type="checkbox" {if get_option('hrm') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_hrm"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_projects">{$_L['Projects']} </label></td>
                            <td> <input type="checkbox" {if get_option('projects') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_projects"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_tasks">{$_L['Tasks']} </label></td>
                            <td> <input type="checkbox" {if get_option('tasks') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_tasks"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_calendar">{$_L['Calendar']} </label></td>
                            <td> <input type="checkbox" {if get_option('calendar') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_calendar"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_documents">{$_L['Documents']} </label></td>
                            <td> <input type="checkbox" {if get_option('documents') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_documents"></td>
                        </tr>


                        <tr>
                            <td width="80%"><label for="config_suppliers">{$_L['Suppliers']} </label></td>
                            <td> <input type="checkbox" {if get_option('suppliers') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_suppliers"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_purchase">{$_L['Purchase']} </label></td>
                            <td> <input type="checkbox" {if get_option('purchase') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_purchase"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_inventory">{$_L['Inventory']} </label></td>
                            <td> <input type="checkbox" {if get_option('inventory') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_inventory"></td>
                        </tr>





                        <tr>
                            <td width="80%"><label for="config_sms">{$_L['SMS']} </label></td>
                            <td> <input type="checkbox" {if get_option('sms') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_sms"></td>
                        </tr>


                        <tr>
                            <td width="80%"><label for="config_plugins">{$_L['Plugins']} </label></td>
                            <td> <input type="checkbox" {if get_option('plugins') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_plugins"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_client_drive">Client Drive </label></td>
                            <td> <input type="checkbox" {if get_option('client_drive') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_client_drive"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_allow_customer_registration">{$_L['Client Registration']} </label></td>
                            <td> <input type="checkbox" {if get_option('allow_customer_registration') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_allow_customer_registration"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_customer_custom_username">{$_L['Username']} </label></td>
                            <td> <input type="checkbox" {if get_option('customer_custom_username') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_customer_custom_username"></td>
                        </tr>


                        <tr>
                            <td width="80%">
                                <label for="config_add_fund">{$_L['Add Fund']} </label> <br>
                                <span>Option to enabled Add Fund to Client</span>
                            </td>
                            <td> <input type="checkbox" {if get_option('add_fund') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_add_fund"></td>
                        </tr>

                        {if $config['add_fund'] eq '1'}

                            <tr>
                                <td width="80%">
                                    <label for="add_fund_minimum_deposit">Minimum Deposit </label> <br>
                                    <span>Enter the minimum amount a client can add in a single transaction.</span>
                                </td>
                                <td> <div class="form-material floating">
                                        <input class="form-control" type="text" id="add_fund_minimum_deposit" name="add_fund_minimum_deposit" value="{$config['add_fund_minimum_deposit']}">
                                        <label for="add_fund_minimum_deposit">Amount</label>

                                    </div></td>
                            </tr>


                            <tr>
                                <td width="80%">
                                    <label for="add_fund_maximum_deposit">Maximum Deposit </label> <br>
                                    <span>Enter the maximum amount a client can add in a single transaction.</span>
                                </td>
                                <td> <div class="form-material floating">
                                        <input class="form-control" type="text" id="add_fund_maximum_deposit" name="add_fund_maximum_deposit" value="{$config['add_fund_maximum_deposit']}">
                                        <label for="add_fund_maximum_deposit">Amount</label>

                                    </div></td>
                            </tr>

                            <tr>
                                <td width="80%">
                                    <label for="config_add_fund_client">{$_L['Add Fund']} From Client Portal</label> <br>
                                    <span>Adding of funds by clients from the client dashboard.</span>
                                </td>
                                <td> <input type="checkbox" {if get_option('add_fund_client') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_add_fund_client"></td>
                            </tr>



                        {/if}


                        {*<tr>*}
                        {*<td width="80%"><label for="config_client_dashboard">{$_L['Enable Client Dashboard']} </label></td>*}
                        {*<td> <input type="checkbox" {if get_option('client_dashboard') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_client_dashboard"></td>*}
                        {*</tr>*}

                        </tbody>
                    </table>



                </div>
            </div>


        </div>

        <div class="col-md-6">

            {*<div class="ibox float-e-margins" id="ui_settings">*}
                {*<div class="ibox-title">*}
                    {*<h5>Status</h5>*}


                {*</div>*}
                {*<div class="ibox-content">*}

                    {*<h4>Purchase Invoice Status</h4>*}

                    {*<hr>*}

                    {*{foreach $status_purchase_invoice as $p_status}*}
                        {*<a href="#" class="editable_status" data-type="text" data-pk="1" data-url="{$_url}settings/update_status" data-title="Edit Name"><i class="fa fa-pencil"></i> {$p_status->name}</a> <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> </a>*}
                        {*<hr>*}
                    {*{/foreach}*}

                    {*<a href="#" id="purchase_invoice_status_add_more" class="btn btn-primary">Add More</a>*}


                {*</div>*}
            {*</div>*}



        </div>



    </div>
{/block}

{block name="script"}
    <script src="{$app_url}ui/lib/editable/js/bootstrap-editable.min.js"></script>
    <script>

        $(function () {

            $('.editable_status').editable();

            $("#purchase_invoice_status_add_more").on('click',function () {
                bootbox.prompt("Enter Name", function(result){

                    $.post( base_url + "", { name: "result" })

                        .done(function( data ) {
                            window.location.reload();
                        });

                });
            });

        })

    </script>
{/block}
