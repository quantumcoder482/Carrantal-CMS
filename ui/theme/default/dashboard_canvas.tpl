{extends file="$layouts_admin"}

{block name="content"}

    <div class="row">

        {*<div class="col-md-12" id="ib_graph"></div>*}

        <div class="col-md-12">
            <h3 class="ibilling-page-header">{$_L['Dashboard']}</h3>
        </div>



        <div class="col-md-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="row" id="d_ajax_summary">

                        <div class="col-md-4"><div class="chart-statistic-box">
                                <div class="chart-txt">
                                    <div class="chart-txt-top">
                                        <p><span class="amount number">{$net_worth}</span></p>
                                        <hr>
                                        <p class="caption">{$_L['Net Worth']}</p>
                                    </div>
                                    <table class="tbl-data">
                                        <tr>
                                            <td class="amount">{$ti}</td>
                                            <td>{$_L['Income Today']}</td>
                                        </tr>
                                        <tr>
                                            <td class="amount">{$te}</td>
                                            <td>{$_L['Expense Today']}</td>
                                        </tr>
                                        <tr>
                                            <td class="amount">{$mi}</td>
                                            <td>{$_L['Income This Month']}</td>
                                        </tr>
                                        <tr>
                                            <td class="amount">{$me}</td>
                                            <td>{$_L['Expense This Month']}</td>
                                        </tr>
                                    </table>
                                </div>

                            </div></div>


                        <div class="col-md-8">


                            <div class="chart-container">
                                <div class="" style="height:350px" id="inc_vs_exp_t">
                                    <div class="md-preloader text-center"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="32" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div>
                                </div>
                            </div>

                        </div>


                    </div>


                    <hr>




                    <div class="row">

                        <div class="col-md-6">

                            <div id="expense_pie_graph" style="height: 380px">

                            </div>

                        </div>


                        <div class="col-md-3">

                            <a class="dashboard-stat blue" href="{$_url}transactions/deposit/">
                                <div class="visual">
                                    <i class="fa fa-calculator"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span class="amount">{$total_income}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Total Income']} </div>
                                </div>
                            </a>

                            <a class="dashboard-stat red" href="{$_url}transactions/expense/">
                                <div class="visual">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span class="amount">{$total_expense}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Total Expense']} </div>
                                </div>
                            </a>

                            <a class="dashboard-stat green" href="{$_url}invoices/list/">
                                <div class="visual">
                                    <i class="icon-credit-card-1"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span class="amount">{$total_invoice_paid}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Total Invoice Paid']} </div>
                                </div>
                            </a>



                        </div>

                        <div class="col-md-3">

                            <a class="dashboard-stat green" href="{$_url}contacts/list/">
                                <div class="visual">
                                    <i class="icon-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{$customers_total}">{$customers_total}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Customers']} </div>
                                </div>
                            </a>

                            <a class="dashboard-stat purple" href="{$_url}contacts/companies/">
                                <div class="visual">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{$companies_total}">{$companies_total}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Companies']} </div>
                                </div>
                            </a>

                            <a class="dashboard-stat blue" href="{$_url}leads/">
                                <div class="visual">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{$leads_total}">{$leads_total}</span>
                                    </div>
                                    <div class="desc text-right"> {$_L['Leads']} </div>
                                </div>
                            </a>



                        </div>

                    </div>

                    {*<a href="{$_url}contacts/add/customer/" class="btn btn-primary"><i class="icon-users"></i> Add Customer</a>*}
                    {*<a href="{$_url}transactions/deposit/" class="btn btn-success add_item waves-effect waves-light" id="add_item"><i class="fa fa-plus"></i> New Deposit</a>*}
                    {*<a href="{$_url}transactions/expense/" class="btn btn-danger add_item waves-effect waves-light" id="add_item"><i class="fa fa-minus"></i> New Expense</a>*}
                    {*<a href="{$_url}leads/" class="btn btn-primary add_item waves-effect waves-light" id="add_item"><i class="fa fa-address-card-o"></i> New Lead</a>*}
                    {*<a href="{$_url}invoices/add/" class="btn btn-primary add_item waves-effect waves-light" id="add_item"><i class="icon-credit-card-1"></i> Add Invoice</a>*}
                    {*<a href="#" class="btn btn-primary add_item waves-effect waves-light" id="update_currency"><i class="fa fa-calculator"></i> Update Currency</a>*}

                </div>
            </div>

        </div>



    </div>

    {$sections[1]}



    <div class="row">



        <div class="col-md-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">



                    <div id="d_chart" style="height: 345px;">
                        <div class="md-preloader text-center"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="32" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">




        </div>

    </div>


    <div class="row" id="sort_2">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="#" id="set_goal" class="btn btn-primary btn-xs pull-right"><i class="fa fa-bullseye"></i> {$_L['Set Goal']}</a>
                    <h5>{$_L['Net Worth n Account Balances']}</h5>
                </div>
                <div class="ibox-content" style="min-height: 365px;">
                    <div>
                        <h3 class="text-center amount">{$net_worth}</h3>
                        <div>
                            <span class="amount">{$net_worth}</span> {$_L['of']} <span class="amount">{$config['networth_goal']}</span>
                            <small class="pull-right"><span class="amount_no_currency">{$pg}</span>%</small>
                        </div>


                        <div class="progress progress-small">
                            <div style="width: {$pgb}%;" class="progress-bar progress-bar-{$pgc}"></div>
                        </div>
                    </div>
                    {*<table class="table table-striped table-bordered" style="margin-top: 26px;">*}
                        {*<th>{$_L['Account']}</th>*}
                        {*<th class="text-right">{$_L['Balance']}</th>*}
                        {*{foreach $d as $ds}*}
                            {*<tr>*}
                                {*<td>{$ds['account']}</td>*}
                                {*<td class="text-right"><span class="amount{if $ds['balance'] < 0} text-red{/if}">{$ds['balance']}</span></td>*}
                            {*</tr>*}
                        {*{/foreach}*}



                    {*</table>*}

                    <table class="table table-striped table-bordered" style="margin-top: 26px;">
                        <th>{$_L['Account']}</th>

                        {foreach $currencies as $currency}
                            <th class="text-right">{$_L['Balance']} [ {$currency->iso_code} ]</th>
                        {/foreach}



                        {foreach $accounts as $account}
                            <tr>
                                <td>{$account->account}</td>
                                {foreach $currencies as $currency}
                                    <td class="text-right amount" data-a-sign="{$currency->symbol} ">{Account::getBalance($account->id,$currency->id)}</td>
                                {/foreach}
                            </tr>
                        {/foreach}



                    </table>


                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>{$_L['Income vs Expense']} - {ib_lan_get_line(date('F'))} {date('Y')}</h5>
                </div>
                <div class="ibox-content">
                    <div id="inc_exp_pie" style="height: 330px;">
                        <div class="md-preloader text-center"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="32" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {if has_access($user->roleid,'support') && ($config['support'])}

        {*<div class="row">*}


            {*<div class="col-md-12">*}

                {*<div class="ibox float-e-margins">*}
                    {*<div class="ibox-title">*}
                        {*<a href="{$_url}invoices/list/" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> {$_L['Invoices']}</a>*}
                        {*<h5>{$_L['Invoices']}</h5>*}
                    {*</div>*}
                    {*<div class="ibox-content no-padding">*}



                        {*<table class="table table-bordered table-hover">*}
                            {*<thead>*}
                            {*<tr>*}
                                {*<th>#</th>*}
                                {*<th>{$_L['Account']}</th>*}
                                {*<th>{$_L['Amount']}</th>*}
                                {*<th>{$_L['Invoice Date']}</th>*}
                                {*<th>{$_L['Due Date']}</th>*}
                                {*<th width="110px;">{$_L['Status']}</th>*}


                            {*</tr>*}
                            {*</thead>*}
                            {*<tbody>*}

                            {*{foreach $invoices as $ds}*}
                                {*<tr>*}
                                    {*<td><a href="{$_url}invoices/view/{$ds['id']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a> </td>*}
                                    {*<td><a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a> </td>*}
                                    {*<td class="amount">{$ds['total']}</td>*}
                                    {*<td>{date( $config['df'], strtotime($ds['date']))}</td>*}
                                    {*<td>{date( $config['df'], strtotime($ds['duedate']))}</td>*}
                                    {*<td>*}


                                        {*{if $ds['status'] eq 'Unpaid'}*}
                                            {*<span class="label label-danger">{ib_lan_get_line($ds['status'])}</span>*}
                                        {*{elseif $ds['status'] eq 'Paid'}*}
                                            {*<span class="label label-success">{ib_lan_get_line($ds['status'])}</span>*}
                                        {*{elseif $ds['status'] eq 'Partially Paid'}*}
                                            {*<span class="label label-info">{ib_lan_get_line($ds['status'])}</span>*}
                                        {*{elseif $ds['status'] eq 'Cancelled'}*}
                                            {*<span class="label">{ib_lan_get_line($ds['status'])}</span>*}
                                        {*{else}*}
                                            {*{ib_lan_get_line($ds['status'])}*}
                                        {*{/if}*}

                                    {*</td>*}


                                {*</tr>*}
                            {*{/foreach}*}

                            {*</tbody>*}
                        {*</table>*}
                    {*</div>*}
                {*</div>*}


            {*</div>*}

        {*</div>*}

    {/if}

    <div class="row">

        <div class="col-sm-6 col-md-6 col-lg-4">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="{$_url}calendar/events" class="btn btn-primary btn-xs pull-right"><i class="fa fa-calendar"></i> </a>
                    <h5>{$_L['Calendar']}</h5>
                </div>
                <div class="ibox-content" style="min-height: 465px;" id="calendar_wrap">

                    <div id="calendar"></div>

                </div>
            </div>


        </div>

        <div class="col-sm-6 col-md-6 col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="{$_url}invoices/list/" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> {$_L['Invoices']}</a>
                    <h5>{$_L['Invoices']}</h5>
                </div>
                <div class="ibox-content">

                    <div id="invoice_stats" style="display: none;">

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <h4>Weekly Statistics</h4>
                            <hr>
                            <p> <a href="{$_url}invoices/list/all/weekly/">Total Invoice Generated: <span class="amount">{$weekly_total_invoice_amount}</span> </a> </p>
                            <p> <a href="{$_url}invoices/list/paid/weekly/">Total Paid: <span class="amount">{$weekly_total_invoice_paid}</span> </a> </p>
                            <p> <a href="{$_url}invoices/list/due/weekly/">Total Due: <span class="amount">{$weekly_total_invoice_due}</span> </a> </p>

                        </div>

                        <div class="col-md-6">

                            <h4>Monthly Statistics</h4>

                            <hr>

                            <p> <a href="{$_url}invoices/list/all/monthly/">Total Invoice Generated: <span class="amount">{$monthly_total_invoice_amount}</span> </a> </p>
                            <p> <a href="{$_url}invoices/list/paid/monthly/">Total Paid: <span class="amount">{$monthly_total_invoice_paid}</span> </a> </p>
                            <p> <a href="{$_url}invoices/list/due/monthly/">Total Due: <span class="amount">{$monthly_total_invoice_due}</span> </a> </p>

                        </div>


                    </div>

                    <hr>

                    <h4>{$_L['Recent Invoices']}</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Account']}</th>
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Invoice Date']}</th>
                            <th>{$_L['Due Date']}</th>
                            <th width="110px;">{$_L['Status']}</th>


                        </tr>
                        </thead>
                        <tbody>

                        {foreach $invoices as $ds}
                            <tr>
                                <td><a href="{$_url}invoices/view/{$ds['id']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a> </td>
                                <td><a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a> </td>
                                <td class="amount">{$ds['total']}</td>
                                <td>{date( $config['df'], strtotime($ds['date']))}</td>
                                <td>{date( $config['df'], strtotime($ds['duedate']))}</td>
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


                            </tr>
                        {/foreach}

                        </tbody>
                    </table>








                </div>
            </div>

        </div>


    </div>


    <div class="row">

        <div class="col-sm-6 col-md-6 col-lg-6">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Sales']}</h5>
                </div>
                <div class="ibox-content" id="sales_pie_graph_wrap">

                    <div id="sales_pie_graph" style="min-height: 300px;"></div>

                </div>
            </div>


        </div>

        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="{$_url}invoices/list/" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> {$_L['Invoices']}</a>
                    <h5>{$_L['Item']}</h5>
                </div>
                <div class="ibox-content">


                    <h4>{$_L['Sales']}</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <th>{$_L['Name']}</th>
                            <th>{$_L['Sales Count']}</th>
                            <th>{$_L['Amount']}</th>


                        </tr>
                        </thead>
                        <tbody>

                        {foreach $item_sold as $sold}
                            <tr>

                                <td>{strTrunc($sold->name,30)}</td>
                                <td>{floor($sold->sold_count)}</td>
                                <td class="amount">{$sold->total_amount}</td>



                            </tr>
                        {/foreach}

                        </tbody>
                    </table>
                </div>


            </div>

        </div>


    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>{$_L['Latest Income']}</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered">
                        <th>{$_L['Date']}</th>
                        <th>{$_L['Description']}</th>
                        <th class="text-right">{$_L['Amount']}</th>
                        {foreach $inc as $incs}
                            <tr>
                                <td>{date( $config['df'], strtotime($incs['date']))}</td>
                                <td><a href="{$_url}transactions/manage/{$incs['id']}/">{$incs['description']}</a> </td>
                                <td class="text-right amount">{$incs['amount']}</td>
                            </tr>
                        {/foreach}



                    </table>
                </div>
            </div>

        </div>


        <div class="col-md-6">


            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>{$_L['Latest Expense']}</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered">
                    <th>{$_L['Date']}</th>
                    <th>{$_L['Description']}</th>
                    <th class="text-right">{$_L['Amount']}</th>

                    {foreach $exp as $exps}
                        <tr>
                            <td>{date( $config['df'], strtotime($exps['date']))}</td>
                            <td><a href="{$_url}transactions/manage/{$exps['id']}/">{$exps['description']}</a> </td>
                            <td class="text-right amount">{$exps['amount']}</td>
                        </tr>
                    {/foreach}



                    </table>
                </div>
            </div>

        </div>


    </div>

{/block}

{block name=script}


    <script src="{$app_url}ui/lib/chartjs.min.js?ver={$file_build}"></script>



    <script>



        _L['Unpaid'] = '{$_L['Unpaid']}';
        _L['Paid'] = '{$_L['Paid']}';
        _L['Partially Paid'] = '{$_L['Partially Paid']}';
        _L['Maximum'] = '{$_L['Maximum']}';
        _L['Minimum'] = '{$_L['Minimum']}';



        $(function() {

            var _url = $("#_url").val();


            $('.amount').autoNumeric('init', {

                aSign: '{$config['currency_code']}',
                dGroup: {$config['thousand_separator_placement']},
                aPad: {$config['currency_decimal_digits']},
                pSign: '{$config['currency_symbol_position']}',
                aDec: '{$config['dec_point']}',
                aSep: '{$config['thousands_sep']}',
                vMax: '9999999999999999.00',
                vMin: '-9999999999999999.00'

            });


            $('.amount_no_currency').autoNumeric('init', {

                aSign: '',
                dGroup: {$config['thousand_separator_placement']},
                aPad: {$config['currency_decimal_digits']},
                pSign: '{$config['currency_symbol_position']}',
                aDec: '{$config['dec_point']}',
                aSep: '{$config['thousands_sep']}',
                vMax: '9999999999999999.00',
                vMin: '-9999999999999999.00'

            });


            var $modal = $('#ajax-modal');

            $.fn.modal.defaults.width = '600px';

            $('#update_currency').on('click', function(e){

                e.preventDefault();

                $('body').modalmanager('loading');

                $modal.load(base_url + 'dashboard/update_currency', '', function(){
                    $modal.modal();
                });
            });

            $modal.on('click', '.update_currency_submit', function(){
                $modal.modal('loading');

                $.post( _url + "dashboard/update_currency_submit/", $("#ib_currency_update_form").serialize())
                    .done(function( data ) {

                        if ($.isNumeric(data)) {

                           location.reload();

                        }

                        else {
                            $modal.modal('loading');
                            toastr.error(data);
                        }

                    });


            });


            $.getJSON( _url + "dashboard/json_income_vs_exp/", function( data ) {
                // console.log(data.Months);

                var  option = {

                    title : {
                        text: _L['Cash Flow'],
                        subtext: _L['Last 12 Months']
                    },
                    tooltip : {
                        trigger: 'axis'
                    },
                    legend: {
                        data:[_L['Income'],_L['Expense']]
                    },
                    toolbox: {
                        show : true,
                        feature : {
                            mark : { show: true },
                            dataView : { show: true, title : _L['Data View'],
                                readOnly: false,
                                lang: [_L['Data View'], _L['Cancel'], _L['Reset']] },
                            magicType : {
                                show: true,
                                title : {
                                    line : _L['Line'],
                                    bar : _L['Bar']
                                },
                                type: ['bar', 'line']
                            },
                            restore : { show: true, title : _L['Reset'] },
                            saveAsImage : { show: true, title : _L['Save as Image'],
                                type : 'png',
                                lang : [_L['Click to Save']] }
                        }
                    },
                    calculable : true,
                    xAxis : [
                        {
                            type : 'category',
                            data : data.Months,
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
                            name:_L['Income'],
                            type:'line',
                            data:data.Income,
                            color: [
                                ib_graph_primary_color
                            ],
                            itemStyle: {
                                normal: {
                                    barBorderRadius: 5,
                                    areaStyle: { type: 'default' }
                                },
                                emphasis: {
                                    barBorderRadius: 5,
                                    areaStyle: { type: 'default' }
                                }
                            },
                            markPoint : {
                                data : [
                                    { type : 'max', name: _L['Maximum'] },
                                    { type : 'min', name: _L['Minimum'] }
                                ],
                                label : {
                                    normal : {
                                        position : 'top',
                                        textStyle : {
                                            color : ib_graph_primary_color
                                        }
                                    }
                                }
                            },
                            markLine : {
                                data : [
                                    { type : 'average', name: _L['Average'] }
                                ]
                            }
                        },
                        {
                            name:_L['Expense'],
                            type:'line',
                            data:data.Expense,
                            color: [
                                ib_graph_secondary_color
                            ],
                            itemStyle: {
                                normal: {
                                    barBorderRadius: 5,
                                    areaStyle: { type: 'default' }
                                },
                                emphasis: {
                                    barBorderRadius: 5,
                                    areaStyle: { type: 'default' }
                                }
                            },
                            markPoint : {
                                data : [
                                    { type : 'max', name: _L['Maximum'] },
                                    { type : 'min', name: _L['Minimum'] }
                                ],
                                label : {
                                    normal : {
                                        position : 'top',
                                        textStyle : {
                                            color : ib_graph_secondary_color
                                        }
                                    }
                                }
                            },
                            markLine : {
                                data : [
                                    { type : 'average', name : _L['Average'] }
                                ]
                            }
                        }
                    ]
                };


                var chart = chartjs.init(document.getElementById('inc_vs_exp_t'));
                chart.setOption(option);


                $.getJSON( _url + "dashboard/json_d_inc_exp_month/", function( data ) {

                    var  c2_opt = {
                        tooltip : {
                            trigger: 'item',
                            formatter: {literal}"{a} <br/>{b} : {c} ({d}%)"{/literal}
                        },
                        legend: {
                            orient : 'vertical',
                            x : 'left',
                            data:['Income','Expense']
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                mark : { show: true },
                                dataView : { show: true, title : _L['Data View'],
                                    readOnly: false,
                                    lang: [_L['Data View'], _L['Cancel'], _L['Reset']] },
                                restore : { show: true, title : 'Reset' },
                                saveAsImage : { show: true, title : _L['Save as Image'],
                                    type : 'png',
                                    lang : [_L['Click to Save']] }
                            }
                        },
                        calculable : true,
                        series : [
                            {
                                name:_L['Income vs Expense'],
                                type:'pie',
                                radius : ['50%', '60%'],
                                color: [
                                    ib_graph_primary_color,ib_graph_secondary_color
                                ],

                                itemStyle : {
                                    normal : {
                                        label : {
                                            show : true
                                        },
                                        labelLine : {
                                            show : true
                                        }
                                    },
                                    emphasis : {
                                        label : {
                                            show : true,
                                            position : 'center',
                                            textStyle : {
                                                fontSize : '30',
                                                fontWeight : 'bold'
                                            }
                                        }
                                    }
                                },
                                data:[
                                    { value:data.Income, name:_L['Income'] },
                                    { value:data.Expense, name:_L['Expense'] }
                                ]
                            }
                        ]
                    };

                    var c2 = chartjs.init(document.getElementById('inc_exp_pie'));
                    c2.setOption(c2_opt);


                    $.getJSON( _url + "dashboard/json_d_chart_data/", function( data ) {
                        // console.log(data.Months);

                        var c3_opt =  {
                            title : {
                                text: _L['Income n Expense'],
                                subtext: c_month + ' ' + c_year
                            },
                            tooltip : {
                                trigger: 'axis'
                            },
                            legend: {
                                data:[_L['Income'],_L['Expense']]
                            },
                            toolbox: {
                                show : true,
                                feature : {
                                    mark : { show: true },
                                    dataView : { show: true, readOnly: false, title : _L['Data View'],
                                        lang: [_L['Data View'], _L['Cancel'], _L['Reset']] },
                                    magicType : { show: true, title : {
                                        line : 'Line',
                                        bar : 'Bar',
                                        stack : 'Stack',
                                        tiled : 'Tiled',
                                        force: 'Force',
                                        chord: 'Chord',
                                        pie: 'Pie',
                                        funnel: 'Funnel'
                                    }, type: ['line', 'bar', 'stack', 'tiled']},
                                    restore : { show: true, title : 'Reset' },
                                    saveAsImage : { show: true, title : _L['Save as Image'],
                                        type : 'png',
                                        lang : [_L['Click to Save']]}
                                }
                            },
                            calculable : true,
                            xAxis : [
                                {
                                    type : 'category',
                                    boundaryGap : false,
                                    data : [
                                        '01',
                                        '02',
                                        '03',
                                        '04',
                                        '05',
                                        '06',
                                        '07',
                                        '08',
                                        '09',
                                        '10',
                                        '11',
                                        '12',
                                        '13',
                                        '14',
                                        '15',
                                        '16',
                                        '17',
                                        '18',
                                        '19',
                                        '20',
                                        '21',
                                        '22',
                                        '23',
                                        '24',
                                        '25',
                                        '26',
                                        '27',
                                        '28',
                                        '29',
                                        '30',
                                        '31'
                                    ]
                                }
                            ],
                            yAxis : [
                                {
                                    type : 'value'
                                }
                            ],
                            series : [
                                {
                                    name:_L['Income'],
                                    type:'bar',
                                    color: [
                                        ib_graph_primary_color
                                    ],
                                    smooth:true,
                                    itemStyle: {
                                        normal: {

                                            areaStyle: { type: 'default' }

                                        }
                                    },
                                    markPoint : {
                                        data : [
                                            { type : 'max', name: _L['Maximum'] }
                                        ],
                                        label : {
                                            normal : {
                                                position : 'top',
                                                textStyle : {
                                                    color : ib_graph_secondary_color
                                                }
                                            }
                                        }
                                    },
                                    markLine : {
                                        data : [
                                            { type : 'average', name : _L['Average'] }
                                        ]
                                    },
                                    data:data.Income
                                },
                                {
                                    name:_L['Expense'],
                                    type:'bar',
                                    color: [
                                        ib_graph_secondary_color
                                    ],
                                    smooth:true,
                                    itemStyle: {
                                        normal: {
                                            areaStyle: { type: 'default' }
                                        }
                                    },
                                    markPoint : {
                                        data : [
                                            { type : 'max', name: _L['Maximum'] }
                                        ],
                                        label : {
                                            normal : {
                                                position : 'top',
                                                textStyle : {
                                                    color : ib_graph_secondary_color
                                                }
                                            }
                                        }
                                    },
                                    markLine : {
                                        data : [
                                            { type : 'average', name : _L['Average'] }
                                        ]
                                    },

                                    data:data.Expense
                                }
                            ]
                        };


                        var c3_d = chartjs.init(document.getElementById('d_chart'));
                        c3_d.setOption(c3_opt);


                        // load invoice stats

                        var invoice_stats = $("#invoice_stats");




                        $.get( _url + "dashboard/invoice_stats_json/", function( data ) {

                            invoice_stats.html(' <span class="font-12 head-font txt-dark">'+_L['Unpaid']+'<span class="pull-right">'+ data.Unpaid.percentage +'%</span></span>\
                        <div class="progress progress-small mt-10">\
                        <div class="progress-bar progress-bar-danger" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: '+ data.Unpaid.percentage +'%" role="progressbar"> <span class="sr-only">'+ data.Unpaid.percentage +'%</span> </div>\
                        </div>\
                        <span class="font-12 head-font txt-dark">'+_L['Partially Paid']+'<span class="pull-right">'+ data['Partially Paid'].percentage +'%</span></span>\
                        <div class="progress progress-small mt-10">\
                        <div class="progress-bar progress-bar-inverse" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: '+ data['Partially Paid'].percentage +'%" role="progressbar"> <span class="sr-only">'+ data['Partially Paid'].percentage +'</span> </div>\
                        </div>\
                        <span class="font-12 head-font txt-dark">'+_L['Paid']+'<span class="pull-right">'+ data.Paid.percentage +'%</span></span>\
                        <div class="progress progress-small mt-10">\
                        <div class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: '+ data.Paid.percentage +'%" role="progressbar"> <span class="sr-only">'+ data.Paid.percentage +'</span> </div>\
                        </div>\
                        ');
                            invoice_stats.slideDown( "slow" );

                            // Load Account Balances



                        });

                    });


                });



            });


            // if(typeof(load_modules) != "function"){
            //     var this_body = $('body');
            //     this_body.html('');
            // }
















            $("[data-counter='counterup']").counterUp({ delay:10,time:1e3 });


            var $calendar_wrap = $("#calendar_wrap");
            var ib_calendar_options = {
                customButtons: {},
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,viewFullCalendar'
                },
                loading: function(isLoading, view) {
                    if (isLoading) {
                        $calendar_wrap.block({ message: block_msg });
                    } else {
                        $calendar_wrap.unblock();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                },
                editable: false,
                eventLimit: 3,
                lang: ib_lang,
                isRTL: ib_rtl,
                eventSources: [{
                    url: _url + 'calendar/data/',
                    type: 'GET',
                    error: function() {
                        bootbox.alert("Unable to load data.");
                    }
                } ],
                eventRender: function(event, element) {
                    element.attr('title', event._tooltip);
                    element.attr('data-toggle', 'tooltip');
                },
                eventStartEditable: false,
                firstDay: parseInt(ib_calendar_first_day)
            };


            // $('.panel').lobiPanel({
            // });


            $('#calendar').fullCalendar(ib_calendar_options);


            $( ".mmnt" ).each(function() {
                var ut = $( this ).html();
                $( this ).html(moment.unix(ut).fromNow());
            });


            var expense_graph_dom = document.getElementById("expense_pie_graph");

            var expensePieChart;
            expensePieChart = chartjs.init(expense_graph_dom);
            var opt_expense_cat =  {
                title : {
                    text: '{$_L['Expense']}',
                    subtext: '{$_L['Expense by Category']}',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: {literal}"{a} <br/>{b} : {c} ({d}%)"{/literal}
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: [

                        {foreach $expense_cats as $expnese_cat}
                        '{$expnese_cat->name}',
                        {/foreach}
                    ]
                },

                series : [
                    {
                        name: 'Expense',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        color: [
                           '#2196f3',
                            '#46BE8A',
                            '#8E44AD',
                            '#FFCC29',
                            '#F37070'
                        ],
                        data:[

                            {foreach $expense_cats as $expnese_cat}
                            { value:{$expnese_cat->total_amount}, name:'{$expnese_cat->name}' },
                            {/foreach}
                        ],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(33,150,243, 0.5)'
                            }
                        }
                    }
                ]
            };


            expensePieChart.setOption(opt_expense_cat, true);



            var sales_graph_dom = document.getElementById("sales_pie_graph");

            var salesPieChart;
            salesPieChart = chartjs.init(sales_graph_dom);
            var opt_sales_pie_chart =  {
                title : {
                    text: '{$_L['Sales']}',
                    subtext: '{$_L['Item']}',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: {literal}"{a} <br/>{b} : {c} ({d}%)"{/literal}
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: [

                        {foreach $item_sold as $sold}
                        '{strTrunc($sold->name,30)}',
                        {/foreach}
                    ]
                },

                series : [
                    {
                        name: '{$_L['Sales']}',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        color: [
                            '#2196f3',
                            '#46BE8A',
                            '#8E44AD',
                            '#FFCC29',
                            '#F37070'
                        ],
                        data:[

                            {foreach $item_sold as $sold}
                            { value:{$sold->sold_count}, name:'{strTrunc($sold->name,30)}' },
                            {/foreach}
                        ],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(33,150,243, 0.5)'
                            }
                        }
                    }
                ]
            };


            salesPieChart.setOption(opt_sales_pie_chart, true);






        });






    </script>


{/block}