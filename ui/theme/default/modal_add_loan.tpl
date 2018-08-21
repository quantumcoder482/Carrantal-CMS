<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        
        {if $f_type eq 'edit'} 
            {$_L['Edit Loan']} 
        {else}
            {$_L['Add Loan']} 
        {/if}
        
    </h3>
</div>

<div class="modal-body">

    <div class="row">
    
        <div class="col-md-8">
            <div class="ibox float-e-margins">

                <div class="ibox-content" id="ib_modal_form">
                    
                    <form class="form-horizontal" id="rform">
    

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="vehicle_type">{$_L['Vehicle No']}<small class="red">*</small></label>
    
                            <div class="col-md-4">
                                
                                <select id="vehicle_num" name="vehicle_num" style="width:307px" class="form-control">
                                    <option value="{$val['vehicle_num']}" selected>{$val['vehicle_num']}</option>
                                    {foreach $vehicles as $vehicle}
                                    <option value="{$vehicle['vehicle_num']}">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                    {/foreach}
                                </select>
                                
                                                                   
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="principal_amount">{$_L['Principal Amount']}<small class="red">*</small></label>

                            <div class="col-md-8">
                                <input type="text" id="principal_amount" name="principal_amount" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="{$val['principal_amount']}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="interest_rate">{$_L['Interest Rate']}(%)<small class="red">*</small></label>
                        
                            <div class="col-md-8">
                                <input type="text" id="interest_rate" name="interest_rate" class="form-control" value="{$val['interest_rate']}">
                        
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="loan_duration">{$_L['Loan Duration']}<small class="red">*</small></label>
                        
                            <div class="col-md-8">
                                <input type="text" id="loan_duration" name="loan_duration" class="form-control" value="{$val['loan_duration']}">
                        
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="repay_cycle_type">{$_L['Repayment Cycle']}<small class="red">*</small></label>
                        
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
                            <label for="date" class="col-md-4 control-label">{$_L['Loan Date']}<small class="red">*</small></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control datepicker" value="{$val['loan_date']}" name="loan_date" id="loan_date" datepicker data-date-format="yyyy-mm-dd"
                                    data-auto-close="true">
                            </div>
                        </div>

    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="expiry_todate">{$_L['Expiry To Date']}<small class="red">*</small></label>
    
                            <div class="col-md-8">
    
                                <select class="form-control" style="width:100%" id="expiry_todate" name="expiry_todate">
                                    <option value="{$val['expiry_todate']}" selected>{$val['expiry_todate']}</option>
                                    <option value="7">7</option>
                                    <option value="14">14</option>
                                    <option value="21">21</option>
                                    <option value="28">28</option>
                                </select>
                                <span class="help-block"> {$_L['vehicle comment']}</span>
                            </div>
    
                            
                        </div>
    
    
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="description">{$_L['Description']}</label>
    
                            <div class="col-md-8">
                                <textarea id="description" name="description" class="form-control" rows="3">{$val['description']}</textarea>
    
                            </div>
                        </div>
    
    
                        <input type="hidden" name="rid" id="rid" value="{$val['id']}">
                        <input type="hidden" name="expire_date" id="rid" value="{$val['expire_date']}">
                        <input type="hidden" name="ref_img" id="ref_img" value="{$val['ref_img']}">

                    </form>
                </div>
            </div>
        </div>
    
    
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    {$_L['Loan Reference']}
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

        $('#repay_cycle_type').select2({
            theme:"bootstrap"
        });

        

        var _url = $("#_url").val();
        var ib_submit = $("#submit");

        var $ref_img= $("#ref_img");

        $('.datepicker').datepicker();

        var upload_resp;

        
        // Vehicle Image upload
        var ib_file = new Dropzone("#upload_container",
            {
                url: _url + "vehicle/upload/",
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