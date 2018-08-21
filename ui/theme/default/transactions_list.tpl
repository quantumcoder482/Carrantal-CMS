{extends file="$layouts_admin"}

{block name="content"}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">


                    <div class="row">
                        <div class="col-md-3 col-sm-6">

                            <form>
                                <div class="form-group">
                                    <label for="reportrange">{$_L['Date Range']}</label>
                                    <input type="text" name="reportrange" class="form-control" id="reportrange">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="vehicle_num">{$_L['Vehicle No']}</label>
                                        <select id="vehicle_num" name="vehicle_num" class="form-control">
                                            <option value="" selected>{$_L['All']}</option>
                                            {foreach $vehicles as $vehicle}
                                            <option value="{$vehicle['vehicle_num']}">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                            {/foreach}
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label for="tr_type">{$_L['Transaction Type']}</label>
                                    <select id="tr_type" name="tr_type" class="form-control">
                                        <option value="">{$_L['All']}</option>
                                        <option value="Income" {if $tr_type eq 'Income'}selected{/if}>{$_L['Income']}</option>
                                        <option value="Expense" {if $tr_type eq 'Expense'}selected{/if}>{$_L['Expense']}</option>
                                        <option value="Transfer" {if $tr_type eq 'Transfer'}selected{/if}>{$_L['Transfer']}</option>
                                    </select>
                                </div>
                                
                                <div class="form-group" id="block_expense_type">
                                    <label for="ex_category"> {$_L['Expense Category']}</label>
                                    <select id="ex_category" name="ex_category" class="form-control" style="width:100%">
                                        <option value="">{$_L['All']}</option>
                                        {foreach $expense_categories as $expense_category}
                                            <option value="{$expense_category['name']}">{$expense_category['name']}</option>
                                        {/foreach}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="account">{$_L['Account']}</label>
                                    <select id="account" name="account" class="form-control">
                                        <option value="">{$_L['All']}</option>
                                        {foreach $a as $as}
                                            <option value="{$as['account']}" {if $p_account eq ($as['id'])}selected="selected" {/if}>{$as['account']}</option>
                                        {/foreach}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cid">{$_L['Contact']}</label>
                                    <select id="cid" name="cid" class="form-control">
                                        <option value="">{$_L['All']}</option>
                                        {foreach $c as $cs}
                                            <option value="{$cs['id']}"
                                                    {if $p_cid eq ($cs['id'])}selected="selected" {/if}>{$cs['account']} {if $cs['email'] neq ''}- {$cs['email']}{/if}</option>
                                        {/foreach}

                                    </select>
                                </div>


                                <button type="submit" id="ib_filter" class="btn btn-primary">Filter</button>

                                <br>
                            </form>


                        </div>
                        <div class="col-md-9 col-sm-6 ib_right_panel">


                            <div class="table-responsive" id="ib_data_panel">


                                <table class="table table-bordered table-hover display" id="ib_dt">
                                    <thead>
                                    <tr class="heading">
                                        <th>{$_L['ID']}</th>
                                        <th>{$_L['Date']}</th>
                                        <th>{$_L['Account']}</th>
                                        <th>{$_L['Type']}</th>
                                        <th class="text-right">{$_L['Amount']}</th>
                                        <th>{$_L['Category']}</th>
                                        <th>{$_L['Description']}</th>
                                        <th class="text-right">{$_L['Dr']}</th>
                                        <th class="text-right">{$_L['Cr']}</th>
                                        <th class="text-right">{$_L['Balance']}</th>
                                        <th>{$_L['Manage']}</th>
                                    </tr>
                                    </thead>




                                </table>
                            </div>

                        </div>
                    </div>








                </div>
            </div>

        </div>


    </div> <!-- Row end-->



{/block}


{block name="script"}
    <script>
        $(function () {
            var $block_expense_type = $("#block_expense_type");
            $block_expense_type.hide();

            $("#tr_type").on('change',function () {
                
                $('#ex_category').select2({
                    theme: "bootstrap"
                });

                if($(this).val() == 'Expense'){
                    $block_expense_type.show('slow');
                }
                else{
                    $block_expense_type.hide('slow');
                }
            })
        })
    </script>
{/block}
