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
                                <input type="text" id="purchase_price" name="purchase_price" class="form-control amount" autocomplete="off"
                                    data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}"
                                    data-d-group="2" value="{$val['purchase_price']}">
    
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="parf_cost">{$_L['PARF Cost']}</label>
    
                            <div class="col-md-9">
    
                                <input type="text" id="parf_cost" name="parf_cost" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "
                                    data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2" value="{$val['parf_cost']}">
    
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="date" class="col-md-3 control-label">{$_L['Purchase Date']}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{$val['purchase_date']}" name="pdate" id="pdate" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="text" class="col-md-3 control-label">{$_L['Expiry Date']}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{$val['expiry_date']}" name="edate" id="edate" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true"> 
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="expiry_status">{$_L['Expiry Status']}</label>
    
                            <div class="col-md-9">
    
                                <select class="form-control" id="expiry_status" name="expiry_status">
                                    <option value="{$val['expiry_status']}" selected>{$val['expiry_status']}</option>
                                    {for $expiry_status=1 to 20}
                                    <option value="{$expiry_status}">{$expiry_status}</option>
                                    {/for}
                                </select>
    
                            </div>
    
    
                        </div>
    
    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="description">{$_L['Description']}</label>
    
                            <div class="col-md-9">
                                <textarea id="description" name="description" class="form-control" rows="3">{$val['description']}</textarea>
    
                            </div>
                        </div>
    
    
                        {* if isset($customfield) *}
                        <!-- 
                                <div class="form-group"><label class="col-md-3 control-label" for="inventory">{$_L['Inventory To Add Subtract']}</label>
    
                                    <div class="col-md-9"><input type="text" id="inventory" name="inventory" class="form-control" autocomplete="off">
    
                                    </div>
                                </div>
                           
                                <div class="form-group"><label class="col-md-3 control-label" for="inventory">{$_L['Weight']}</label>
    
                                    <div class="col-md-9">
    
                                        <input type="text" id="inventory" name="inventory" class="form-control" autocomplete="off">
    
                                    </div>
                                </div> -->
    
                        {*/if*}
    
                        <input type="hidden" name="vid" id="vid" value="{$val['id']}">
                        <input type="hidden" name="vehicle_file" id="vehicle_file" value="{$val['v_i']}">
                        <input type="hidden" name="cert_file" id="cert_file" value="{$val['v_o_c']}">

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

                <div class="ibox-content" id="ibox_form">
        
                    <img src="{$baseUrl}/storage/items/thumb{$val['v_i']}" width="250px" height="150px" >
        
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
               
                <div class="ibox-content" id="ibox_form">
            
                    <img src="{$baseUrl}/storage/items/thumb{$val['v_o_c']}" width="250px" height="150px">
            
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

        

        var _url = $("#_url").val();
        var ib_submit = $("#submit");

        var $vehicle_file = $("#vehicle_file");
        var $cert_file = $("#cert_file");

        var upload_resp;

        
        // Vehicle Image upload
        var ib_file1 = new Dropzone("#upload_container1",
            {
                url: _url + "ps/upload/",
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
                url: _url + "ps/upload/",
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

    });
</script>