{extends file="$layouts_admin"}


{block name="content"}
<div class="row" style="margin-bottom:10px">
    <div class="col-md-12">
        <a href="{$_url}cd/add_deposit" class="btn btn-primary add_deposit waves-effect waves-light" id="add_deposit">
        <i class="fa fa-plus"></i> {$_L['Add Deposit']}</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>{$_L['Deposit']}</h5>
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
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Duration']}</th>
                            <th>{$_L['Deposit Date']}</th>
                            <th>{$_L['Expire Date']}</th>
                            <th>{$_L['Next Due Date']}</th>
                            <th>{$_L['Status']}</th>
                            <th width="130px">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $d as $ds}
                      
                        <tr>
                            <td data-value="{$ds['id']}">
                                {$ds['id']}
                            </td>
                            
                            <td class="edit" data-value="{$ds['vehicle_num']}" id="{$ds['id']}">
                                <a href="#">{$ds['vehicle_num']}</a>
                            </td>
                            <td class="amount" data-value="{$ds['principal_amount']}" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['deposit_amount']}</td>
                            <td data-value="{$ds['duration']}">
                                {$ds['duration']} {$ds['repay_cycle_type']}
                            </td>
                            <td data-value="{strtotime($ds['deposit_date'])}">
                                {date( $config['df'], strtotime($ds['deposit_date']))}
                            </td>
                            <td data-value="{strtotime($expire_date[$ds['id']])}">
                                {date( $config['df'], strtotime($expire_date[$ds['id']]))}
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
                            <td class="text-center">
                                <a href="#" class="btn btn-primary btn-xs view_deposit" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    <i class="fa fa-file-text-o"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-xs edit_deposit" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
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
                            <td style="text-align: left;" colspan="9">
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
