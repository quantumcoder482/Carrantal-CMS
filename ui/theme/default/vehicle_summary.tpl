{extends file="$layouts_admin"}

{block name="content"}

    <div class="row">
        <div class="col-md-12">
            <h4 class="ibilling-page-header">{$_L['Vehicle Summary']} : <a href="#">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</a></h4>
            <input type="hidden" id="vehicle_number" name="vehicle_number" value="{$vehicle['vehicle_num']}" >
            <input type="hidden" id="loan_id" name="loan_id" value="{$loan_val['id']}" />
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <a class="dashboard-stat red" href="#">
                            <div class="visual">
                                <i class="fa fa-calculator"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$total_expense_amount}</span>
                                </div>
                                <div class="desc text-right"> {$_L['Total Expense']} </div>
                            </div>
                        </a>
                    </div>
                        
                    <div class="col-md-3">
                        <a class="dashboard-stat blue" href="#">
                            <div class="visual">
                                <i class="fa fa-calculator"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span class="amount"  data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$income_total}</span>
                                </div>
                                <div class="desc text-right"> {$_L['Total Sales']} </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="dashboard-stat green" href="#">
                            <div class="visual">
                                <i class="fa fa-calculator"></i>
                            </div>
                            <div class="details">
                                <div class="number" {if ($income_total-$total_expense_amount) lt 0 }style="color:red" {/if}>
                                    <span class="amount"  data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$income_total-$total_expense_amount}</span>
                                </div>
                                <div class="desc text-right"> {$_L['Net Profits']} </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="dashboard-stat purple" href="#">
                            <div class="visual">
                                <i class="fa fa-calculator"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span style="color:yellow">{$remain_day}</span>
                                </div>
                                <div class="desc text-right"> {$_L['Remaining Day']} </div>
                            </div>
                        </a>
                    </div>                      
                </div>
            
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div>
                            {if $vehicle['v_i'] neq ''}
                            <img src="{$baseUrl}/storage/items/{$vehicle['v_i']}" alt="" style="width: 100%;">
                            {else}
                            <img src="{$baseUrl}/ui/lib/imgs/vehicle_placeholder.png" style="width:100%"/>
                            {/if}
                        </div>
                        <div style="margin-top: 50px;">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <h4 style="margin-left:15px;">{$_L['Vehicle Depreciation']}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="summary-box">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td class="title" width="20%">{$_L['Amount']}</td>
                                                    <td class="title" width="20%">{$_L['Paid Amount']}</td>
                                                    <td class="title" width="20%">{$_L['Balance']}</td>
                                                    <td class="title" width="20%">{$_L['Status']}</td>
                                                    <td class="title" width="20%">{$_L['Manage']}</td>
                                                </tr>
                                                <tr>
                                                    <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$vehicle_totalcost}</td>
                                                    <td class="amount" style="color:#08aaf5" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_vehicle}</td>
                                                    <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$v_d_balance}</td>
                                                    <td style="text-align:center;">
                                                        {if $v_d_status eq 'Paid'}
                                                        <div class="label-success" style="margin:0 auto;width:70px">
                                                            {$v_d_status}</div>
                                                        {elseif $v_d_status eq 'unPaid'}
                                                        <div class="label-danger" style="color:#ff2222;margin:0 auto;width:70px">
                                                            {$v_d_status}</div>
                                                        {else}
                                                        <div class="label-warning" style="border-color:#08aaf5;color: #08aaf5;margin:0 auto;width:70px;">
                                                            {$v_d_status}</div>
                                                        {/if}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {if $v_d_status eq "Paid"}
                                                        <a href="#" class="btn btn-xs" id="" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#f8f8f8; font-weight: 800"
                                                            data-toggle="tooltip" data-placement="top" title="{$_L['Add Expense']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {else}
                                                        <a href="#" class="btn btn-warning btn-xs vehicle_expense" id="{$v_d_balance}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee; font-weight: 800"
                                                            data-toggle="tooltip" data-placement="top" title="{$_L['Add Expense']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {/if}
                                                    </td>
                                                    
                                                </tr>
                                               
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <h4 style="margin-left:15px;">{$_L['Vehicle Information']}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered table-p-info">
                                            <tr>
                                                <td class="title-info" width="40%"><span>{$_L['Vehicle No']}</span></td>
                                                <td><span style="font-weight:800; color: #333333">{$vehicle['vehicle_num']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Make']}</span></td>
                                                <td><span>{$vehicle_type['make']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Model']}</span></td>
                                                <td><span>{$vehicle_type['model']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Engine Capacity']}</span></td>
                                                <td><span>{$vehicle_type['engine_capacity']*1000}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Transmission']}</span></td>
                                                <td><span>{if $vehicle_type['transmission'] eq "A"}Automatic{else}Manual{/if}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Fuel Type']}</span></td>
                                                <td><span>{$vehicle_type['fuel_type']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Color']}</span></td>
                                                <td><span>{$vehicle_type['color']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Engine No']}</span></td>
                                                <td><span>{$vehicle['engine_num']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Chassis No']}</span></td>
                                                <td><span>{$vehicle['chassis_num']}</span></td>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Purchase Price']}</span></td>
                                                <td><span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$vehicle['purchase_price']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['PARF Value']}</span></td>
                                                <td><span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$vehicle['parf_cost']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Purchase Date']}</span></td>
                                                <td> <span>{date($config['df'], strtotime($vehicle['purchase_date']))}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Scrap Date']}</span></td>
                                                <td><span>{date($config['df'], strtotime($vehicle['expiry_date']))}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title-info"><span>{$_L['Expiry Remaining Days']}</span></td>
                                                <td><span>{$expiry_remain_days}</span></td>
                                            </tr>

                                            <!-- Custome Fields -->

                                            {foreach $fs as $f}
                                            <tr>
                                                <td class="title-info"><span>{$f['fieldname']}</span></td>
                                                <td><span>{$cf_value[$f['id']]}</span></td>
                                            </tr>
                                            {/foreach}

                                            <tr>
                                                <td class="title-info"><span>{$_L['Description']}</span></td>
                                                <td><span>{$vehicle['description']}</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <h4 style="margin-left:15px;">{$_L['Total Vehicle Depreciation p Expense']}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="20%" style="border-left-style:hidden; border-top-style:hidden"></td>
                                                <td class="title" style="color:green">{$_L['Total']}</td>
                                                <td class="title" width="20%">{$_L['Daily']}</td>
                                                <td class="title" width="20%">{$_L['Weekly']}</td>
                                                <td class="title" width="20%">{$_L['Monthly']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title" width="20%">{$_L['Vehicle']}</td>
                                                <td class="amount" style="color:#08aaf5" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_vehicle}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_vehicle/$expiry_remain_days}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{($expense_vehicle/$expiry_remain_days)*7}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{($expense_vehicle/$expiry_remain_days)*30}</td>
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Insurance']}</td>
                                                {*if $expense_insurance neq null*}
                                                <td class="amount" style="color:green" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_insurance}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_insurance/$expiry_remain_days}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{($expense_insurance/$expiry_remain_days)*7}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{($expense_insurance/$expiry_remain_days)*30}</td>
                                                {*else*}
                                                <!-- <td></td><td></td><td></td><td></td> -->
                                                {*/if*}
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Road Tax']}</td>
                                                {*if $expense_roadtax neq null*}
                                                <td class="amount" style="color:green" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_roadtax}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_roadtax/$expiry_remain_days}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{($expense_roadtax/$expiry_remain_days)*7}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{($expense_roadtax/$expiry_remain_days)*30}</td>
                                                {*else*}
                                                <!-- <td></td><td></td><td></td><td></td> -->
                                                {*/if*}
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Loan p Interest']}</td>
                                                 {*if $expense_loan neq null*}
                                                <td class="amount" style="color:green" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_loan}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_loan/$expiry_remain_days}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{($expense_loan/$expiry_remain_days)*7}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{($expense_loan/$expiry_remain_days)*30}</td>
                                                {*else*}
                                                <!-- <td></td><td></td><td></td><td></td> -->
                                                {*/if*}
                                            </tr>
                                            <tr>
                                                <td class="title" style="background-color:#e8e8e8" width="20%">{$_L['Total']}</td>
                                                <td class="amount" style="font-weight:600; color:green; background-color:#f0f0f0" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}" width="20%">{$vehicle_total_expense}</td>
                                                <td class="amount" style="font-weight:600; background-color:#f0f0f0" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}" width="20%">{$vehicle_total_expense/$expiry_remain_days}</td>
                                                <td class="amount" style="font-weight:600; background-color:#f0f0f0" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}" width="20%">{($vehicle_total_expense/$expiry_remain_days)*7}</td>
                                                <td class="amount" style="font-weight:600; background-color:#f0f0f0" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}" width="20%">{($vehicle_total_expense/$expiry_remain_days)*30}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="title" style="background-color:" width="20%">{$_L['Other Expense']}</td>
                                                {*if $expense_others neq null*}
                                                <td class="amount" style="color:green" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}" width="20%">{$expense_others}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}" width="20%">{$expense_others/$expiry_remain_days}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}" width="20%">{($expense_others/$expiry_remain_days)*7}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}" width="20%">{($expense_others/$expiry_remain_days)*30}</td>
                                                {*else*}
                                                <!-- <td></td><td></td><td></td><td></td> -->
                                                {*/if*}
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <h4 style="margin-left:15px;float:left">
                                        {$_L['Vehicle Loan']} : {$loan_val['loan_type']} ({$loan_val['rate']} %)
                                    </h4>
                                    <h4 style="margin-right:15px;float:right">{$_L['Total Loan']} + {$_L['Interest']}: 
                                        <span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq '' } {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$loan_val['total_due']}</span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {if $loan_val['loan_type'] eq "Flooring"}
                                    <div class="summary-box">
                                        <table class="table table-bordered table-hover sys_table">
                                            <thead>
                                                <tr>
                                                    <th class="title">{$_L['Principal Amount']}</th>
                                                    <th class="title">{$_L['Paid Amount']}</th>
                                                    <th class="title">{$_L['Balance Due']}</th>
                                                    <th class="title">{$_L['Status']}</th>
                                                    <th class="title">{$_L['Manage']}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="amount" data-a-sign="{$config['currency_code']} "
                                                        data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$loan_val['amount']}</td>
                                                    <td class="amount" data-a-sign="{$config['currency_code']} "
                                                        data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$principal_paid_amount}</td>
                                                    <td class="amount" data-a-sign="{$config['currency_code']} "
                                                        data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$flooring_paid_balance}</td>
                                                    <td class="text-center">
                                                        {if $flooring_paystatus eq 'Paid'}
                                                        <div class="label-success" style="margin:0 auto;font-size:85%;width:85px">
                                                            {$flooring_paystatus}</div>
                                                        {elseif $flooring_paystatus eq 'unPaid'}
                                                        <div class="label-danger" style="color:#ff2222;margin:0 auto;font-size:85%;width:85px">
                                                            {$flooring_paystatus}</div>
                                                        {else}
                                                        <div class="label-warning" style="border-color:#08aaf5;color: #08aaf5;margin:0 auto;font-size:85%;width:85px;">
                                                            {$flooring_paystatus}</div>
                                                        {/if}
                                                    </td>
                                                    <td class="text-center">

                                                        {if $flooring_paystatus eq 'Paid'}
                                                        <a href="#" class="btn btn-xs" id="{$flooring_paid_balance}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee"
                                                            disabled data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {else}
                                                        <a href="#" class="btn btn-warning btn-xs principal_expense" id="{$flooring_paid_balance}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                                            data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {/if}

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="summary-box">
                                        <table class="table table-bordered table-hover" id="ib_dt_floor">
                                            <thead>
                                                <tr>
                                                    <th class="title">#</th>
                                                    <th class="title">{$_L['Due Date']}</th>
                                                    <th class="title">{$_L['Amount Due']}</th>
                                                    <th class="title">{$_L['Status']}</th>
                                                    <th class="title">{$_L['Manage']}</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                {for $i=0 to $duration_count-1}
                                                <tr>
                                                    <td style="text-align:center">{$i+1}</td>
                                                    <td>{date( $config['df'], strtotime($next_duedate[$i]))}</td>
                                                    <td>{$loan_val['interest_txt']}</td>
                                                    <td class="text-center">
                                                        {if $pay_status_string[$i] eq 'Paid'}
                                                        <div class="label-success" style="margin:0 auto;font-size:85%;width:85px">
                                                            {$pay_status_string[$i]}</div>
                                                        {elseif $pay_status_string[$i] eq 'unPaid'}
                                                        <div class="label-danger" style="color:#ff2222;margin:0 auto;font-size:85%;width:85px">
                                                            {$pay_status_string[$i]}</div>
                                                        {else}
                                                        <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;font-size:85%;width:85px;">
                                                            {$pay_status_string[$i]}</div>
                                                        {/if}
                                                    </td>
                                                    <td class="text-center">

                                                        {if $pay_status_string[$i] eq 'Paid'}
                                                        <a href="#" class="btn btn-xs" id="{$loan_val['interest_amount']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee"
                                                            disabled data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {else}
                                                        <a href="#" class="btn btn-warning btn-xs loan_expense" id="{$loan_val['interest_amount']}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                                            data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {/if}

                                                    </td>
                                                </tr>

                                                {/for}

                                                <tr>
                                                    <td style="text-align:center">{$duration_count+1}</td>
                                                    <td>{date($config['df'], strtotime($loan_val['expire_date']))}</td>
                                                    <td>{$loan_val['last_interest_txt']}</td>
                                                    <td class="text-center">
                                                        {if $pay_status_string[$duration_count-1] eq 'Paid'}
                                                        <div class="label-success" style="margin:0 auto;font-size:85%;width:85px">
                                                            {$pay_status_string[$duration_count-1]}</div>
                                                        {elseif $pay_status_string[$duration_count-1] eq 'unPaid'}
                                                        <div class="label-danger" style="color:#ff2222;margin:0 auto;font-size:85%;width:85px">
                                                            {$pay_status_string[$duration_count-1]}</div>
                                                        {else}
                                                        <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;font-size:85%;width:85px;">
                                                            {$pay_status_string[$duration_count-1]}</div>
                                                        {/if}
                                                    </td>
                                                    <td class="text-center">

                                                        {if $pay_status_string[$duration_count] eq 'Paid'}
                                                        <a href="#" class="btn btn-xs" id="{$loan_val['interest']-$loan_val['interest_amount']*$duration_count}"
                                                            style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee" disabled data-toggle="tooltip"
                                                            data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {else}
                                                        <a href="#" class="btn btn-warning btn-xs add_expense" id="{$loan_val['interest']-$loan_val['interest_amount']*$duration_count}"
                                                            style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee" data-toggle="tooltip"
                                                            data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {/if}

                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!-- <tfoot>
                                                <tr>
                                                    <td colspan="3" style="border-right-style:hidden">
                                                    </td>
                                                    <td style="text-align: right;" colspan="2">
                                                        <ul class="pagination">
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                        <div>
                                            <h4>{$_L['Total Paid']} :
                                                <span class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                                                    data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$expense_loan}</span> <br><br>
                                                {$_L['Total UnPaid']} :
                                                <span class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                                                    data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$loan_val['total_due']-$expense_loan}</span>
                                            </h4>
                                        </div>
                                    </div>

                                    {elseif $loan_val['loan_type'] eq "HP"}
                                    <div class="summary-box">
                                        <table class="table table-bordered table-hover" id="ib_dt_hp">
                                            <thead>
                                                <tr>
                                                    <th class="title">#</th>
                                                    <th class="title">{$_L['Due Date']}</th>
                                                    <th class="title">{$_L['Amount Due']}</th>
                                                    <th class="title">{$_L['Status']}</th>
                                                    <th class="title">{$_L['Manage']}</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                {for $i=0 to $duration_count-1}
                                                <tr>
                                                    <td style="text-align:center">{$i+1}</td>
                                                    <td>{date( $config['df'], strtotime($next_duedate[$i]))}</td>
                                                    <td>{$loan_val['due_amount_txt']}</td>
                                                    <td class="text-center">
                                                        {if $pay_status_string[$i] eq 'Paid'}
                                                        <div class="label-success" style="margin:0 auto;font-size:85%;width:85px">
                                                            {$pay_status_string[$i]}</div>
                                                        {elseif $pay_status_string[$i] eq 'unPaid'}
                                                        <div class="label-danger" style="color:#ff2222;margin:0 auto;font-size:85%;width:85px">
                                                            {$pay_status_string[$i]}</div>
                                                        {else}
                                                        <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;font-size:85%;width:85px;">
                                                            {$pay_status_string[$i]}</div>
                                                        {/if}
                                                    </td>
                                                    <td class="text-center">

                                                        {if $pay_status_string[$i] eq 'Paid'}
                                                        <a href="#" class="btn btn-xs" id="{$loan_val['due_amount']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee"
                                                            disabled data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {else}
                                                        <a href="#" class="btn btn-warning btn-xs loan_expense" id="{$loan_val['due_amount']}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                                            data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {/if}

                                                    </td>
                                                </tr>

                                                {/for}

                                                <tr>
                                                    <td style="text-align:center">{$duration_count+1}</td>
                                                    <td>{date($config['df'], strtotime($loan_val['expire_date']))}</td>
                                                    <td>{$loan_val['last_due_txt']}</td>
                                                    <td class="text-center">
                                                        {if $pay_status_string[$duration_count-1] eq 'Paid'}
                                                        <div class="label-success" style="margin:0 auto;font-size:85%;width:85px">
                                                            {$pay_status_string[$duration_count-1]}</div>
                                                        {elseif $pay_status_string[$duration_count-1] eq 'unPaid'}
                                                        <div class="label-danger" style="color:#ff2222;margin:0 auto;font-size:85%;width:85px">
                                                            {$pay_status_string[$duration_count-1]}</div>
                                                        {else}
                                                        <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;font-size:85%;width:85px;">
                                                            {$pay_status_string[$duration_count-1]}</div>
                                                        {/if}
                                                    </td>
                                                    <td class="text-center">

                                                        {if $pay_status_string[$duration_count] eq 'Paid'}
                                                        <a href="#" class="btn btn-xs" id="{$loan_val['total_due']-$loan_val['due_amount']*$duration_count}"
                                                            style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee" disabled data-toggle="tooltip"
                                                            data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {else}
                                                        <a href="#" class="btn btn-warning btn-xs loan_expense" id="{$loan_val['total_due']-$loan_val['due_amount']*$duration_count}"
                                                            style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee" data-toggle="tooltip"
                                                            data-placement="top" title="{$_L['View']}">
                                                            &nbsp;+ $&nbsp;
                                                        </a>
                                                        {/if}

                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!-- <tfoot>
                                                <tr>
                                                    <td colspan="3" style="border-right-style:hidden">
                                                    </td>
                                                    <td style="text-align: right;" colspan="2">
                                                        <ul class="pagination">
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                        <div>
                                            <h4>{$_L['Total Paid']} : 
                                                <span class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                                                    data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$expense_loan}</span> <br><br>
                                                {$_L['Total UnPaid']} :
                                                <span class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                                                    data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$loan_val['total_due']-$expense_loan}</span>
                                            </h4>
                                      </div>
                                    </div>
                                    {else}
                                    <div class="summary-box">
                                        <table class="table table-bordered table-hover sys_table footable">
                                            <thead>
                                                <tr>
                                                    <th class="title">#</th>
                                                    <th class="title">{$_L['Due Date']}</th>
                                                    <th class="title">{$_L['Amount Due']}</th>
                                                    <th class="title">{$_L['Status']}</th>
                                                    <th class="title">{$_L['Manage']}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>&nbsp;</td><td></td><td></td><td></td><td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    {/if}

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <h4 style="margin-left:15px;">{$_L['Road Tax']}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="title" width="7%">#</td>
                                                <td class="title" width="18%">{$_L['Due Date']}</td>
                                                <td class="title" width="32%">{$_L['Amount']} ({$_L['Rebate']})</td>
                                                <td class="title" width="18%">{$_L['Balance']}</td>
                                                <td class="title" width="15%">{$_L['Status']}</td>
                                                <td class="title" width="10%">{$_L['Manage']}</td>
                                            </tr>
                                            {if $roadtax_count eq 0}
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            {/if}
                                            {foreach $roadtaxs as $d}
                                            <tr>
                                                <td class="number" style="text-align:center">{$roadtax_count--}</td>
                                                <td class="date">{date($config['df'], strtotime($d['due_date']))}</td>
                                                <td>
                                                    <span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$d['roadtax_amount']}</span>
                                                    (<span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$d['rebate_amount']}</span>)
                                                </td>
                                                <td class="amount" {if $roadtax_paystatus[$d['id']] eq 'Paid' || $roadtax_paystatus[$d['id']] eq 'Expired' }
                                                    style="color:green" {else} style="color:#ffa500" {/if} data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$d['roadtax_total']}</td>
                                                <td style="text-align:center;">
                                                    {if $roadtax_paystatus[$d['id']] eq 'Paid'}
                                                    <div class="label-success" style="margin:0 auto;width:70px">
                                                        {$roadtax_paystatus[$d['id']]}</div>
                                                    {elseif $roadtax_paystatus[$d['id']] eq 'Expired'}
                                                    <div class="label-default" style="margin:0 auto;width:70px">
                                                        {$roadtax_paystatus[$d['id']]}</div>
                                                    {elseif $roadtax_paystatus[$d['id']] eq 'unPaid'}
                                                    <div class="label-danger" style="color:#ff2222;margin:0 auto;width:70px">
                                                        {$roadtax_paystatus[$d['id']]}</div>
                                                    {else}
                                                    <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;width:70px;">
                                                        {$roadtax_paystatus[$d['id']]}</div>
                                                    {/if}
                                                </td>
                                                <td style="text-align:center;">
                                                    {if $d['pay_status'] neq 0 && $d['expired'] neq 1}
                                                    <a href="#" class="btn btn-xs roadtax_renew" id="{$d['id']}" style="background-color:#4B0082; border-color:#4B0082; color:#f8f8f8"
                                                        data-toggle="tooltip" data-placement="top" title="{$_L['Renew']}">
                                                        {$_L['Renew']}
                                                    </a>
                                                    {elseif $d['expired'] eq 1}
                                                    <a href="#" class="btn btn-xs" id="{$d['id']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#f8f8f8"
                                                        disabled data-toggle="tooltip" data-placement="top" title="{$_L['Renew']}">
                                                        {$_L['Renew']}
                                                    </a>
                                                    {elseif {$d['pay_status']} neq 0}
                                                    <a href="#" class="btn btn-xs" id="{$d['id']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee"
                                                        disabled data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                        &nbsp;+ $&nbsp;
                                                    </a>
                                                    {else}
                                                    <a href="#" class="btn btn-warning btn-xs roadtax_expense" id="{$d['id']}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                                        data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                        &nbsp;+ $&nbsp;
                                                    </a>
                                                    {/if}
                                                </td>
                                            </tr>
                                            {/foreach}
                                            <tr>
                                                <td colspan="3" class="title-total">{$_L['Total']}</td>
                                                <td colspan="3">
                                                    <span class="amount" style="color:green" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_roadtax}</span>
                                                    {if $roadtax_unpaid_amount neq 0}
                                                    <span style="color:#ffa500">(</span>
                                                    <span class="amount" style="color:#ffa500" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$roadtax_unpaid_amount}</span>
                                                    <span style="color:#ffa500">)</span>
                                                    {/if}
                                                </td>
                                            </tr>
                    
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <h4 style="margin-left:15px;">{$_L['Insurance']}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="title" width="7%">#</td>
                                                <td class="title" width="18%">{$_L['Due Date']}</td>
                                                <td class="title" width="32%">{$_L['Amount']} ({$_L['Rebate']})</td>
                                                <td class="title" width="18%">{$_L['Balance']}</td>
                                                <td class="title" width="15%">{$_L['Status']}</td>
                                                <td class="title" width="10%">{$_L['Manage']}</td>
                                            </tr>
                                            {if $insurance_count eq 0}
                                                <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>
                                            {/if}
                                            {foreach $insurances as $d}
                                            <tr>
                                                <td class="number" style="text-align:center">{$insurance_count--}</td>
                                                <td class="date">{date($config['df'], strtotime($d['due_date']))}</td>
                                                <td>
                                                    <span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$d['insurance_amount']}</span>
                                                    (<span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$d['rebate_amount']}</span>)
                                                </td>
                                                <td class="amount" {if $insurance_paystatus[$d['id']] eq 'Paid' || $insurance_paystatus[$d['id']] eq 'Expired' } style="color:green" {else} style="color:#ffa500" {/if}
                                                     data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$d['insurance_total']}</td>
                                                <td style="text-align:center;">
                                                    {if $insurance_paystatus[$d['id']] eq 'Paid'}
                                                    <div class="label-success" style="margin:0 auto;width:70px">
                                                        {$insurance_paystatus[$d['id']]}</div>
                                                    {elseif $insurance_paystatus[$d['id']] eq 'Expired'}
                                                    <div class="label-default" style="margin:0 auto;width:70px">
                                                        {$insurance_paystatus[$d['id']]}</div>
                                                    {elseif $insurance_paystatus[$d['id']] eq 'unPaid'}
                                                    <div class="label-danger" style="color:#ff2222;margin:0 auto;width:70px">
                                                        {$insurance_paystatus[$d['id']]}</div>
                                                    {else}
                                                    <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;width:70px;">
                                                        {$insurance_paystatus[$d['id']]}</div>
                                                    {/if}
                                                </td>
                                                <td style="text-align:center;">
                                                    {if $d['pay_status'] neq 0 && $d['expired'] neq 1}
                                                    <a href="#" class="btn btn-xs insurance_renew" id="{$d['id']}" style="background-color:#4B0082; border-color:#4B0082; color:#f8f8f8"
                                                        data-toggle="tooltip" data-placement="top" title="{$_L['Renew']}">
                                                        {$_L['Renew']}
                                                    </a>
                                                    {elseif $d['expired'] eq 1}
                                                    <a href="#" class="btn btn-xs" id="{$d['id']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#f8f8f8"
                                                        disabled data-toggle="tooltip" data-placement="top" title="{$_L['Renew']}">
                                                        {$_L['Renew']}
                                                    </a>
                                                    {elseif {$d['pay_status']} neq 0}
                                                    <a href="#" class="btn btn-xs" id="{$d['id']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee"
                                                        disabled data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                        &nbsp;+ $&nbsp;
                                                    </a>
                                                    {else}
                                                    <a href="#" class="btn btn-warning btn-xs insurance_expense" id="{$d['id']}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                                        data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                                        &nbsp;+ $&nbsp;
                                                    </a>
                                                    {/if}
                                                </td>
                                            </tr>
                                            {/foreach}
                                            <tr>
                                                <td colspan="3" class="title-total">{$_L['Total']}</td>
                                                <td colspan="3">
                                                    <span class="amount" style="color:green" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expense_insurance}</span>
                                                    {if $insurance_unpaid_amount neq 0}
                                                    <span style="color:#ffa500">(</span>
                                                    <span class="amount" style="color:#ffa500" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$insurance_unpaid_amount}</span>
                                                    <span style="color:#ffa500">)</span>
                                                    {/if}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="div-title">
                                        <h4>{$_L['Recent Vehicle Sales']}</h4>
                                        <a href="#" id="{$vehicle['vehicle_num']}" class="btn btn-primary btn-sm view_transaction_income">{$_L['View Vehicle Income']}</a>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered" style="text-align:center">
                                            <tr>
                                                <td class="title">#</td>
                                                <td class="title">{$_L['Date']}</td>
                                                <td class="title">{$_L['Customer']}</td>
                                                <td class="title">{$_L['Category']}</td>
                                                <td class="title">{$_L['Amount']}</td>
                                            </tr>
                                            {foreach $incomes as $income}
                                            <tr>
                                                <td>{$income->id}</td>
                                                <td>{$income->date}</td>
                                                <td>{$customer[$income->id]}</td>
                                                <td>{$income->category}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$income->amount}</td>
                                            </tr>
                                            {/foreach}
                                            <tr height="20px"><td colspan="5" style="border-left-style:hidden; border-right-style:hidden"></td></tr>
                                            <tr>
                                                <td colspan="3" style="border-top-style:hidden;border-left-style:hidden; border-bottom-style:hidden"></td>
                                                <td class="title">{$_L['Total']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$income_total}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="div-title">
                                        <h4>{$_L['Recent Vehicle Expense']}</h4>
                                        <a href="#" id="{$vehicle['vehicle_num']}" class="btn btn-primary btn-sm view_transaction_expense">{$_L['View Vehicle Expense']}</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered" style="text-align:center;">
                                            <tr>
                                                <td class="title">#</td>
                                                <td class="title">{$_L['Date']}</td>
                                                <td class="title">{$_L['Category']}</td>
                                                <td class="title">{$_L['Amount']}</td>
                                            </tr>
                                            {foreach $recent_expenses as $t}
                                            <tr>
                                                <td>{$t['id']}</td>
                                                <td class="date">{$t['date']}</td>
                                                <td>{$t['category']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$t['amount']}</td>
                                            </tr>
                                            {/foreach}
                                            <tr height="20px">
                                                <td colspan="4" style="border-left-style:hidden; border-right-style:hidden"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-top-style:hidden; border-left-style:hidden; border-bottom-style:hidden"></td>
                                                <td class="title">{$_L['Total']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$total_expense_amount}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}