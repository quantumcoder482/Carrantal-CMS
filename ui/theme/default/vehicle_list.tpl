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
                    <input type="hidden" id="sure_msg" value="{$_L['are_you_sure']}" />
                </form>
                {/if}

                <table class="table table-bordered table-hover sys_table footable" {if $view_type=='filter' } data-filter="#foo_filter" data-page-size="50"{/if}>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Image']}</th>
                            <th>{$_L['Vehicle No']}</th>
                            <th>{$_L['Make s Model']}</th>
                            <th>{$_L['Purchase Price']}</th>
                            <th>{$_L['Purchase Date']}</th>
                            <th>{$_L['Expiry Date']}</th>
                            <th>{$_L['Status']}</th>
                            <th>{$_L['Certificate']}</th>
                            <th class="text-right" width="120px;">{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $d as $ds}
                        <tr>
                            <td>
                                <a href="#" data-value="{$ds['id']}" >{$ds['id']}</a>
                            </td>
                            <td data-value="{$ds['v_i']}" alt="{$ds['v_i']}">
                                <a href="#" class="view_vehicle_img" id="{$ds['id']}">
                                    {if {$ds['v_i']} eq ''}
                                        <img src="{$baseUrl}/ui/lib/imgs/item_placeholder.png" width="40px" />
                                    {else}    
                                        <img src="{$baseUrl}/storage/items/thumb{$ds['v_i']}" width="40px" />
                                    {/if}
                                </a>
                            </td>

                            <td class="vehicle_summary" data-value="{$ds['vehicle_num']}" id="{$ds['id']}">
                                <a href="#">{$ds['vehicle_num']}</a>
                            </td>
                            <td data-value="{$ds['vehicle_type']}">
                                {$ds['vehicle_type']}
                            </td>
                            <td class="amount" data-value="{$ds['purchase_price']}" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['purchase_price']}</td>
                            <td data-value="{strtotime($ds['purchase_date'])}">
                                {date( $config['df'], strtotime($ds['purchase_date']))}
                            </td>
                            <td data-value="{strtotime($ds['expiry_date'])}">
                                {date( $config['df'], strtotime($ds['expiry_date']))}
                            </td>
                            <td>
                                <!-- {if $ex_status[$ds['id']] eq 'Active'}
                                <span class="label label-success">
                                     {$ex_status[$ds['id']]}</span>
                                {elseif $ex_status[$ds['id']] eq 'Expired'}
                                <span class="label label-danger" style="color:#ff2222">
                                     {$ex_status[$ds['id']]}</span>
                                {else}
                                <span class="label label-warning" style="color: #f7931e">
                                     {$ex_status[$ds['id']]}</span>
                                {/if} -->
                                
                                {if $ex_status[$ds['id']] eq 'Active'}
                                <div class="label-success" style="margin:0 auto;font-size:85%;width:95px">
                                    {$ex_status[$ds['id']]}</div>
                                {elseif $ex_status[$ds['id']] eq 'Expired'}
                                <div class="label-danger" style="color:#ff2222;margin:0 auto;font-size:85%;width:95px">
                                    {$ex_status[$ds['id']]}</div>
                                {else}
                                <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;font-size:85%;width:95px;">
                                    {$ex_status[$ds['id']]}</div>
                                {/if} 

                            </td>
                            <td>
                                {if {$ds['v_o_c']} neq ''}
                                <a href="#" class="btn btn-primary btn-xs view_cert_img" style="background-color:#f7931e; border:none;" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    <i class="fa fa-paperclip" ></i>
                                </a>
                                {/if}
                            </td>
                            <td class="text-right">
                                <a href="#" class="btn btn-primary btn-xs vehicle_summary" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Summary']}">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-xs edit_vehicle" id="{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}">
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