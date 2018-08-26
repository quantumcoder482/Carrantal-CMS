{extends file="$layouts_admin"}


{block name="content"}
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">

                <a href="#" class="btn btn-primary add_insurance waves-effect waves-light" id="add_company">
                    <i class="fa fa-plus"></i> {$_L['Add New Insurance']}</a>

            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>{$_L['Insurance']}</h5>
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
                            <th>{$_L['Amount']}({$_L['Rebate']})</th>
                            <th>{$_L['Total']}</th>
                            <th>{$_L['Insurance Date']}</th>
                            <th>{$_L['Due Date']}</th>
                            <th>{$_L['Status']}</th>
                            <th class="text-right" width="180px;">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $d as $ds}
                        <tr>
                            <td data-value="{$ds['id']}">
                                {$ds['id']}
                            </td>

                            <td class="edit_insurance" data-value="{$ds['vehicle_num']}" id="{$ds['id']}">
                                <a href="#">{$ds['vehicle_num']}</a>
                            </td>
                            
                            <td data-value="{$ds['insurance_amount']}"><span class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['insurance_amount']}
                                    </span> &nbsp;(
                                <span class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['rebate_amount']}</span>)</td>
                            <td class="amount" data-value="{$ds['insurance_total']}" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['insurance_total']}</td>
                            <td data-value="{strtotime($ds['insurance_date'])}">
                                {date( $config['df'], strtotime($ds['insurance_date']))}
                            </td>
                            <td data-value="{strtotime($ds['due_date'])}">
                                {date( $config['df'], strtotime($ds['due_date']))}
                            </td>
                            <td>
                                {if $pay_status_string[$ds['id']] eq 'Paid'}
                                <div class="label-success" style="margin:0 auto;font-size:85%;width:85px">
                                    {$pay_status_string[$ds['id']]}</div>
                                {elseif $pay_status_string[$ds['id']] eq 'unPaid'}
                                <div class="label-danger" style="color:#ff2222;margin:0 auto;font-size:85%;width:85px">
                                    {$pay_status_string[$ds['id']]}</div>
                                {else}
                                <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;font-size:85%;width:85px;">
                                    {$pay_status_string[$ds['id']]}</div>
                                {/if}
                            </td>
                            <td class="text-right">
                                {if {$ds['pay_status']} neq 0}
                                <a href="#" class="btn btn-xs" id="{$ds['id']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee" disabled
                                    data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {else}
                                <a href="#" class="btn btn-warning btn-xs add_expense" id="{$ds['id']}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                    data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {/if}

                                <a href="#" class="btn btn-info btn-xs edit_insurance" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
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
        </div>
    </div>
</div>
{/block}
