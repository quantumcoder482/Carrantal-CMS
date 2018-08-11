{extends file="$layouts_admin"}

{block name="content"}


    <div class="row">
        <div class="col-md-12">
            <h3 class="ibilling-page-header">{$_L['Invoices']}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">


                    {$_L['Invoices']} - {$_L['Paid']} [ {$_L['Last 12 Months']} ]

                    <div class="ibox-tools">

                        <a href="{$_url}invoices/add/" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> {$_L['Add Invoice']}</a>

                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-md-9">
                            <div class="container_sales_chart" id="container_sales_chart" style="min-height: 450px;"></div>
                        </div>
                        <div class="col-md-3">
                            <a class="dashboard-stat green" href="javascript:void(0);">
                                <div class="visual">
                                    <i class="icon-credit-card-1"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span class="amount">{$total_invoice}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Total Invoice']} </div>
                                </div>
                            </a>

                            <a class="dashboard-stat purple" href="javascript:void(0);">
                                <div class="visual">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span class="amount">{$total_invoice_items}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Sales Count']} </div>
                                </div>
                            </a>

                            <a class="dashboard-stat blue" href="javascript:void(0);">
                                <div class="visual">
                                    <i class="fa fa-calculator"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span class="amount">{$total_invoice_amount}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Total Amount']} </div>
                                </div>
                            </a>
                        </div>
                    </div>



                    <h4>{$_L['Recent Invoices']}</h4>

                    {if $view_type == 'filter'}
                        <form class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" name="name" id="foo_filter" class="form-control" placeholder="{$_L['Search']}..."/>

                                    </div>
                                </div>

                            </div>
                        </form>
                    {/if}


                    <table class="table table-bordered table-hover sys_table footable" {if $view_type == 'filter'} data-filter="#foo_filter" data-page-size="50" {/if}>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Account']}</th>
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Invoice Date']}</th>
                            <th>{$_L['Due Date']}</th>
                            <th>
                                {$_L['Status']}
                            </th>
                            <th>{$_L['Type']}</th>
                            <th class="text-right" width="120px;">{$_L['Manage']}</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach $d as $ds}
                            <tr>
                                <td  data-value="{$ds['id']}"><a href="{$_url}invoices/view/{$ds['id']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a> </td>
                                <td><a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a> </td>
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
                                    {else}
                                        {ib_lan_get_line($ds['status'])}
                                    {/if}



                                </td>
                                <td>
                                    {if $ds['r'] eq '0'}
                                        <span class="label label-default"><i class="fa fa-dot-circle-o"></i> {$_L['Onetime']}</span>
                                    {else}
                                        <span class="label label-default"><i class="fa fa-repeat"></i> {$_L['Recurring']}</span>
                                    {/if}
                                </td>
                                <td class="text-right">

                                    <a href="{$_url}invoices/view/{$ds['id']}/" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['View']}"><i class="fa fa-file-text-o"></i></a>
                                    <a href="{$_url}invoices/clone/{$ds['id']}/" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Clone']}"><i class="fa fa-files-o"></i></a>
                                    <a href="{$_url}invoices/edit/{$ds['id']}/" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger btn-xs cdelete" id="iid{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Delete']}"><i class="fa fa-trash"></i></a>


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


{block name="script"}

    <script src="{$app_url}ui/lib/chartjs.min.js?ver={$file_build}"></script>

    <script>

        jQuery(document).ready(function() {

            var container_sales_chart = document.getElementById("container_sales_chart");
            var salesChart = echarts.init(container_sales_chart);

            var salesChartOption;

            salesChartOption = {
                color: ['#2196f3'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {
                        type : 'shadow'
                    }
                },
                grid: {
                    left: '2%',
                    right: '2%',
                    bottom: '15%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        data : [
                            {foreach $m['display'] as $m}
                            '{$m}',
                            {/foreach}
                        ],
                        axisTick: {
                            alignWithLabel: true
                        },
                        axisLabel : {
                            rotate : 45,
                            interval : 0
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'{$_L['Amount']}',
                        type:'bar',
                        barWidth: '60%',
                        data:[
                            {foreach $m['data'] as $d}
                            {$d},
                            {/foreach}
                        ]
                    }
                ]
            };

            salesChart.setOption(salesChartOption, true);


        });



    </script>
{/block}