{extends file="$layouts_admin"}


{block name="content"}
    <div class="row">
        <div class="col-md-12">
            <h4 class="ibilling-page-header">{$contract['title']}</h4>
        </div>
    </div>
    <div class="row">
        
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        {$_L['Generate Contract']} 
                    </h5>
                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>
                
                    <form class="form-horizontal" id="rform">
                
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="contact">{$_L['Contact']}</label>
                        
                            <div class="col-lg-10">
                        
                                <select id="contact" name="contact" class="form-control" style="width:100%">
                                    <option value=""></option>
                                    {foreach $customers as $customer}
                                    {if $selected_customer['id'] eq $customer['id']}
                                    <option value="{$customer['id']}" selected>{$customer['account']}</option>
                                    {else}
                                    <option value="{$customer['id']}">{$customer['account']}</option>
                                    {/if}
                                    {/foreach}
                                </select>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="vehicle">{$_L['Vehicle']}</label>
                        
                            <div class="col-lg-10">
                        
                                <select id="vehicle" name="vehicle" class="form-control" style="width:100%">
                                    <option value=""></option>
                                    {foreach $vehicles as $vehicle}
                                    {if $selected_vehicle['id'] eq $vehicle['id']}
                                    <option value="{$vehicle['id']}" selected>{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                    {else}
                                    <option value="{$vehicle['id']}">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                    {/if}
                                    {/foreach}
                                </select>
                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="invoice">{$_L['Invoice']}</label>
                        
                            <div class="col-lg-10">
                        
                                <select id="invoice" name="invoice" class="form-control" style="width:100%">
                                    <option value=""></option>
                                    {foreach $invoices as $invoice}
                                    <option value="{$invoice['id']}">{$invoice['invoicenum']}&nbsp;&nbsp;{$invoice['id']}</option>
                                    {/foreach}
                                </select>
                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="deposit">{$_L['Deposit']}</label>
                        
                            <div class="col-lg-10">
                        
                                <select id="deposit" name="deposit" class="form-control" style="width:100%">
                                    <option value=""></option>
                                    {foreach $deposits as $deposit}
                                    <option value="{$deposit['id']}">
                                        <span class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" 
                                            data-d-group="2">{$deposit['first_deposit']}</span> / 
                                        <span class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                                            data-d-group="2">{$deposit['deposit_amount']}</span>
                                    </option>
                                    {/foreach}
                                </select>
                        
                            </div>
                        </div>
                
                        <input type="hidden" name="contract_id" id="contract_id" value="{$contract['id']}">
                                        <!-- <input type="hidden" name="cert_file" id="cert_file" value=""> -->
                
                        <div class="form-group">
                            <div class="col-lg-12">
                
                                <button class="btn btn-primary" type="submit" id="submit">{$_L['Generate']}</button>
                                <!-- <button class="btn btn-info" type="submit" id="close">{$_L['Save n Close']}</button> -->
                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
        </div>

        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        {$_L['List Generated Contract']} 
                    </h5>
                </div>
                <div class="ibox-content">
                
                    {if $view_type == 'filter'}
                    <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-search"></span>
                                    </div>
                                    <input type="text" name="name" id="foo_filter" class="form-control" placeholder="{$_L['Search']}..." />
                
                                </div>
                            </div>
                
                        </div>
                        <input type="hidden" id="sure_msg" value="{$_L['are_you_sure']}" />
                       
                    </form>
                    {/if}
                
                    <table class="table table-bordered table-hover sys_table footable" {if $view_type=='filter' } data-filter="#foo_filter" data-page-size="10"
                        {/if}>
                        <thead>
                            <tr>
                                <th>{$_L['Contact']}</th>
                                <th>{$_L['Vehicle']}</th>
                                <th>{$_L['Deposit']}</th>
                                <th>{$_L['Invoice']}</th>
                                <th>{$_L['Status']}</th>
                                <th>{$_L['View']}</th>
                                <th class="text-right" width="120px;">{$_L['Manage']}</th>
                            </tr>
                        </thead>
                        <tbody>
                
                            {foreach $d as $ds}
                            <tr>
                                <td>
                                    {$val[$ds['id']]['customer']}
                                </td>
                                <td >
                                   <a href="#" class="show_vehicle">{$val[$ds['id']]['vehicle']}</a> 
                                </td>
                                <td>
                                    <span class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                                        data-d-group="2">{$val[$ds['id']]['deposit_amount']}</span> / 
                                    <span class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                                        data-d-group="2">{$val[$ds['id']]['first_deposit']}</span>
                                </td>
                                <td>
                                    <a href="#" class="show_invoice">{$val[$ds['id']]['invoicenum']} &nbsp;&nbsp;{$ds['invoice_id']}</a>
                                </td>
                                <td>
                                    {if $ds['status'] eq 0}
                                    <span class="btn btn-warning btn-xs" style="background-color:#FFA500; border-color:#FFA500; color:#f8f8f8; width:65px">Pending</span>
                                    {else}
                                    <span class="btn btn-success btn-xs" style="background-color:#00AA00; border-color:#00AA00; color:#f8f8f8; width:65px">Signed</span>
                                    {/if}
                                </td>
                                <td>
                                    {if $ds['status'] neq 0}
                                    <a href="{$_url}client/contract_pdf/{$ds['id']}/view/" target="_blank" class="btn btn-primary btn-xs view_ref_img" style="background-color:#f7931e; border:none;" id="{$ds['id']}"
                                        data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                        <i class="fa fa-paperclip"></i>
                                    </a>
                                    {else}
                                    &nbsp;
                                    {/if}
                                </td>
                                <td class="text-right">
                                    <a href="#" class="btn btn-info btn-xs modal_edit_contract" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-xs cdelete" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Delete']}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            {/foreach}
                
                        </tbody>
                
                        {if $view_type == 'filter'}
                        <tfoot>
                            <tr>
                                <td style="text-align: left;" colspan="10">
                                    <ul class="pagination">
                                    </ul>
                                </td>
                            </tr>
                        </tfoot>
                        {/if}
                
                    </table>
                    {$paginator['contents']}
                </div>
            </div>
        </div>

    </div>
{/block}
