{extends file="$layouts_admin"}

{block name="content"}
    <div class="row">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Add Expense']}</h5>

                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>
                    <form class="form-horizontal" method="post" id="tform" role="form">
                        <div class="form-group">
                            <label for="account" class="col-sm-3 control-label">{$_L['Account']}</label>
                            <div class="col-sm-9">
                                <select id="account" name="account" class="form-control">
                                    <option value="">{$_L['Choose an Account']}</option>
                                    {foreach $d as $ds}
                                        <option value="{$ds['account']}">{$ds['account']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-3 control-label">{$_L['Date']}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  value="{$mdate}" name="date" id="date" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">{$_L['Description']}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description">
                                <div class="help-block"><a data-toggle="modal" href="#modal_add_item"><i class="fa fa-paperclip"></i> {$_L['Attach File']}</a> </div>
                            </div>
                        </div>


                        {*<div class="form-group">*}
                        {*<label for="account" class="col-sm-3 control-label">{$_L['Currency']}</label>*}
                        {*<div class="col-sm-9">*}
                        {*<select id="currency" name="currency" class="form-control">*}

                        {*{foreach $currencies as $currency}*}
                        {*<option value="{$currency['id']}"*}
                        {*{if $config['home_currency'] eq ($currency['cname'])}selected="selected" {/if}>{$currency['cname']}</option>*}
                        {*{foreachelse}*}
                        {*<option value="0">{$config['home_currency']}</option>*}
                        {*{/foreach}*}

                        {*</select>*}
                        {*</div>*}
                        {*</div>*}


                        <div class="form-group">
                            <label for="amount" class="col-sm-3 control-label">{$_L['Amount']}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control amount" id="amount" name="amount">
                            </div>
                        </div>


                        {* This Section is only for custom requirements *}


                        {if $config['edition'] eq 'iqm'}

                            <h4 style="border-bottom: 1px solid #eee; padding-bottom: 8px;">Paid As</h4>



                            <div class="form-group">
                                <label for="c1_amount" class="col-sm-3 control-label">$</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="c1_amount" name="c1_amount">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="c2_amount" class="col-sm-3 control-label">IQD</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="c2_amount" name="c2_amount">
                                </div>
                            </div>

                            <hr>

                        {/if}

                        {* End Custom Requirements Section *}




                        <div class="form-group">
                            <label for="cats" class="col-sm-3 control-label">{$_L['Category']}</label>
                            <div class="col-sm-9">
                                <select id="cats" name="cats" class="form-control">
                                    <option value="Uncategorized">{$_L['Uncategorized']}</option>
                                    {foreach $cats as $cat}
                                        <option value="{$cat['name']}">{$cat['name']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>

                        {if $config['edition'] eq 'iqm'}


                            <div class="form-group">
                                <label for="sub_type" class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-9">
                                    <select id="sub_type" name="sub_type" class="form-control">

                                        {foreach $expense_types as $expense_type}
                                            <option value="{$expense_type->name}">{$expense_type->name}</option>
                                        {/foreach}



                                    </select>
                                </div>
                            </div>

                        {/if}




                        <div class="form-group">
                            <label for="tags" class="col-sm-3 control-label">{$_L['Tags']}</label>
                            <div class="col-sm-9">
                                <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                    {foreach $tags as $tag}
                                        <option value="{$tag['text']}">{$tag['text']}</option>
                                    {/foreach}

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payee" class="col-sm-3 control-label">{$_L['Payee']}</label>
                            <div class="col-sm-9">
                                <select id="payee" name="payee" class="form-control">
                                    <option value="">{$_L['Choose Contact']}</option>
                                    {foreach $p as $ps}
                                        <option value="{$ps['id']}">{$ps['account']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pmethod" class="col-sm-3 control-label">{$_L['Method']}</label>
                            <div class="col-sm-9">
                                <select id="pmethod" name="pmethod" class="form-control">
                                    <option value="">{$_L['Select Payment Method']}</option>
                                    {foreach $pms as $pm}
                                        <option value="{$pm['name']}">{$pm['name']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ref" class="col-sm-3 control-label">{$_L['Ref']}#</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ref" name="ref">
                                <span class="help-block">{$_L['ref_example']}</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="hidden" name="attachments" id="attachments" value="">
                                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Recent Expense']}</h5>

                </div>
                <div class="ibox-content">

                    <table class="table table-bordered sys_table">
                        <thead>
                        <tr>
                            <th>{$_L['Description']}</th>
                            <th>{$_L['Amount']}</th>

                        </tr>
                        </thead>
                        <tbody>

                        {foreach $tr as $trs}
                            <tr>
                                <td><a href="{$_url}transactions/manage/{$trs['id']}">
                                        {if $trs['attachments'] neq ''}
                                            <i class="fa fa-paperclip"></i>
                                        {/if}
                                        {$trs['description']}
                                    </a> </td>
                                <td class="amount">{$trs['amount']}</td>
                            </tr>
                        {/foreach}

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    <input type="hidden" id="_lan_no_results_found" value="{$_L['No results found']}">

    <div id="modal_add_item" class="modal fade-scale" tabindex="-1" data-width="600" style="display: none;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—</button>
            <h4 class="modal-title">{$_L['Attach File']}</h4>
        </div>
        <div class="modal-body">
            <div class="row">



                <div class="col-md-12">
                    <form action="" class="dropzone" id="upload_container">

                        <div class="dz-message">
                            <h3> <i class="fa fa-cloud-upload"></i>  {$_L['Drop File Here']}</h3>
                            <br />
                            <span class="note">{$_L['Click to Upload']}</span>
                        </div>

                    </form>


                </div>




            </div>
        </div>
        <div class="modal-footer">

            <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>

        </div>
    </div>
{/block}


{block name="script"}



    <script>

        jQuery(document).ready(function() {


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


            {if $config['edition'] eq 'iqm'}


            var c2_amount = $("#c2_amount");

            var c1_amount = $("#c1_amount");

            var c_rate = {$currency_rate};


            function total_c() {

                if($amount.val() == ''){
                    var total_amount_c1 = isNaN(parseInt(c1_amount.val())) ? 0 :(c1_amount.val());

                    total_amount_c1 = parseFloat(total_amount_c1);

                    var total_amount_c2 = isNaN(parseInt(c2_amount.val()/ c_rate)) ? 0 :(c2_amount.val()/ c_rate);

                    total_amount_c2 = parseFloat(total_amount_c2);

                    var total_amount_c = total_amount_c1 + total_amount_c2;

                    $amount.val(total_amount_c);
                }
                else{
                    var total_amount_c1 = isNaN(parseInt(c1_amount.val())) ? 0 :(c1_amount.val());


                    total_amount_c1 = parseFloat(total_amount_c1);

                    //  console.log(total_amount_c1);
                    var tr_amount = $amount.val();
                    tr_amount = tr_amount.replace("$ ","");
                    tr_amount = tr_amount.replace(" ","");
                    tr_amount = tr_amount.replace(",","");
                    tr_amount = parseFloat(tr_amount);
                    //  console.log(tr_amount);
                    var rest_amount = tr_amount - total_amount_c1;
                    var rest_amount_in_iqd = rest_amount*c_rate;


                    //  console.log(c_rate);
                    //   console.log(rest_amount);


                    // console.log(rest_amount_in_iqd);
                    c2_amount.val(rest_amount_in_iqd);
                }
            }

            c2_amount.keyup(function(){

                total_c();


            });


            c1_amount.keyup(function(){

                total_c();


            });



            {/if}







        });



    </script>
{/block}
