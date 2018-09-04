<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        {$_L['Edit Contract']} 
    </h3>
</div>

<div class="modal-body">

    <div class="row">
    
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content" id="modal_form">
                          
                    <form class="form-horizontal" id="mform">
        
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="contact">{$_L['Contract']}</label>
        
                            <div class="col-lg-10">
        
                                <select id="contact" name="contact" class="form-control" style="width:100%">
                                    {foreach $customers as $customer}
                                    {if $customer['id'] eq $customer_id}
                                        <option value="{$customer['id']}" selected>{$customer['account']}</option>
                                    {else}
                                    <option value="{$customer['id']}">{$customer['account']}</option>
                                    {/if}
                                    {/foreach}
                                </select>
        
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="vehicle">{$_L['Vehicle']}</label>
        
                            <div class="col-lg-10">
        
                                <select id="vehicle" name="vehicle" class="form-control" style="width:100%">
                                    {foreach $vehicles as $vehicle}
                                    {if $vehicle['id'] eq $vehicle_id}
                                    <option value="{$vehicle['id']}" selected>{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                    {else}
                                    <option value="{$vehicle['id']}">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                    {/if}
                                    {/foreach}
                                </select>
        
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="invoice">{$_L['Invoice']}</label>
        
                            <div class="col-lg-10">
        
                                <select id="invoice" name="invoice" class="form-control" style="width:100%">
                                    {foreach $invoices as $invoice}
                                    {if $invoice['id'] eq $invoice_id}
                                    <option value="{$invoice['id']}" selected>{$invoice['invoicenum']}</option>
                                    {else}
                                    <option value="{$invoice['id']}">{$invoice['invoicenum']}</option>
                                    {/if}
                                    {/foreach}
                                </select>
        
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="deposit">{$_L['Deposit']}</label>
        
                            <div class="col-lg-10">
        
                                <select id="deposit" name="deposit" class="form-control" style="width:100%">
                                    {foreach $deposits as $deposit}
                                    {if $deposit['id'] eq $deposit_id}
                                    <option value="{$deposit['id']}" selected>
                                        <span class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                                            data-d-group="2">{$deposit['first_deposit']}</span> /
                                        <span class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                                            data-d-group="2">{$deposit['deposit_amount']}</span>
                                    </option>
                                    {else}
                                    <option value="{$deposit['id']}">
                                        <span class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                                            data-d-group="2">{$deposit['first_deposit']}</span> /
                                        <span class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                                            data-d-group="2">{$deposit['deposit_amount']}</span>
                                    </option>
                                    {/if}
                                    {/foreach}
                                </select>
        
                            </div>
                        </div>
        
                        <input type="hidden" name="id" id="id" value="{$id}">
                        <input type="hidden" name="contract_id" id="contract_id" value="{$contract_id}">

                    </form>
                </div>
            </div>
        
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-danger">{$_L['Close']}</button>
    <button type="submit" class="btn btn-primary modal_submit" id="modal_submit">
        <i class="fa fa-check"></i> {$_L['Update']}</button>
</div>

{block name="script"}
<script>

    $(document).ready(function () {

        $(".progress").hide();
        $("#emsg").hide();
       
        $('#contract').select2({
            theme: "bootstrap"
        });

        $('#vehicle').select2({
            theme: "bootstrap"
        });

        $('#deposit').select2({
            theme: "bootstrap"
        });

        $('#invoice').select2({
            theme: "bootstrap"
        });
        
        
        function ib_autonumeric() {
            $('.amount').autoNumeric('init', {

                aSign: '{$config['currency_code']} ',
                dGroup: {$config['thousand_separator_placement']},
                aPad: {$config['currency_decimal_digits']},
                pSign: '{$config['currency_symbol_position']}',
                aDec: '{$config['dec_point']}',
                aSep: '{$config['thousands_sep']}',
                vMax: '9999999999999999.00',
                vMin: '-9999999999999999.00'

            });

        }

        ib_autonumeric();

    });
</script>
{/block}