<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        {if $f_type eq 'edit'} 
            {$_L['Edit Make s Modal']} 
        {else} 
            {$_L['Add Make s Modal']} 
        {/if}
    </h3>
</div>

<div class="modal-body">

    <form class="form-horizontal" id="ib_modal_form">


        <div class="row">
            <div class="col-md-12">

                <div class="form-group">
                    <label class="col-md-12" for="make">{$_L['Make']}</label>

                    <div class="col-md-12">
                        <input type="text" id="make" name="make" class="form-control" value="{$val['make']}">
                    </div>


                </div>

                <div class="form-group">
                    <label class="col-md-12" for="model">{$_L['Model']}</label>

                    <div class="col-md-12">
                        <input type="text" id="model" name="model" class="form-control" value="{$val['model']}">

                    </div>


                </div>



                <div class="form-group">
                    <label class="col-md-12" for="engine_capacity">{$_L['Engine Capacity']}</label>

                    <div class="col-md-12">
                        <input type="text" id="engine_capacity" name="engine_capacity" class="form-control" value="{$val['engine_capacity']}">

                    </div>


                </div>


                <div class="form-group">
                    <label class="col-md-12" for="transmission">{$_L['Transmission']}</label>

                    <div class="col-md-12">
                        <select name="transmission" id="transmission" style="width:100%" class="form-control country">
                            <option value="A">{$_L['Auto A']}</option>
                            <option value="M">{$_L['Manual M']}</option>
                        </select>
                    </div>


                </div>


                <div class="form-group">
                    <label class="col-md-12" for="fuel_type">{$_L['Fuel Type']}</label>
                
                    <div class="col-md-12">
                        <select name="fuel_type" id="fuel_type" style="width:100%" class="form-control country">
                            <option value="{$_L['Petrol']}">{$_L['Petrol']}</option>
                            <option value="{$_L['Diesel']}">{$_L['Diesel']}</option>
                            <option value="{$_L['Petrol Electric']}">{$_L['Petrol Electric']}</option>
                            <option value="{$_L['Diesel Electric']}">{$_L['Diesel Electric']}</option>
                            <option value="{$_L['Electric']}">{$_L['Electric']}</option>
                        </select>
                    </div>
                
                
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="color">{$_L['Color']}</label>

                    <div class="col-md-12">
                        <input type="text" id="color" name="color" class="form-control" value="{$val['color']}">

                    </div>


                </div>

            </div>
        </div>



        <input type="hidden" name="f_type" id="f_type" value="{$f_type}">
        <input type="hidden" name="v_t_id" id="v_t_id" value="{$val['v_t_id']}">
    </form>

</div>
<div class="modal-footer">
    
    <button type="button" data-dismiss="modal" class="btn btn-danger">
         {if $f_type eq 'edit'} {$_L['Close']} {else} {$_L['Cancel']} {/if}
    </button>
    <button class="btn btn-primary modal_submit" type="submit" id="modal_submit">
        <i class="fa fa-check"></i>
     {if $f_type eq 'edit'} {$_L['Update']} {else} {$_L['Save']} {/if}
    </button>

</div>

 {block name="script"}
<script>

    $(document).ready(function () {

        $('#transmission').select2({
            theme: "bootstrap"
        });

        $('#fuel_type').select2({
            theme: "bootstrap"
        });

    });

</script>
 {/block}