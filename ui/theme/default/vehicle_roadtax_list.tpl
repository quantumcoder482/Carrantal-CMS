{extends file="$layouts_admin"}


{block name="content"}
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">

                <a href="#" class="btn btn-primary waves-effect waves-light add_roadtax" id="add_roadtax">
                    <i class="fa fa-plus"></i> {$_L['Add New Road Tax']}</a>

            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>{$_L['Road Tax']}</h5>
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

                <table class="table table-bordered table-hover sys_table footable" {if $view_type=='filter' } data-filter="#foo_filter" data-page-size="10"{/if}>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Vehicle No']}</th>
                            <th>{$_L['Amount']} ({$_L['Rebate']})</th>
                            <th>{$_L['Total']}</th>
                            <th>{$_L['Road Tax Date']}</th>
                            <th>{$_L['Due Date']}</th>
                            <th>{$_L['Status']}</th>
                            <th class="text-right" width="210px">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $d as $ds}
                        <tr>
                            <td data-value="{$ds['id']}">
                                {$ds['id']}
                            </td>

                            <td class="edit_roadtax" data-value="{$ds['vehicle_num']}" id="{$ds['id']}">
                                <a href="#">{$ds['vehicle_num']}</a>
                            </td>
                            
                            <td data-value="{$ds['roadtax_amount']}"><span class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['roadtax_amount']} </span> &nbsp;(
                                <span class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['rebate_amount']}</span>)</td>
                            
                            <td class="amount" {if $ds['pay_status'] eq 0} style="color:#ff2222" {/if} data-value="{$ds['roadtax_total']}" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['roadtax_total']}</td>
                            
                            <td data-value="{strtotime($ds['roadtax_date'])}">
                                {date( $config['df'], strtotime($ds['roadtax_date']))}
                            </td>

                            <td data-value="{strtotime($ds['due_date'])}" {if $rest_status[$ds['id']] eq 1} style="color:#ffa500" {/if}>
                                {date( $config['df'], strtotime($ds['due_date']))}
                            </td>

                            <td>
                                {if $pay_status_string[$ds['id']] eq 'Paid'}
                                <div class="label-success" style="margin:0 auto;font-size:85%;width:85px">
                                     {$pay_status_string[$ds['id']]}</div>
                                {elseif $pay_status_string[$ds['id']] eq 'unPaid'}
                                <div class="label-danger" style="color:#ff2222;margin:0 auto;font-size:85%;width:85px">
                                     {$pay_status_string[$ds['id']]}</div>
                                {elseif $pay_status_string[$ds['id']] eq 'Expired'}
                                <div class="label-default" style="margin:0 auto;font-size:85%;width:85px">
                                    {$pay_status_string[$ds['id']]}</div>
                                {else}
                                <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;font-size:85%;width:85px;">
                                     {$pay_status_string[$ds['id']]}</div>
                                {/if}
                            </td>

                            <td class="text-right">
                                {if $ds['pay_status'] neq 0 && $ds['expired'] neq 1}
                                <a href="#" class="btn btn-xs renew" id="{$ds['id']}" style="background-color:#4B0082; border-color:#4B0082; color:#f8f8f8"
                                    data-toggle="tooltip" data-placement="top" title="{$_L['Renew']}">
                                    {$_L['Renew']}
                                </a>
                                {elseif $ds['expired'] eq 1}
                                <a href="#" class="btn btn-xs" id="{$ds['id']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#f8f8f8" disabled
                                    data-toggle="tooltip" data-placement="top" title="{$_L['Renew']}">
                                    {$_L['Renew']}
                                </a>
                                {/if}
                                {if {$ds['pay_status']} neq 0}
                                <a href="#" class="btn btn-xs" id="{$ds['id']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#f8f8f8" disabled 
                                    data-toggle="tooltip" data-placement="top" title="{$_L['Add Expense']}">
                                    {$_L['Add Expense']}
                                </a>
                                {else}
                                <a href="#" class="btn btn-warning btn-xs add_expense" id="{$ds['id']}" style="background-color:#FFA500; border-color:#FFA500; color:#f8f8f8" 
                                    data-toggle="tooltip" data-placement="top" title="{$_L['Add Expense']}">
                                     {$_L['Add Expense']}
                                </a>
                                {/if}

                                <a href="#" class="btn btn-info btn-xs edit_roadtax" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
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
                            <td style="text-align: left;" colspan="8">
                                <ul class="pagination">
                                </ul>
                            </td>
                        </tr>
                    </tfoot>
                    {/if}

                </table>
                {$paginator['contents']}
            </div>

            <div class="ibox-title">
               <h5>{$_L['Recent Expense Transactions']}</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered table-hover sts_table footable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Date']}</th>
                            <th>{$_L['Account']}</th>
                            <th>{$_L['Vehicle No']}</th>
                            <th>{$_L['Category']}</th>
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Description']}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $transactions as $t}
                        {if $transactions neq ''}
                        <tr>
                            <td>{$t['id']}</td>
                            <td> {date( $config['df'], strtotime($t['date']))}</td>
                            <td>{$t['account']}</td>
                            <td><a href="#">{$t['vehicle_num']}</a></td>
                            <td>{$t['category']}</td>
                            <td class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if}">{$t['amount']}</td>
                            <td>{$t['description']}</td>
                        </tr>
                        {else}
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        {/if}
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: left;" colspan="7">
                                <ul class="pagination">
                                </ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- 
<div class="md-fab-wrapper">
    <a class="md-fab md-fab-primary waves-effect waves-light add_roadtax" data-toggle="modal" href="#add_roadtax">
        <i class="fa fa-plus"></i>
    </a>
</div> -->
{/block}
