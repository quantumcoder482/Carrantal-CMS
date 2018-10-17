{extends file="$layouts_admin"}


{block name="content"}
    <div class="row">

        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        {$_L['Add Vehicle']} 
                    </h5>
                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>

                    <form class="form-horizontal" id="rform">

                        <div class="form-group"><label class="col-lg-2 control-label" for="vehicle_num">{$_L['Vehicle No']}</label>

                            <div class="col-lg-10"><input type="text" id="vehicle_num" name="vehicle_num" class="form-control" autocomplete="off">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="vehicle_type_id">{$_L['Make s Model']}</label>
                        
                            <div class="col-lg-10">
                        
                                <select id="vehicle_type_id" name="vehicle_type_id" class="form-control" style="width:100%">
                                    <option value="0">{$_L['Select Make s Model']}</option>
                                    {foreach $vehicle_types as $v}
                                     <option value="{$v['id']}" >{$v_types[$v['id']]}</option>
                                    {/foreach}
                                </select>
                                <span class="help-block"><a href="#" class="add_make_model"><i class="fa fa-plus"></i> {$_L['New Make s Model']}</a>
                                </span>
                        
                            </div>
                        </div>

                        <div class="form-group"><label class="col-lg-2 control-label" for="engine_num">{$_L['Engine No']}</label>

                            <div class="col-lg-10"><input type="text" id="engine_num" name="engine_num" class="form-control"
                                    autocomplete="off" >

                            </div>
                        </div>

                        <div class="form-group"><label class="col-lg-2 control-label" for="chassis_num">{$_L['Chassis No']}</label>

                            <div class="col-lg-10"><input type="text" id="chassis_num" name="chassis_num" class="form-control"
                                    autocomplete="off" >

                            </div>
                        </div>

                        <div class="form-group"><label class="col-lg-2 control-label" for="purchase_price">{$_L['Purchase Price']}</label>

                            <div class="col-lg-10"><input type="text" id="purchase_price" name="purchase_price" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "  data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2">

                            </div>
                        </div>

                        <div class="form-group"><label class="col-lg-2 control-label" for="parf_cost">{$_L['PARF Cost']}</label>

                            <div class="col-lg-10">

                                <input type="text" id="parf_cost" name="parf_cost" class="form-control amount" autocomplete="off" data-a-sign="{$config['currency_code']} "  data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}" data-d-group="2">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-lg-2 control-label">{$_L['Purchase Date']}</label>
                            <div class="col-lg-10"> 
                                <input type="text" class="form-control" value=" " name="pdate" id="pdate" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-lg-2 control-label">{$_L['Expiry Date']}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" value=" " name="edate" id="edate" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="expiry_status">{$_L['Expiry Status']}</label>

                            <div class="col-lg-10">

                                <select class="form-control" style="width:100%" id="expiry_status" name="expiry_status">
                                    <option value=""></option>
                                    <option value="7">7</option>
                                    <option value="14">14</option>
                                    <option value="21">21</option>
                                    <option value="28">28</option>
                                </select>
                           
                                <span class="help-block"> {$_L['vehicle comment']}</span>
                            </div>
                                                         

                        </div>


                        <div class="form-group"><label class="col-lg-2 control-label" for="description">{$_L['Description']}</label>

                            <div class="col-lg-10"><textarea id="description" name="description" class="form-control" rows="3"></textarea>

                            </div>
                        </div>

                   

                    {*run foreach*}
                    
                    {foreach $fs as $f}
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="cf{$f['id']}">{$f['fieldname']}</label>
                            {if ($f['fieldtype']) eq 'text'}
                        
                        
                            <div class="col-lg-10">
                                <input type="text" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control"> {if ($f['description']) neq ''}
                                <span class="help-block">{$f['description']}</span>
                                {/if}
                        
                            </div>
                        
                            {elseif ($f['fieldtype']) eq 'password'}
                        
                            <div class="col-lg-10">
                                <input type="password" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control"> {if ($f['description']) neq ''}
                                <span class="help-block">{$f['description']}</span>
                                {/if}
                            </div>
                        
                            {elseif ($f['fieldtype']) eq 'dropdown'}
                            <div class="col-lg-10">
                                <select id="cf{$f['id']}" name="cf{$f['id']}" class="form-control" style="width:100%">
                                    <option value=""></option>
                                    {foreach explode(',',$f['fieldoptions']) as $fo}
                                    <option value="{$fo}">{$fo}</option>
                                    {/foreach}
                                </select>
                                {if ($f['description']) neq ''}
                                <span class="help-block">{$f['description']}</span>
                                {/if}
                            </div>
                        
                        
                            {elseif ($f['fieldtype']) eq 'textarea'}
                        
                            <div class="col-lg-10">
                                <textarea id="cf{$f['id']}" name="cf{$f['id']}" class="form-control" rows="3"></textarea> {if ($f['description']) neq ''}
                                <span class="help-block">{$f['description']}</span>
                                {/if}
                            </div>
                        
                            {elseif ($f['fieldtype']) eq 'date'}
                        
                            <div class="col-lg-10">
                                <input type="text" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true"> {if ($f['description']) neq ''}
                                <span class="help-block">{$f['description']}</span>
                                {/if}
                            </div>
                            {else} {/if}
                        </div>
                        {/foreach}
      

                        
                        <input type="hidden" name="vehicle_file" id="vehicle_file" value="">
                        <input type="hidden" name="cert_file" id="cert_file" value="">



                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">

                                <button class="btn btn-primary" type="submit" id="submit"><i class="fa fa-check"></i>{$_L['Submit']}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    {$_L['Vehicle Image']}
                </div>
                <div class="ibox-content" id="ibox_form">

                    <form action="" class="dropzone" id="upload_container1">

                        <div class="dz-message">
                            <h3> <i class="fa fa-cloud-upload"></i>  {$_L['Drop File Here']}</h3>
                            <br />
                            <span class="note">{$_L['Click to Upload']}</span>
                        </div>

                    </form>

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
        </div>


    </div>
{/block}