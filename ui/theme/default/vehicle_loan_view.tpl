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
               <h5>{$_L['Vehicle No']}  {$val['vehicle_num']}</h5>
               <input type="hidden" name="loan_id" id="loan_id" value="{$val['id']}" />
            </div>

            <div class="ibox-content">
                <table class="table table-bordered table-hover sys_table ">
                    <thead>
                        <tr>
                            <th>{$_L['Loan Type']}</th>
                            <th>{$_L['Date']}</th>
                            <th>{$_L['Expire Date']}</th>
                            <th>{$_L['Duration']}</th>
                            <th>{$_L['Repayment']}</th>
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Rate']}(%)</th>
                            <th>{$_L['Interest']}</th>
                            <th>{$_L['Total Due']}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{$val['loan_type']}</td>
                            <td>{date( $config['df'], strtotime($val['date']))}</td>
                            <td>{date( $config['df'], strtotime($val['expire_date']))}</td>
                            <td>{round($duration,2)}</td>
                            <td>{$val['repayment']}</td>
                            <td class="amount" data-value="{$val['amount']}" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"                             
                            data-d-group="2">{$val['amount']}</td>
                            <td>{$val['rate']}</td>
                            <td class="amount" data-value="{$val['total_due']}" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                            data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$val['interest']}</td>
                            <td class="amount"  data-value="{$val['total_due']}" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"                             
                            data-d-group="2">{$val['total_due']}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            {if $val['loan_type'] eq "Flooring"}
            <div class="ibox-content">
                <table class="table table-bordered table-hover sys_table">
                    <thead>
                        <tr>
                            <th>{$_L['Loan Amount']}</th>
                            <th>{$_L['Paid Amount']}</th>
                            <th>{$_L['Loan Balance']}</th>
                            <th>{$_L['Status']}</th>
                            <th>{$_L['Manage']}</th>        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="amount" data-value="{$val['amount']}" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$val['amount']}</td>
                            <td class="amount" data-value="{$val['amount']}" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$principal_paid_amount}</td>
                            <td class="amount" data-value="{$val['amount']}" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$flooring_paid_balance}</td>
                            <td>
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
                                    {$_L['Add Expense']}
                                </a>
                                {else}
                                <a href="#" class="btn btn-warning btn-xs principal_expense" id="{$flooring_paid_balance}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                    data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {/if}

                            </td>
                        </tr>
                    </tbody>
            </div>

            <div class="ibox-content">
                <table class="table table-bordered table-hover sys_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Next Due Date']}</th>
                            <th>{$_L['Interest Amount']}</th>
                            <th>{$_L['Status']}</th>
                            <th>{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {for $i=0 to $duration_count-1}
                        <tr>
                            <td>{$i+1}</td>
                            <td>{date( $config['df'], strtotime($next_duedate[$i]))}</td>
                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                                data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$val['interest_amount']}</td>
                            <td>
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
                                <a href="#" class="btn btn-xs" id="{$val['interest_amount']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee"
                                    disabled data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {else}
                                <a href="#" class="btn btn-warning btn-xs add_expense" id="{$val['interest_amount']}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                    data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {/if}

                            </td>
                        </tr>

                        {/for}

                        <tr>
                            <td>{$duration_count+1}</td>
                            <td>{date($config['df'], strtotime($val['expire_date']))}</td>
                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                                data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$val['interest']-$val['interest_amount']*$duration_count}</td>
                            <td>
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
                                <a href="#" class="btn btn-xs" id="{$val['interest']-$val['interest_amount']*$duration_count}"
                                    style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee" disabled data-toggle="tooltip"
                                    data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {else}
                                <a href="#" class="btn btn-warning btn-xs add_expense" id="{$val['interest']-$val['interest_amount']*$duration_count}"
                                    style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee" data-toggle="tooltip"
                                    data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {/if}

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="font-weight:600; border-bottom-style: hidden">{$_L['Total']}</td>
                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                                data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$val['interest']}</td>
                            <td colspan="2" style="border-bottom-style:hidden">&nbsp;</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: left;" colspan="9">
                                <ul class="pagination">
                                </ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                {$paginator['contents']}
            </div>


            {/if}
            
            {if $val['loan_type'] eq "HP"}
            <div class="ibox-content">
                <table class="table table-bordered table-hover sys_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Next Due Date']}</th>
                            <th>{$_L['Loan Amount']}</th>
                            <th>{$_L['Interest Amount']}</th>
                            <th>{$_L['Due Amount']}</th>
                            <th>{$_L['Loan Balance']}</th>
                            <th>{$_L['Status']}</th>
                            <th>{$_L['Manage']}</th>
                        </tr>
                    </thead>
                    <tbody>

                     {for $i=0 to $duration_count-1}
                        <tr>
                            <td>{$i+1}</td>
                            <td>{date( $config['df'], strtotime($next_duedate[$i]))}</td>

                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                            data-d-group="2">{$val['loan_amount']}</td>
                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"                            
                            data-d-group="2">{$val['interest_amount']}</td>
                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"                            
                            data-d-group="2">{$val['due_amount']}</td>
                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"                             
                            data-d-group="2">{$loan_balance[$i]}</td>
                            <td>
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
                                    <a href="#" class="btn btn-xs" id="{$val['due_amount']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee"
                                    disabled data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {else}
                                    <a href="#" class="btn btn-warning btn-xs add_expense" id="{$val['due_amount']}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                    data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {/if}
                                                            
                            </td>
                        </tr>

                    {/for}

                    <tr>
                        <td>{$duration_count+1}</td>
                        <td>{date($config['df'], strtotime($val['expire_date']))}</td>

                        <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                            data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$val['amount']-$val['loan_amount']*$duration_count}</td>
                        <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                            data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$val['interest']-$val['interest_amount']*$duration_count}</td>
                        <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                            data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$val['total_due']-$val['due_amount']*($duration_count)}</td>
                        <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                            data-a-sep="{$config['thousands_sep']}" data-d-group="2">0</td>
                        <td>
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
                                <a href="#" class="btn btn-xs" id="{$val['total_due']-$val['due_amount']*$duration_count}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee"
                                disabled data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                {$_L['Add Expense']}
                            </a>
                            {else}
                                <a href="#" class="btn btn-warning btn-xs add_expense" id="{$val['total_due']-$val['due_amount']*$duration_count}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                {$_L['Add Expense']}
                            </a>
                            {/if}

                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" style="font-weight:600; border-bottom-style: hidden">{$_L['Total']}</td>
                        <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"                             
                        data-d-group="2">{$val['amount']}</td>
                        <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"                             
                        data-d-group="2">{$val['interest']}</td>
                        <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"                             
                        data-d-group="2">{$val['total_due']}</td>
                        <td colspan="4" style="border-bottom-style:hidden">&nbsp;</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td style="text-align: left;" colspan="9">
                            <ul class="pagination">
                            </ul>
                        </td>
                    </tr>
                </tfoot>
             </table>
            {$paginator['contents']}
            </div>

            {/if}


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
                        {foreach $transactions as $t} {if $transactions neq ''}
                        <tr>
                            <td>{$t['id']}</td>
                            <td> {date( $config['df'], strtotime($t['date']))}</td>
                            <td>{$t['account']}</td>
                            <td><a href="#">{$t['vehicle_num']}</a></td>
                            <td>{$t['category']}</td>
                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                            data-d-group="2">{$t['amount']}</td>
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
                        {/if} {/foreach}
                        <tr>
                            <td colspan="5" style="border-left-style: hidden; border-bottom-style: hidden; font-weight:600; text-align: right">{$_L['Total']}</td>
                            <td class="amount" autocomplete="off" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}"
                                data-a-sep="{$config['thousands_sep']}" data-d-group="2">{$transactions_total}</td>
                            <td style="border-right-style:hidden; border-bottom-style:hidden">&nbsp;</td>
                        </tr>
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
