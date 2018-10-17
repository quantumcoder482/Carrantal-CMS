<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        {$_L['Add Expense']} 
    </h3>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Add Expense']}</h5>

                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>
                    <form class="form-horizontal" method="post" id="eform" role="form">
                        <div class="form-group">
                            <label for="account" class="col-md-3 control-label">{$_L['Account']}</label>
                            <div class="col-md-9">
                                <select class="form-control" style="width:100%" id="account" name="account">
                                    <option value="">{$_L['Choose an Account']}</option>
                                    {foreach $d as $ds}
                                        <option value="{$ds['account']}">{$ds['account']}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="vehicle_num">{$_L['Vehicle No']}</label>

                            <div class="col-md-9">

                                <select class="form-control" style="width:100%;" id="vehicle_num" name="vehicle_num">
                                    <option value="{$val['vehicle_num']}" selected>{$val['vehicle_num']}</option>
                                    {foreach $vehicles as $vehicle}
                                    <option value="{$vehicle['vehicle_num']}">{$vehicle['vehicle_num']} - {$vehicle['vehicle_type']}</option>
                                    {/foreach}
                                </select>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-md-3 control-label">{$_L['Date']}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datepicker"  value="{$mdate}" name="date" id="date" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">{$_L['Description']}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="description" name="description">
                                {*<div class="help-block"><a data-toggle="modal" href="#modal_add_item"><i class="fa fa-paperclip"></i> {$_L['Attach File']}</a> </div>*}
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="amount" class="col-md-3 control-label">{$_L['Amount']}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control amount" id="amount" name="amount" value="{$val['amount']}">
                            </div>
                        </div>


                        {* This Section is only for custom requirements *}


                        {if $config['edition'] eq 'iqm'}

                            <h4 style="border-bottom: 1px solid #eee; padding-bottom: 8px;">Paid As</h4>



                            <div class="form-group">
                                <label for="c1_amount" class="col-md-3 control-label">$</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="c1_amount" name="c1_amount">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="c2_amount" class="col-md-3 control-label">IQD</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="c2_amount" name="c2_amount">
                                </div>
                            </div>

                            <hr>

                        {/if}

                        {* End Custom Requirements Section *}


                        <div class="form-group">
                            <label for="cats" class="col-md-3 control-label">{$_L['Category']}</label>
                            <div class="col-md-9">
                                <select id="cats" name="cats" class="form-control" style="width:100%">
                                    <option value="{$val['category']}">{$val['category']}</option>
                                    {foreach $cats as $cat}
                                        <option value="{$cat['name']}">{$cat['name']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>

                        {if $config['edition'] eq 'iqm'}


                            <div class="form-group">
                                <label for="sub_type" class="col-md-3 control-label">Type</label>
                                <div class="col-md-9">
                                    <select id="sub_type" name="sub_type" class="form-control" style="width:100%">

                                        {foreach $expense_types as $expense_type}
                                            <option value="{$expense_type->name}">{$expense_type->name}</option>
                                        {/foreach}



                                    </select>
                                </div>
                            </div>

                        {/if}




                        <div class="form-group">
                            <label for="tags" class="col-md-3 control-label">{$_L['Tags']}</label>
                            <div class="col-md-9">
                                <select name="tags[]" id="tags" class="form-control" style="width:100%" multiple="multiple">
                                    {foreach $tags as $tag}
                                        <option value="{$tag['text']}">{$tag['text']}</option>
                                    {/foreach}

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payee" class="col-md-3 control-label">{$_L['Payee']}</label>
                            <div class="col-md-9">
                                <select id="payee" name="payee" class="form-control" style="width:100%">
                                    <option value="">{$_L['Choose Contact']}</option>
                                    {foreach $p as $ps}
                                        <option value="{$ps['id']}">{$ps['account']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pmethod" class="col-md-3 control-label">{$_L['Method']}</label>
                            <div class="col-md-9">
                                <select id="pmethod" name="pmethod" class="form-control" style="width:100%">
                                    <option value="">{$_L['Select Payment Method']}</option>
                                    {foreach $pms as $pm}
                                        <option value="{$pm['name']}">{$pm['name']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ref" class="col-md-3 control-label">{$_L['Ref']}#</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="ref" name="ref">
                                <span class="help-block">{$_L['ref_example']}</span>
                            </div>
                        </div>
                        <input type="hidden" name="attachments" id="attachments" value="" />
                        <input type="hidden" name="eid" id="eid" value="{$val['id']}" />
                        <input type="hidden" name="principal_pay" id="principal_pay" value="{$principal_pay}" />
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    {$_L['Expense Reference']}
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
        
                    <!-- <img src="{$baseUrl}/storage/items/thumb   " width="250px"> -->
        
                </div>
        
            </div>
        
        </div>

    </div>

    <input type="hidden" id="_lan_no_results_found" value="{$_L['No results found']}">
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-danger">{$_L['Close']}</button>
    <button type="submit" class="btn btn-primary expense_submit" id="expense_submit">
        <i class="fa fa-check"></i> {$_L['Submit']}</button>

</div>

{block name="script"}

<script>

    $(document).ready(function () {

        $(".progress").hide();
        $("#emsg").hide();

        var $vehicle_num = $('#vehicle_num');

        $vehicle_num.select2({
            theme: "bootstrap"
        });

        $('#account').select2({
            theme:"bootstrap"
        });

        $('#cats').select2({
            theme:"bootstrap"
        });

        $('#payee').select2({
            theme: "bootstrap"
        });

        $('#pmethod').select2({
            theme: "bootstrap"
        });

        var _url = $("#_url").val();

        var ib_submit = $("#submit");

        var $attachments = $("#attachments");

        $('.datepicker').datepicker();

        var upload_resp;


        $('#tags').select2({
            tags: true,
            tokenSeparators: [','],
            theme: "bootstrap",
            language: {
                noResults: function () {
                    return $("#_lan_no_results_found").val();
                }
            }
        });


        // Vehicle Image upload
        var ib_file = new Dropzone("#upload_container",
            {
                url: _url + "transactions/handle_attachment/",
                maxFiles: 1,
                acceptedFiles: "image/*,application/pdf"
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
                $('#attachments').val(function (i, val) {
                    return val + (!val ? '' : ',') + upload_resp.file;
                });
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

        {if $config['edition'] eq 'iqm' }

        var c2_amount = $("#c2_amount");

        var c1_amount = $("#c1_amount");

        var c_rate = { $currency_rate };


        function total_c() {

            if ($amount.val() == '') {
                var total_amount_c1 = isNaN(parseInt(c1_amount.val())) ? 0 : (c1_amount.val());

                total_amount_c1 = parseFloat(total_amount_c1);

                var total_amount_c2 = isNaN(parseInt(c2_amount.val() / c_rate)) ? 0 : (c2_amount.val() / c_rate);

                total_amount_c2 = parseFloat(total_amount_c2);

                var total_amount_c = total_amount_c1 + total_amount_c2;

                $amount.val(total_amount_c);
            }
            else {
                var total_amount_c1 = isNaN(parseInt(c1_amount.val())) ? 0 : (c1_amount.val());


                total_amount_c1 = parseFloat(total_amount_c1);

                //  console.log(total_amount_c1);
                var tr_amount = $amount.val();
                tr_amount = tr_amount.replace("$ ", "");
                tr_amount = tr_amount.replace(" ", "");
                tr_amount = tr_amount.replace(",", "");
                tr_amount = parseFloat(tr_amount);
                //  console.log(tr_amount);
                var rest_amount = tr_amount - total_amount_c1;
                var rest_amount_in_iqd = rest_amount * c_rate;


                //  console.log(c_rate);
                //   console.log(rest_amount);


                // console.log(rest_amount_in_iqd);
                c2_amount.val(rest_amount_in_iqd);
            }
        }

        c2_amount.keyup(function () {

            total_c();

        });


        c1_amount.keyup(function () {

            total_c();

        });

    
        {/if}

    });

</script>
{/block}