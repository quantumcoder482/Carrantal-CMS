<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        {$_L['Edit']} 
    </h3>
</div>

<div class="modal-body">

    <div class="row">
    
        <div class="col-md-8">
            <div class="ibox float-e-margins">

                <div class="ibox-content" id="ib_modal_form">
                    
                    <form class="form-horizontal" id="rform">
    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="vehicle_num">{$_L['Vehicle No']}</label>
    
                            <div class="col-md-9">
                                <input type="text" id="vehicle_num" name="vehicle_num" class="form-control" autocomplete="off" value="{$val['vehicle_num']}">
    
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="vehicle_type">{$_L['Make s Model']}</label>
    
                            <div class="col-md-9">
    
                                <select id="vehicle_type" name="vehicle_type" style="width:374px" class="form-control">
                                    <option value="{$val['vehicle_type']}" selected>{$val['vehicle_type']}</option>
                                    {foreach $v_types as $v_type}
                                    <option value="{$v_type}">{$v_type}</option>
                                    {/foreach}
                                </select>
                                
                                                                   
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="purchase_price">{$_L['Purchase Price']}</label>
    
                            <div class="col-md-9">
                                <input type="text" id="purchase_price" name="purchase_price" class="form-control amount" value="{$val['purchase_price']}">
    
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="parf_cost">{$_L['PARF Cost']}</label>
    
                            <div class="col-md-9">
    
                                <input type="text" id="parf_cost" name="parf_cost" class="form-control amount"  value="{$val['parf_cost']}">
    
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="date" class="col-md-3 control-label">{$_L['Purchase Date']}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datepicker" value="{$val['purchase_date']}" name="pdate" id="pdate" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="text" class="col-md-3 control-label">{$_L['Expiry Date']}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datepicker" value="{$val['expiry_date']}" name="edate" id="edate" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true"> 
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="expiry_status">{$_L['Expiry Status']}</label>
    
                            <div class="col-md-9">
    
                                <select class="form-control" id="expiry_status" style="width:374px" name="expiry_status">
                                    <option value="{$val['expiry_status']}" selected>{$val['expiry_status']}</option>
                                    <option value="7">7</option>
                                    <option value="14">14</option>
                                    <option value="21">21</option>
                                    <option value="28">28</option>
                                </select>
    
                            </div>
                        </div>
    
                        {* if isset($customfield) *}
                            {foreach $fs as $f}
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="cf{$f['id']}">{$f['fieldname']}</label>
                                {if ($f['fieldtype']) eq 'text'}
                            
                            
                                <div class="col-md-9">
                                    <input type="text" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control" value={$cf_value[$f['id']]}> {if ($f['description']) neq ''}
                                    <span class="help-block">{$f['description']}</span>
                                    {/if}
                            
                                </div>
                            
                                {elseif ($f['fieldtype']) eq 'password'}
                            
                                <div class="col-md-9">
                                    <input type="password" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control"> {if ($f['description']) neq ''}
                                    <span class="help-block">{$f['description']}</span>
                                    {/if}
                                </div>
                            
                                {elseif ($f['fieldtype']) eq 'dropdown'}
                                <div class="col-md-9">
                                    <select id="cf{$f['id']}" name="cf{$f['id']}" class="form-control">
                                        {if ($cf_value[$f['id']])}
                                            <option value="{$cf_value[$f['id']]}" selected>{$cf_value[$f['id']]}</option>
                                        {/if}
                                        {foreach explode(',',$f['fieldoptions']) as $fo}
                                            <option value="{$fo}">{$fo}</option>
                                        {/foreach}
                                    </select>
                                    {if ($f['description']) neq ''}
                                    <span class="help-block">{$f['description']}</span>
                                    {/if}
                                </div>
                            
                            
                                {elseif ($f['fieldtype']) eq 'textarea'}
                            
                                <div class="col-md-9">
                                    <textarea id="cf{$f['id']}" name="cf{$f['id']}" class="form-control" rows="3">{$cf_value[$f['id']]}</textarea> {if ($f['description']) neq ''}
                                    <span class="help-block">{$f['description']}</span>
                                    {/if}
                                </div>
                            
                                {elseif ($f['fieldtype']) eq 'date'}
                            
                                <div class="col-md-9">
                                    <input type="text" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control datepicker" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true" value="{$cf_value[$f['id']]}"> {if ($f['description']) neq ''}
                                    <span class="help-block">{$f['description']}</span>
                                    {/if}
                                </div>
                                {else} {/if}
                            </div>
                            {/foreach}
                        {*/if*}
    
                        <input type="hidden" name="vid" id="vid" value="{$val['id']}">
                        <input type="hidden" name="vehicle_file" id="vehicle_file" value="{$val['v_i']}">
                        <input type="hidden" name="cert_file" id="cert_file" value="{$val['v_o_c']}">

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="description">{$_L['Description']}</label>
    
                            <div class="col-md-9">
                                <textarea id="description" name="description" class="form-control" rows="3">{$val['description']}</textarea>
    
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    
    
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    {$_L['Vehicle Image']}
                </div>
                <div class="ibox-content" id="ibox_form">
    
                    <form action="" class="dropzone" id="upload_container1">
    
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

                <div class="ibox-content" id="ibox_form" style="text-align: center">
                    {if $val['v_i'] neq ""}
                    <img src="{$baseUrl}/storage/items/thumb{$val['v_i']}" width="100%"  >
                    {/if}
                </div>
            </div>


            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    {$_L['Vehicle Ownership Certificate']}
                </div>
                <div class="ibox-content" id="ibox_form">
    
                    <form action="" class="dropzone" id="upload_container2">
    
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
               
                <div class="ibox-content" id="ibox_form" style="text-align: center">
                    {if $val['v_o_c'] neq ""}
                    <img src="{$baseUrl}/storage/items/thumb{$val['v_o_c']}" width="100%" >
                    {/if}
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
        $('#description').redactor(
            {
                minHeight: 200 // pixels
            }
        );

        var $vehicle_type = $('#vehicle_type');
            
        $vehicle_type.select2({

            theme: "bootstrap"

        });
        
        $('#expiry_status').select2({
            theme:"bootstrap"
        });
        

        var _url = $("#_url").val();
        var ib_submit = $("#submit");

        var $vehicle_file = $("#vehicle_file");
        var $cert_file = $("#cert_file");

        $('.datepicker').datepicker();

        var upload_resp;

        
        // Vehicle Image upload
        var ib_file1 = new Dropzone("#upload_container1",
            {
                url: _url + "vehicle/upload/",
                maxFiles: 1
            }
        );

        ib_file1.on("sending", function () {

            ib_submit.prop('disabled', true);

        });

        ib_file1.on("success", function (file, response) {

            ib_submit.prop('disabled', false);

            upload_resp = response;

            if (upload_resp.success == 'Yes') {

                toastr.success(upload_resp.msg);
                $vehicle_file.val(upload_resp.file);
            }
            else {
                toastr.error(upload_resp.msg);
            }

        });

        // Cert file upload
        var ib_file2 = new Dropzone("#upload_container2",
            {
                url: _url + "vehicle/upload/",
                maxFiles: 1
            }
        );

        ib_file2.on("sending", function () {

            ib_submit.prop('disabled', true);

        });

        ib_file2.on("success", function (file, response) {

            ib_submit.prop('disabled', false);

            upload_resp = response;

            if (upload_resp.success == 'Yes') {

                toastr.success(upload_resp.msg);
                $cert_file.val(upload_resp.file);

            }
            else {
                toastr.error(upload_resp.msg);
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

        ib_autonumeric();

    });
</script>
{/block}