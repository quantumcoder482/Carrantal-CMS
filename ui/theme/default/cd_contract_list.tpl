{extends file="$layouts_admin"}


{block name="content"}
<div class="row" style="margin-bottom:10px">
    <div class="col-md-12">

        <a href="#" class="btn btn-primary add_contract waves-effect waves-light" id="add_company">
            <i class="fa fa-plus"></i> {$_L['Add New Contract']}</a>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>{$_L['Contract s Agreement']}</h5>                
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
                            <th>{$_L['Date Created']}</th>
                            <th>{$_L['Date Modified']}</th>
                            <th>{$_L['Title']}</th>
                            <th>{$_L['Acknowledgement Status']}</th>
                            <th class="text-right" width="120px;">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $d as $ds}
                        <tr>
                            <td>
                                <a href="#" data-value="1" >{$ds['id']}</a>
                            </td>
                            <td data-value="{strtotime($ds['create_date'])}">
                                {date( $config['df'], strtotime($ds['create_date']))}
                            </td>
                            {if $ds['modified_date'] neq ''}
                            <td data-value="{strtotime($ds['update_date'])}">
                                {date( $config['df'], strtotime($ds['modified_date']))}
                            </td>
                            {else}
                            <td>&nbsp;</td>
                            {/if}
                            <td>
                                <a href="#" class="generate_contract" id="{$ds['id']}">{$ds['title']}</a>
                            </td>
                            <td>
                                {$s_count[$ds['id']]} / {$g_count[$ds['id']]}
                            </td>
                            <td class="text-right">
                                <a href="#" class="btn btn-primary btn-xs generate_contract" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    <i class="fa fa-file-text-o"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-xs edit_contract" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
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
                            <td style="text-align: left;" colspan="6">
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