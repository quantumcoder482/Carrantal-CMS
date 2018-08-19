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
               <h5>{$_L['Vehicle No']}:  {$val['vehicle_num']}</h5>
            </div>

            <div class="ibox-content">
                <table class="table table-bordered table-hover sys_table footable">
                    <thead>
                        <tr>
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
                            <td>{$val['date']}</td>
                            <td>{$val['expire_date']}</td>
                            <td>{$val['duration']}</td>
                            <td>{$val['repayment']}</td>
                            <td>{$val['amount']}</td>
                            <td>{$val['rate']}</td>
                            <td>{$val['interest']}</td>
                            <td>{$val['total_due']}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered table-hover sys_table footable">
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

                     {for $i=1 to $val['duration']}
                        <tr>
                            <td>{$i}</td>
                            <td>{$next_duedate[$i]}</td>
                            <td>{$val['loan_amount']}</td>
                            <td>{$val['interest_amount']}</td>
                            <td>{$val['due_amount']}</td>
                            <td>{$loan_balance[$i]}</td>
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
                                <a href="#" class="btn btn-xs" id="{$val['id']}" style="background-color:#A9A9A9; border-color:#A9A9A9; color:#eeeeee" disabled
                                    data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {else}
                                <a href="#" class="btn btn-warning btn-xs add_expense" id="{$val['id']}" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee"
                                    data-toggle="tooltip" data-placement="top" title="{$_L['View']}">
                                    {$_L['Add Expense']}
                                </a>
                                {/if}
                                                            
                            </td>
                        </tr>

                    {/for}

                        <tr>
                            <td colspan="2">{$_L['Total']}</td>
                            <td>{$val['amount']}</td>
                            <td>{$val['interest']}</td>
                            <td>{$val['total_due']}</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>


                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
{/block}
