<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        {$_L['Edit Deposit']} 
    </h3>
</div>

<div class="modal-body">

    <div class="row">
    
        <div class="col-md-8">
            <div class="ibox float-e-margins">

                <div class="ibox-content" id="ib_modal_form">
                    
                    <form class="form-horizontal" id="rform">
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="customer">{$_L['Customer']}</label>
                    
                            <div class="col-md-8">
                    
                                <select id="customer" name="customer" class="form-control" style="width:100%">
                                    {if $val['customer'] neq " "}
                                        <option value="{$val['customerid']}" selected>{$val['customer']}</option>
                                    {else}
                                        <option value="" selected>{$_L['Choose an customer']}</option>
                                    {/if}
                                    {foreach $customers as $customer}
                                        <option value="{$customer['id']}">{$customer['account']}</option>
                                    {/foreach}
                                </select>
                    
                    
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="vehicle_num">{$_L['Vehicle No']}</label>
                    
                            <div class="col-md-8">
                    
                                <select id="vehicle_num" name="vehicle_num" class="form-control" style="width:100%">
                                    {if $val['vehicle_num'] neq " "}
                                        <option value="{$val['vehicle_num']}" selected>{$val['vehicle_num']}</option>
                                    {else}
                                        <option value="" selected>{$_L['Select vehicle number']}</option>
                                    {/if}
                                    {foreach $vehicles as $vehicle}
                                    <option value="{$vehicle['vehicle_num']}">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                    {/foreach}
                                </select>
                    
                    
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="deposit_amount">{$_L['Deposit Amount']}</label>
                    
                            <div class="col-md-8">
                                <input type="text" id="deposit_amount" name="deposit_amount" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="{$val['deposit_amount']}">
                    
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="first_deposit">{$_L['First Deposit']}</label>
                    
                            <div class="col-md-8">
                                <input type="text" id="first_deposit" name="first_deposit" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="{$val['first_deposit']}">
                    
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="balance">{$_L['Balance']}</label>
                    
                            <div class="col-md-8">
                                <input type="text" id="balance" name="balance" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="{$val['balance']}" disabled>
                    
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="duration">{$_L['Duration']}</label>
                    
                            <div class="col-md-8">
                                <input type="text" id="duration" name="duration" class="form-control" value="{$val['duration']}">
                    
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="repay_cycle_type">{$_L['Repayment Cycle']}</label>
                    
                            <div class="col-md-8">
                    
                                <select class="form-control" style="width:100%" id="repay_cycle_type" name="repay_cycle_type">
                                    <option value="{$val['repay_cycle_type']}" selected>{$val['repay_cycle_type']}</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                    
                                </select>
                            </div>
                    
                        </div>
                    
                        <div class="form-group">
                            <label for="date" class="col-md-4 control-label">{$_L['Deposit Date']}</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control datepicker" value="{$val['deposit_date']}" name="deposit_date" id="deposit_date" datepicker data-date-format="yyyy-mm-dd"
                                    data-auto-close="true">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="expiry_status">{$_L['Expiry To Date']}</label>
                    
                            <div class="col-md-8">
                    
                                <select class="form-control" style="width:100%" id="expiry_todate" name="expiry_todate">
                                    <option value="{$val['expiry_todate']}" selected>{$val['expiry_todate']}</option>
                                    <option value="7">7</option>
                                    <option value="14">14</option>
                                    <option value="21">21</option>
                                    <option value="28">28</option>
                                </select>
                                <span class="help-block"> {$_L['deposit comment']}</span>
                            </div>
                    
                    
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="description">{$_L['Description']}</label>
                    
                            <div class="col-md-8">
                                <textarea id="description" name="description" class="form-control" rows="3">{$val['description']}</textarea>
                    
                            </div>
                        </div>
                    
                        <input type="hidden" name="rid" id="rid" value="{$val['id']}">
                        <input type="hidden" name="ref_img" id="ref_img" value="{$val['ref_img']}">
                    
                    </form>
                </div>
            </div>
        </div>
    
    
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    {$_L['Deposit Reference']}
                </div>
                <div class="ibox-content" id="ibox_form">
    
                    <form action="" class="dropzone" id="upload_container">
    
                        <div class="dz-message">
                            <h3>
                                <i class="fa fa-cloud-upload"></i> {$_L['Drop File Here']}</h3>
                            <br />
                            <span class="note">{$_L['Click to Upload']}</span>
                        </div>
    
                    </form>
    
                </div>
            </div>
    
            <div class="ibox float-e-margins">

                <div class="ibox-content" id="ibox_form" style="text-align: center;">
                    {if $val['ref_img'] eq NULL || $val['ref_img'] eq " "}
                    <p>&nbsp;</p>
                    {else}
                    <img src="{$baseUrl}/storage/items/thumb{$val['ref_img']}" width="100%"> {/if}
                </div>

            </div>

        </div>
    
    </div>
</div>


<div class="modal-footer">
     {if $f_type eq 'edit'}  
        <button type="button" data-dismiss="modal" class="btn btn-danger">{$_L['Close']}</button>
        <button type="submit" class="btn btn-primary modal_submit" id="modal_submit">
            <i class="fa fa-check"></i> {$_L['Update']}</button>
     
     {else}
        <button type="button" data-dismiss="modal" class="btn btn-danger">{$_L['Close']}</button>
        <button type="submit" class="btn btn-primary modal_submit" id="modal_submit">
            <i class="fa fa-check"></i> {$_L['Submit']}</button>
     {/if}
</div>

{block name="script"}
<script>

    $(document).ready(function () {

        $(".progress").hide();
        $("#emsg").hide();
        $('#description').redactor(
            {
                minHeight: 200 // pixels
            }
        );

        var $vehicle_num = $('#vehicle_num');
            
        $vehicle_num.select2({
            theme: "bootstrap"
        });

        $('#expiry_todate').select2({
            theme:"bootstrap"
        });

        $('#customer').select2({
            theme:"bootstrap"
        });
        

        var _url = $("#_url").val();
        var ib_submit = $("#submit");
        var $ref_img= $("#ref_img");

        $('.datepicker').datepicker();

        // Auto calculation amounts

        var deposit_amount = $('#deposit_amount');
        var first_deposit = $('#first_deposit');
        var balance = $('#balance');

        deposit_amount.on("keyup", function () {

            var amount = deposit_amount.val();
            var rebate = first_deposit.val();
            amount = Number(amount.replace(/[^0-9.-]+/g, ""));
            rebate = Number(rebate.replace(/[^0-9.-]+/g, ""));
            balance.val("{$config['currency_code']} " + (amount - rebate));

        });
        first_deposit.on("keyup", function () {

            var amount = deposit_amount.val();
            var rebate = first_deposit.val();
            amount = Number(amount.replace(/[^0-9.-]+/g, ""));
            rebate = Number(rebate.replace(/[^0-9.-]+/g, ""));
            balance.val("{$config['currency_code']} " + (amount - rebate));

        });


        var upload_resp;
        
        // Vehicle Image upload
        var ib_file = new Dropzone("#upload_container",
            {
                url: _url + "cd/upload/",
                maxFiles: 1
            }
        );

        ib_file.on("sending", function () {

            ib_submit.prop('disabled', true);

        });

        ib_file.on("success", function (file, response) {

            ib_submit.prop('disabled', false);

            upload_resp = response;

            if (upload_resp.success == 'Yes') {

                toastr.success(upload_resp.msg);
                $ref_img.val(upload_resp.file);
            }
            else {
                toastr.error(upload_resp.msg);
            }

        });

        
        var $amount = $("#amount");


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