{extends file="$layouts_admin"} 


{block name="content"}
    <div class="row">
    
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        {$_L['Deposit']}
                    </h5>
                    <div class="ibox-tools">
                    
                        <a href="{$_url}cd/deposit_list" class="btn btn-primary btn-xs">{$_L['View Deposit']}</a>
                    
                    </div>
                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>

                    <form class="form-horizontal" id="rform">

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="customer">{$_L['Customer']}<small class="red">*</small></label>
    
                            <div class="col-md-10">
    
                                <select id="customer" name="customer" class="form-control" style="width:100%">
                                    <option value="" selected>{$_L['Choose an customer']}</option>
                                    {foreach $customers as $customer}
                                    <option value="{$customer['id']}">{$customer['account']}</option>
                                    {/foreach}
                                </select>
                                
                                                                   
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="vehicle_num">{$_L['Vehicle No']}<small class="red">*</small></label>
                        
                            <div class="col-md-10">
                        
                                <select id="vehicle_num" name="vehicle_num" class="form-control" style="width:100%">
                                    <option value="" selected>{$_L['Select vehicle number']}</option>
                                    {foreach $vehicles as $vehicle}
                                    <option value="{$vehicle['vehicle_num']}">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                    {/foreach}
                                </select>
                        
                        
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="deposit_amount">{$_L['Deposit Amount']}<small class="red">*</small></label>

                            <div class="col-md-10">
                                <input type="text" id="deposit_amount" name="deposit_amount" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="first_deposit">{$_L['First Deposit']}</label>
                        
                            <div class="col-md-10">
                                <input type="text" id="first_deposit" name="first_deposit" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="">
                        
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="balance">{$_L['Balance']}</label>
                        
                            <div class="col-md-10">
                                <input type="text" id="balance" name="balance" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value=""disabled>
                        
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="duration">{$_L['Duration']}</label>
                        
                            <div class="col-md-10">
                                <input type="text" id="duration" name="duration" class="form-control" value="">
                        
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="repay_cycle_type">{$_L['Repayment Cycle']}<small class="red">*</small></label>

                            <div class="col-md-10">

                                <select class="form-control" style="width:100%" id="repay_cycle_type" name="repay_cycle_type">
                                    <option value="{*$val['repay_cycle_type']*}" selected>{*$val['repay_cycle_type']*}</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>

                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="date" class="col-md-2 control-label">{$_L['Deposit Date']}<small class="red">*</small></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="" name="deposit_date" id="deposit_date" datepicker data-date-format="yyyy-mm-dd"
                                    data-auto-close="true">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="expiry_status">{$_L['Expiry To Date']}<small class="red">*</small></label>
    
                            <div class="col-md-10">
    
                                <select class="form-control" style="width:100%" id="expiry_todate" name="expiry_todate">
                                    <option value="">{$_L['Select expiry to date']}</option>
                                    <option value="7">7</option>
                                    <option value="14">14</option>
                                    <option value="21">21</option>
                                    <option value="28">28</option>
                                </select>
                                <span class="help-block"> {$_L['deposit comment']}</span>
                            </div>
    
                            
                        </div>
    
    
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="description">{$_L['Description']}</label>
    
                            <div class="col-md-10">
                                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
    
                            </div>
                        </div>
    
    
                        <input type="hidden" name="rid" id="rid" value="">
                        <input type="hidden" name="ref_img" id="ref_img" value="">
                        
                        
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">

                                <button class="btn btn-primary" type="submit" id="submit"><i class="fa fa-check"></i>{$_L['Submit']}</button>
                            </div>
                        </div>
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
            
        </div>
    
    </div>

{/block}

{block name="script"}
<script>

    $(document).ready(function () {

        var deposit_amount = $('#deposit_amount');
        var first_deposit = $('#first_deposit');
        var duration=$('#duration');
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

        duration.on('focusout',function(){
            if(duration.val()==0 && deposit_amount.val() != 0){
                var amount = deposit_amount.val();
                amount = Number(amount.replace(/[^0-9.-]+/g, ""));
                first_deposit.val(amount);
                first_deposit.disabled=true;
                balance.val(0);
            }
            if(duration.val() != 0){
                first_deposit.disabled=false;
                first_deposit.val(''); 
                first_deposit.keyup();
            }
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

    });
</script>
{/block}