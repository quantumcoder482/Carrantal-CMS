{extends file="$layouts_admin"}


{block name="content"}

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>{$_L['List Vehicles']}</h5>                
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
                </form>
                {/if}

                <table class="table table-bordered table-hover sys_table footable" {if $view_type=='filter' } data-filter="#foo_filter" data-page-size="50"{/if}>
                    <thead>
                        <tr>
                            <th>{$_L['Image']}</th>
                            <th>{$_L['Vehicle No']}</th>
                            <th>{$_L['Make s Model']}</th>
                            <th>{$_L['Purchase Price']}</th>
                            <th>{$_L['Purchase Date']}</th>
                            <th>{$_L['Expiry Date']}</th>
                            <th>{$_L['Status']}</th>
                            <th class="text-right" width="120px;">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $vehicles as $vehicle}
                        <tr>
                            <td data-value="{$ds['id']}">
                                <a href="{$_url}invoices/view/{$ds['id']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a>
                            </td>
                            <td>
                                <a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a>
                            </td>
                            <td class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['total']}</td>
                            <td data-value="{strtotime($ds['date'])}">{date( $config['df'], strtotime($ds['date']))}</td>
                            <td data-value="{strtotime($ds['duedate'])}">{date( $config['df'], strtotime($ds['duedate']))}</td>
                            <td>

                                {if $ds['status'] eq 'Unpaid'}
                                <span class="label label-danger">{ib_lan_get_line($ds['status'])}</span>
                                {elseif $ds['status'] eq 'Paid'}
                                <span class="label label-success">{ib_lan_get_line($ds['status'])}</span>
                                {elseif $ds['status'] eq 'Partially Paid'}
                                <span class="label label-info">{ib_lan_get_line($ds['status'])}</span>
                                {elseif $ds['status'] eq 'Cancelled'}
                                <span class="label">{ib_lan_get_line($ds['status'])}</span>
                                {else} {ib_lan_get_line($ds['status'])} {/if}



                            </td>
                            <td>
                                {if $ds['r'] eq '0'}
                                <span class="label label-default">
                                    <i class="fa fa-dot-circle-o"></i> {$_L['Onetime']}</span>
                                {else}
                                <span class="label label-default">
                                    <i class="fa fa-repeat"></i> {$_L['Recurring']}</span>
                                {/if}
                            </td>
                            <td class="text-right">
                                {*
                                <a href="{$_url}invoices/view/{$ds['id']}/" class="btn btn-primary btn-xs">
                                    <i class="fa fa-check"></i> {$_L['View']}</a>*} {*
                                <a href="{$_url}invoices/edit/{$ds['id']}/" class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i> {$_L['Edit']}</a>*} {*
                                <a href="#" class="btn btn-danger btn-xs cdelete" id="iid{$ds['id']}">
                                    <i class="fa fa-trash"></i> {$_L['Delete']}</a>*}

                                <a href="{$_url}invoices/view/{$ds['id']}/" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    <i class="fa fa-file-text-o"></i>
                                </a>
                                <a href="{$_url}invoices/clone/{$ds['id']}/" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Clone']}">
                                    <i class="fa fa-files-o"></i>
                                </a>
                                <a href="{$_url}invoices/edit/{$ds['id']}/" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-xs cdelete" id="iid{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Delete']}">
                                    <i class="fa fa-trash"></i>
                                </a>


                            </td>
                        </tr>
                        {/foreach}

                    </tbody>

                    {if $view_type == 'filter'}
                    <tfoot>
                        <tr>
                            <td colspan="8">
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


<!-- <td data-value="{$ds['id']}">
    <a href="{$_url}invoices/view/{$ds['id']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a>
</td>
<td>
    <a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a>
</td>
<td class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['total']}</td>
<td data-value="{strtotime($ds['date'])}">{date( $config['df'], strtotime($ds['date']))}</td>
<td data-value="{strtotime($ds['duedate'])}">{date( $config['df'], strtotime($ds['duedate']))}</td>
<td>

    {if $ds['status'] eq 'Unpaid'}
    <span class="label label-danger">{ib_lan_get_line($ds['status'])}</span>
    {elseif $ds['status'] eq 'Paid'}
    <span class="label label-success">{ib_lan_get_line($ds['status'])}</span>
    {elseif $ds['status'] eq 'Partially Paid'}
    <span class="label label-info">{ib_lan_get_line($ds['status'])}</span>
    {elseif $ds['status'] eq 'Cancelled'}
    <span class="label">{ib_lan_get_line($ds['status'])}</span>
    {else} {ib_lan_get_line($ds['status'])} {/if}



</td>
<td>
    {if $ds['r'] eq '0'}
    <span class="label label-default">
        <i class="fa fa-dot-circle-o"></i> {$_L['Onetime']}</span>
    {else}
    <span class="label label-default">
        <i class="fa fa-repeat"></i> {$_L['Recurring']}</span>
    {/if}
</td>
<td class="text-right">
    {*
    <a href="{$_url}invoices/view/{$ds['id']}/" class="btn btn-primary btn-xs">
        <i class="fa fa-check"></i> {$_L['View']}</a>*} {*
    <a href="{$_url}invoices/edit/{$ds['id']}/" class="btn btn-info btn-xs">
        <i class="fa fa-pencil"></i> {$_L['Edit']}</a>*} {*
    <a href="#" class="btn btn-danger btn-xs cdelete" id="iid{$ds['id']}">
        <i class="fa fa-trash"></i> {$_L['Delete']}</a>*}

    <a href="{$_url}invoices/view/{$ds['id']}/" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
        <i class="fa fa-file-text-o"></i>
    </a>
    <a href="{$_url}invoices/clone/{$ds['id']}/" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Clone']}">
        <i class="fa fa-files-o"></i>
    </a>
    <a href="{$_url}invoices/edit/{$ds['id']}/" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
        <i class="fa fa-pencil"></i>
    </a>
    <a href="#" class="btn btn-danger btn-xs cdelete" id="iid{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Delete']}">
        <i class="fa fa-trash"></i>
    </a>


</td> -->