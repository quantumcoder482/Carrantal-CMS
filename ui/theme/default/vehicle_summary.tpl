{extends file="$layouts_admin"}

{block name="content"}

    <div class="row">
        <div class="col-md-12">
            <h4 class="ibilling-page-header">{$_L['Vehicle Summary']} : <a href="#">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</a></h4>
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
                                    <span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$total_expense}</span>
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
                                    <span class="amount"  data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$total_sales}</span>
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
                                <div class="number">
                                    <span class="amount"  data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$net_profits}</span>
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
                                    <span class="amount"  data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$expiry_days}</span>
                                </div>
                                <div class="desc text-right"> {$_L['Expiry Remaining Day']} </div>
                            </div>
                        </a>
                    </div>                      
                </div>
            
                <div class="col-md-12">
                    <div class="col-md-6">
                        <img src="{$baseUrl}/storage/items/{$vehicle['v_i']}" alt="" style="width: 100%;">
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
                                                <td class="title" width="40%"><span>{$_L['Vehicle No']}</span></td>
                                                <td><span>{$vehicle['vehicle_num']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title"><span>{$_L['Make s Model']}</span></td>
                                                <td><span>{$vehicle['vehicle_type']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title"><span>{$_L['Purchase Price']}</span></td>
                                                <td><span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$vehicle['purchase_price']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title"><span>{$_L['PARF Value']}</span></td>
                                                <td><span class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$vehicle['parf_cost']}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title"><span>{$_L['Purchase Date']}</span></td>
                                                <td> <span>{date($config['df'], strtotime($vehicle['purchase_date']))}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title"><span>{$_L['Scrap Date']}</span></td>
                                                <td><span>{date($config['df'], strtotime($vehicle['expiry_date']))}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="title"><span>{$_L['Remaining Days']}</span></td>
                                                <td><span>{$expiry_days}</span></td>
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
                                    <h4 style="margin-left:15px;">{$_L['Total Vehicle Depreciation']}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td colspan="2" width="40%"></td>
                                                <td class="title" width="20%">{$_L['Monthly']}</td>
                                                <td class="title" width="20%">{$_L['Weekly']}</td>
                                                <td class="title" width="20%">{$_L['Daily']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title" width="20%">{$_L['Vehicle']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Insurance']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Road Tax']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Loan p Interest']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Miscellanous']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Insurance']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Vehicle']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Road Tax']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Loan p Interest']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Miscellanous']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Road Tax']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Vehicle']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Insurance']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Loan p Interest']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Miscellanous']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Loan p Interest']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Vehicle']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Insurance']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Road Tax']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Miscellanous']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Miscellanous']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Vehicle']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Insurance']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Road Tax']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$_L['Loan p Interest']}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="title" width="20%">{$_L['Total']}</td>
                                                <td class="amount" style="font-weight:600" width="20%">a</td>
                                                <td class="amount" style="font-weight:600" width="20%">b</td>
                                                <td class="amount" style="font-weight:600" width="20%">c</td>
                                                <td class="amount" style="font-weight:600" width="20%">e</td>
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
                                    <h4 style="margin-left:15px;">{$_L['Payment Due']}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="20%"></td>
                                                <td class="title" width="25%">{$_L['Due Date']}</td>
                                                <td class="title" width="25%">{$_L['Amount']}</td>
                                                <td class="title" width="15%">{$_L['Status']}</td>
                                                <td class="title" width="15%">{$_L['Manage']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Road Tax']}</td>
                                                <td>{date($config['df'], strtotime($vehicle['due_date']))}</td>
                                                <td class="amount">{$roadtax[0]['amount']}</td>
                                                <td style="text-align:center;"  >
                                                     {if $pay_status_string['roadtax'] eq 'Paid'}
                                                    <div class="label-success" style="margin:0 auto;width:70px">
                                                        {$pay_status_string['roadtax']}</div>
                                                    {elseif $pay_status_string['roadtax'] eq 'unPaid'}
                                                    <div class="label-danger" style="color:#ff2222;margin:0 auto;width:70px">
                                                        {$pay_status_string['roadtax']}</div>
                                                    {else}
                                                    <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;width:70px;">
                                                        {$pay_status_string['roadtax']}</div>
                                                    {/if}
                                                </td>
                                                <td style="text-align:center;">
                                                     {if $pay_status_string['roadtax'] eq "Paid"}
                                                    <a href="#" class="btn btn-xs renew" id="roadtax" style="background-color:#4B0082; border-color:#4B0082; color:#eeeeee; font-weight: 800" data-toggle="tooltip"
                                                        data-placement="top" title="{$_L['Renew']}">
                                                        {$_L['Renew']}
                                                    </a>
                                                    {else}
                                                    <a href="#" class="btn btn-warning btn-xs add_expense" id="roadtax" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee; font-weight: 800"
                                                        data-toggle="tooltip" data-placement="top" title="{$_L['Add Expense']}">
                                                        &nbsp;+ $&nbsp;
                                                    </a>
                                                    {/if}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="20%"></td>
                                                <td class="title" width="25%">{$_L['Due Date']}</td>
                                                <td class="title" width="25%">{$_L['Amount']}</td>
                                                <td class="title" width="15%">{$_L['Status']}</td>
                                                <td class="title" width="15%">{$_L['Manage']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Insurance']}</td>
                                                <td>{date($config['df'], strtotime($insurance[0]['due_date']))}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$insurance[0]['amount']}</td>
                                                <td style="text-align:center;">
                                                     {if $pay_status_string['insurance'] eq 'Paid'}
                                                    <div class="label-success" style="margin:0 auto;width:70px">
                                                        {$pay_status_string['insurance']}</div>
                                                    {elseif $pay_status_string['insurance'] eq 'unPaid'}
                                                    <div class="label-danger" style="color:#ff2222;margin:0 auto;width:70px">
                                                        {$pay_status_string['insurance']}</div>
                                                    {else}
                                                    <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;width:70px;">
                                                        {$pay_status_string['insurance']}</div>
                                                    {/if}
                                                </td>
                                                <td style="text-align:center;">
                                                     {if $pay_status_string['insurance'] eq "Paid"}
                                                    <a href="#" class="btn btn-xs renew" id="insurance" style="background-color:#4B0082; border-color:#4B0082; color:#eeeeee; font-weight: 800" data-toggle="tooltip"
                                                        data-placement="top" title="{$_L['Renew']}">
                                                        {$_L['Renew']}
                                                    </a>
                                                    {else}
                                                    <a href="#" class="btn btn-warning btn-xs add_expense" id="insurance" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee; font-weight: 800"
                                                        data-toggle="tooltip" data-placement="top" title="{$_L['Add Expense']}">
                                                         &nbsp;+ $&nbsp;
                                                    </a>
                                                    {/if}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="summary-box">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="20%"></td>
                                                <td class="title" width="25%">{$_L['Due Date']}</td>
                                                <td class="title" width="25%">{$_L['Amount']}</td>
                                                <td class="title" width="15%">{$_L['Status']}</td>
                                                <td class="title" width="15%">{$_L['Manage']}</td>
                                            </tr>
                                            <tr>
                                                <td class="title">{$_L['Loan Repay']}</td>
                                                <td class="date">{date($config['df'], strtotime($roadtax[0]['due_date']))}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">{$roadtax[0]['amount']}</td>
                                                <td style="text-align:center;">
                                                     {if $pay_status_string['loan'] eq 'Paid'}
                                                    <div class="label-success" style="margin:0 auto;width:70px">
                                                        {$pay_status_string['loan']}</div>
                                                    {elseif $pay_status_string['loan'] eq 'unPaid'}
                                                    <div class="label-danger" style="color:#ff2222;margin:0 auto;width:70px">
                                                        {$pay_status_string['loan']}</div>
                                                    {else}
                                                    <div class="label-warning" style="border-color:#ffa500;color: #f7931e;margin:0 auto;width:70px;">
                                                        {$pay_status_string['loan']}</div>
                                                    {/if}
                                                </td>
                                                <td style="text-align:center;">
                                                    {if $pay_status_string['loan'] eq "Paid"}
                                                    <a href="#" class="btn btn-xs renew" id="loan" style="background-color:#4B0082; border-color:#4B0082; color:#eeeeee;font-weight: 800"
                                                        data-toggle="tooltip" data-placement="top" title="{$_L['Renew']}">
                                                        {$_L['Renew']}
                                                    </a>
                                                    {else}
                                                    <a href="#" class="btn btn-warning btn-xs add_expense" id="loan" style="background-color:#FFA500; border-color:#FFA500; color:#eeeeee;font-weight: 800"
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

                <div class="col-md-12">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="div-title">
                                        <h4>{$_L['Recent Vehicle Sales']}</h4>
                                        <a href="#" class="btn btn-primary btn-sm">{$_L['View Vehicle Income']}</a>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="summary-box">
                                        <table class="table table-bordered" style="text-align:center">
                                            <tr>
                                                <td>#</td>
                                                <td class="title">{$_L['Date']}</td>
                                                <td class="title">{$_L['Customer']}</td>
                                                <td class="title">{$_L['Amount']}</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">4</td>
                                            </tr>
                                            <tr height="20px"><td colspan="4"></td></tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="title">{$_L['Total']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">9999</td>
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
                                        <a href="#" class="btn btn-primary btn-sm">{$_L['View Vehicle Expense']}</a>
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
                                            <tr>
                                                <td>1</td>
                                                <td class="date">2</td>
                                                <td>3</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">4</td>
                                            </tr>
                                            <tr height="20px">
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="title">{$_L['Total']}</td>
                                                <td class="amount" data-a-sign="{if $vehicle['currency_symbol'] eq ''} {$config['currency_code']} {else} {$vehicle['currency_symbol']}{/if}">9999</td>
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