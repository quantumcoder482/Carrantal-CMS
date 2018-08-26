{extends file="$layouts_admin"} 


{block name="content"}
    <div class="row">
    
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        {$_L['Add Road Tax']}
                    </h5>
                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>

                    <form class="form-horizontal" id="rform">

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="vehicle_type">{$_L['Vehicle No']}<small class="red">*</small></label>
    
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
                            <label class="col-md-2 control-label" for="rebate_amount">{$_L['Road Tax Amount']}<small class="red">*</small></label>

                            <div class="col-md-10">
                                <input type="text" id="roadtax_amount" name="roadtax_amount" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="rebate_amount">{$_L['Rebate Amount']}</label>
                        
                            <div class="col-md-10">
                                <input type="text" id="rebate_amount" name="rebate_amount" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="">
                        
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="roadtax_total">{$_L['Road Tax Total']}</label>
                        
                            <div class="col-md-10">
                                <input type="text" id="roadtax_total" name="roadtax_total" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="" disabled>
                        
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-md-2 control-label">{$_L['Road Tax Date']}<small class="red">*</small></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="" name="roadtax_date" id="roadtax_date" datepicker data-date-format="yyyy-mm-dd"
                                    data-auto-close="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-md-2 control-label">{$_L['Due Date']}<small class="red">*</small></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="" name="due_date" id="due_date" datepicker data-date-format="yyyy-mm-dd"
                                    data-auto-close="true">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="expiry_todate">{$_L['Expiry To Date']}<small class="red">*</small></label>
    
                            <div class="col-md-10">
    
                                <select class="form-control" style="width:100%" id="expiry_todate" name="expiry_todate">
                                    <option value="">{$_L['Select expiry to date']}</option>
                                    <option value="7">7</option>
                                    <option value="14">14</option>
                                    <option value="21">21</option>
                                    <option value="28">28</option>
                                </select>
                                <span class="help-block"> {$_L['vehicle comment']}</span>
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
                    {$_L['Road Tax Reference']}
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
        
        var roadtax_amount = $('#roadtax_amount');
        var rebate_amount = $('#rebate_amount');
        var roadtax_total = $('#roadtax_total');

        roadtax_amount.on("keyup", function () {

            var amount = roadtax_amount.val();
            var rebate = rebate_amount.val();
            amount = Number(amount.replace(/[^0-9.-]+/g, ""));
            rebate = Number(rebate.replace(/[^0-9.-]+/g, ""));
            roadtax_total.val("{$config['currency_code']} " + (amount - rebate));
          
        });
        rebate_amount.on("keyup", function () {

            var amount = roadtax_amount.val();
            var rebate = rebate_amount.val();
            amount = Number(amount.replace(/[^0-9.-]+/g, ""));
            rebate = Number(rebate.replace(/[^0-9.-]+/g, ""));
            roadtax_total.val("{$config['currency_code']} "+(amount - rebate));
            
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