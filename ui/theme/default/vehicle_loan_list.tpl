{extends file="$layouts_admin"}


{block name="content"}
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">

                <a href="#" class="btn btn-primary add_loan waves-effect waves-light" id="add_company">
                    <i class="fa fa-plus"></i> {$_L['Add New Loan']}</a>

            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>{$_L['Loans']}</h5>
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
                            <th>{$_L['Loan Type']}</th>
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Duration']}</th>
                            <th>{$_L['Loan Date']}</th>
                            <th>{$_L['Expire Date']}</th>
                            <th>{$_L['Next Due Date']}</th>
                            <th>{$_L['Status']}</th>
                            <th class="text-right" width="120px;">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $d as $ds}
                        <tr>
                            <td data-value="{$ds['id']}">
                                {$ds['id']}
                            </td>
                            <td class="loan_view" data-value="{$ds['vehicle_num']}" id="{$ds['id']}">
                                <a href="#">{$ds['vehicle_num']}</a>
                            </td>
                            <td data-value="{$ds['loan_type']}">
                                {$ds['loan_type']}
                            </td>
                            <td class="amount" data-value="{$ds['principal_amount']}" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['principal_amount']}</td>
                            <td data-value="{$duration_count[$ds['id']]}">
                                {round($duration_count[$ds['id']],2)} 
                                {if $ds['repay_cycle_type'] eq 'weekly'} week {/if}
                                {if $ds['repay_cycle_type'] eq 'monthly'} month {/if}
                                {if $ds['repay_cycle_type'] eq 'yearly'} year {/if}
                            </td>
                            <td data-value="{strtotime($ds['loan_date'])}">
                                {date( $config['df'], strtotime($ds['loan_date']))}
                            </td>
                            <td data-value="{strtotime($ds['expire_date'])}">
                                {date( $config['df'], strtotime($ds['expire_date']))}
                            </td>
                            <td data-value="{strtotime($next_duedate[$ds['id']])}">
                                {date( $config['df'], strtotime($next_duedate[$ds['id']]))}
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
                                <a href="#" class="btn btn-primary btn-xs loan_view" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                   <i class="fa fa-file-text-o"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-xs edit_loan" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
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
{/block}
