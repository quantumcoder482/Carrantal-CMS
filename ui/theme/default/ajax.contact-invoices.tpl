<a href="{$_url}invoices/add/1/{$cid}/" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> {$_L['New Invoice']}</a>
<a href="{$_url}invoices/add/recurring/{$cid}/" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> {$_L['New Recurring Invoice']}</a>

<hr>

<h4> {$_L['Total Invoice Amount']}: <span class="amount" data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-a-pad="{$config['currency_decimal_digits']}" data-p-sign="{$config['currency_symbol_position']}" data-a-sign="{$config['currency_code']} " data-d-group="{$config['thousand_separator_placement']}">{$total_invoice_amount}</span></h4>
<h4> {$_L['Total Paid Amount']}: <span class="amount" data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-a-pad="{$config['currency_decimal_digits']}" data-p-sign="{$config['currency_symbol_position']}" data-a-sign="{$config['currency_code']} " data-d-group="{$config['thousand_separator_placement']}">{$total_paid_amount}</span></h4>
<h4> {$_L['Total Un Paid Amount']}: <span class="amount" data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-a-pad="{$config['currency_decimal_digits']}" data-p-sign="{$config['currency_symbol_position']}" data-a-sign="{$config['currency_code']} " data-d-group="{$config['thousand_separator_placement']}">{$total_unpaid_amount}</span></h4>

<hr>

<table class="table table-bordered table-hover sys_table">
    <thead>
    <tr>
        <th>#</th>
        <th>{$_L['Account']}</th>
        <th>{$_L['Amount']}</th>
        <th>{$_L['Invoice Date']}</th>
        <th>{$_L['Due Date']}</th>
        <th>{$_L['Status']}</th>
        <th class="text-right">{$_L['Manage']}</th>
    </tr>
    </thead>
    <tbody>

    {foreach $i as $is}
        <tr>
            <td>{$is['invoicenum']}{if $is['cn'] neq ''} {$is['cn']} {else} {$is['id']} {/if}</td>
            <td>{$is['account']}</td>
            <td class="amount" data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-a-pad="{$config['currency_decimal_digits']}" data-p-sign="{$config['currency_symbol_position']}" data-a-sign="{$config['currency_code']} " data-d-group="{$config['thousand_separator_placement']}">{$is['total']}</td>
            <td>{date( $config['df'], strtotime($is['date']))}</td>
            <td>{date( $config['df'], strtotime($is['duedate']))}</td>
            <td>{ib_lan_get_line($is['status'])}</td>
            <td>
                <a href="{$_url}invoices/view/{$is['id']}/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> {$_L['View']}</a>
                <a href="{$_url}invoices/edit/{$is['id']}/" class="btn btn-info btn-xs"><i class="fa fa-repeat"></i> {$_L['Edit']}</a>
            </td>
        </tr>
    {/foreach}

    </tbody>
</table>