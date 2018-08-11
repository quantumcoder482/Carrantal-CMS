{extends file="$layouts_client"}

{block name="content"}
    <div class="row">

        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">


                    <h5>{$user->account}</h5>


                </div>
                <div class="ibox-content">

                    {if $config['add_fund'] eq '1' && $config['add_fund_client'] eq '1'}


                        <h3>Your Current Balance: <span class="amount">{$user->balance}</span></h3>
                        <hr>
                        <a href="javascript:void(0)" class="btn btn-primary add_fund"><i class="fa fa-plus"></i> Add Fund</a>
                        <hr>


                    {/if}

                    <address>
                        {if $user->company neq ''}
                            {$user->company}
                            <br>
                            {$user->account}
                            <br>
                        {else}
                            {$user->account}
                            <br>
                        {/if}
                        {$user->address} <br>
                        {$user->city} <br>
                        {$user->state} - {$user->zip} <br>
                        {$user->country}
                        <br>
                        <strong>{$_L['Phone']}:</strong> {$user->phone}
                        <br>
                        <strong>{$_L['Email']}:</strong> {$user->email}
                        {foreach $cf as $cfs}
                            <br>
                            <strong>{$cfs['fieldname']}: </strong> {get_custom_field_value($cfs['id'],$user->id)}
                        {/foreach}

                    </address>

                    {*<a href="{$_url}client/profile/" class="btn btn-primary"><i class="icon-user-1"></i> Edit Profile</a>*}

                    {if $config['client_drive'] eq '1'}
                        <a href="#" id="app_media"  data-src="{$_url}client-mediabox" class="btn btn-primary"><i class="fa fa-hdd-o"></i> Drive</a>
                    {/if}

                    {$dashboard_summary_extras}



                </div>
            </div>
        </div>

        <div class="col-md-8">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Recent Transactions']}</h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-bordered sys_table">
                            <th>{$_L['Date']}</th>
                            <th>{$_L['Account']}</th>


                            <th class="text-right">{$_L['Amount']}</th>

                            <th>{$_L['Description']}</th>

                            {foreach $t as $ds}
                                <tr class="{if $ds['cr'] eq '0.00'}warning {else}info{/if}">
                                    <td>{date( $config['df'], strtotime($ds['date']))}</td>
                                    <td>{$ds['account']}</td>

                                    <td class="text-right amount">{$ds['amount']}</td>
                                    <td>{$ds['description']}</td>

                                </tr>
                            {/foreach}



                        </table>
                    </div>



                </div>
            </div>

        </div>


    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">


                    <h5>{$_L['Recent Invoices']}</h5>


                </div>
                <div class="ibox-content">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover sys_table">
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

                                <th class="text-right">{$_L['Manage']}</th>
                            </tr>
                            </thead>
                            <tbody>

                            {foreach $d as $ds}
                                <tr>
                                    <td><a target="_blank" href="{$_url}client/iview/{$ds['id']}/token_{$ds['vtoken']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a> </td>
                                    <td>{$ds['account']} </td>
                                    <td class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$config['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['total']}</td>
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

                                    <td class="text-right">
                                        <a target="_blank" href="{$_url}client/iview/{$ds['id']}/token_{$ds['vtoken']}/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> {$_L['View']}</a>
                                        <a href="{$_url}client/ipdf/{$ds['id']}/token_{$ds['vtoken']}/dl/" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i> {$_L['Download']}</a>
                                        <a target="_blank" href="{$_url}iview/print/{$ds['id']}/token_{$ds['vtoken']}/" class="btn btn-primary btn-xs"><i class="fa fa-print"></i> {$_L['Print']}</a>

                                    </td>
                                </tr>
                            {/foreach}

                            </tbody>



                        </table>

                    </div>



                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-12">


            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><h5>{$_L['Recent Quotes']}</h5></h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover sys_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{$_L['Account']}</th>
                                <th width="30%">{$_L['Subject']}</th>
                                <th>{$_L['Amount']}</th>
                                <th>{$_L['Date Created']}</th>
                                <th>{$_L['Expiry Date']}</th>
                                {*<th>{$_L['Stage']}</th>*}

                                <th class="text-right">{$_L['Manage']}</th>
                            </tr>
                            </thead>
                            <tbody>

                            {foreach $q as $ds}
                                <tr>
                                    <td><a href="{$_url}quotes/view/{$ds['id']}/">{$ds['id']}</a> </td>
                                    <td><a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a> </td>
                                    <td><a href="{$_url}quotes/view/{$ds['id']}/">{$ds['subject']}</a> </td>
                                    <td class="amount">{$ds['total']}</td>
                                    <td>{date( $config['df'], strtotime($ds['datecreated']))}</td>
                                    <td>{date( $config['df'], strtotime($ds['validuntil']))}</td>


                                    <td class="text-right">
                                        <a href="{$_url}client/q/{$ds['id']}/token_{$ds['vtoken']}/" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> {$_L['View']}</a>

                                        <a href="{$_url}client/qpdf/{$ds['id']}/token_{$ds['vtoken']}/dl/" class="btn btn-primary btn-xs" ><i class="fa fa-file-pdf-o"></i> {$_L['Download']}</a>
                                        <a href="{$_url}client/qpdf/{$ds['id']}/token_{$ds['vtoken']}/" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-print"></i> {$_L['Print']}</a>
                                    </td>
                                </tr>
                            {/foreach}

                            </tbody>
                        </table>
                    </div>



                </div>
            </div>

        </div>

    </div>

{/block}