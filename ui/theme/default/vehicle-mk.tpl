{extends file="$layouts_admin"}


{block name="content"}
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">

                <a href="#" class="btn btn-primary add_company waves-effect waves-light" id="add_company">
                    <i class="fa fa-plus"></i> {$_L['Add New Make s Model']}</a>


            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{$_L['Make s Model']}</h5>
            </div>
            <div class="ibox-content">

                {*if $view_type == 'filter'*}
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
                {*/if*}

                <table class="table table-bordered table-hover sys_table footable" {if $view_type=='filter' } data-filter="#foo_filter" data-page-size="50"
                    {/if}>
                    <thead>
                        <tr>
                            <th>{$_L['Make']}</th>
                            <th>{$_L['Model']}</th>
                            <th>{$_L['Engine Capacity']}</th>
                            <th>{$_L['Transmission']}</th>
                            <th>{$_L['Fuel Type']}</th>
                            <th class="text-right" width="120px;">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $d as $ds}
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