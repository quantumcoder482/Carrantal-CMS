{extends file="$layouts_admin"}


{block name="content"}
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">

                <a href="#" class="btn btn-primary add_make_model waves-effect waves-light" id="add_make_model">
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
                    <input type="hidden" name="sure_msg" id="sure_msg" value="{$_L['are_you_sure']}">
                </form>
                {/if}

                <table class="table table-bordered table-hover sys_table footable" {if $view_type=='filter' } data-filter="#foo_filter" data-page-size="10"
                    {/if}>
                    <thead>
                        <tr></tr>
                            <th>{$_L['Make']}</th>
                            <th>{$_L['Model']}</th>
                            <th>{$_L['Engine Capacity']}</th>
                            <th>{$_L['Transmission']}</th>
                            <th>{$_L['Fuel Type']}</th>
                            <th>{$_L['Color']}</th>
                            <th class="text-right" width="120px;">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $d as $ds}
                        <tr style="text-align: center">
                            <td data-value="{$ds['make']}">
                                <a href="#" class='edit_make_model' id="{$ds['id']}">{$ds['make']}</a>
                            </td>
                            <td data-value="{$ds['model']}">{$ds['model']}</td>
                            <td data-value="{$ds['engine_capacity']}">{$ds['engine_capacity']}</td>
                            <td data-value="{$ds['transmission']}">{$ds['transmission']}</td>
                            <td data-value="{$ds['fuel_type']}">{$ds['fuel_type']}</td>
                            <td data-value="{$ds['color']}">{$ds['color']}</td>
                            <td class="text-right">
                                <a href="#" class="btn btn-info btn-xs edit_make_model" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
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