{extends file="$layouts_admin"}

{block name="content"}
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Currency Exchange']}</h5>

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
                                        <option value="{$ds['id']}">{$ds['account']}</option>
                                    {/foreach}


                                </select>
                                <span class="help-block" id="balance_helper"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-3 control-label">{$_L['Date']}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  value="{$mdate}" name="date" id="date" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="account" class="col-sm-3 control-label">{$_L['From']}</label>
                            <div class="col-sm-9">
                                <select id="currency_from" name="currency_from" class="form-control">
                                    <option value="">{$_L['Select Currency']}</option>
                                    {foreach $currencies as $currency}
                                        <option value="{$currency['iso_code']}">{$currency['iso_code']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="account" class="col-sm-3 control-label">{$_L['To']}</label>
                            <div class="col-sm-9">
                                <select id="currency_to" name="currency_to" class="form-control">
                                    <option value="">{$_L['Select Currency']}</option>
                                    {foreach $currencies as $currency}
                                        <option value="{$currency['iso_code']}">{$currency['iso_code']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="c1_amount" class="col-sm-3 control-label">{$_L['Amount']} [USD]</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control amount" id="c1_amount" name="c1_amount">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c2_amount" class="col-sm-3 control-label">{$_L['Amount']} [IQD]</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control iqd" id="c2_amount" name="c2_amount">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exchange_rate" class="col-sm-3 control-label">Exchange Rate</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exchange_rate" name="exchange_rate">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">{$_L['Ref']}#</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description">
                                {*<div class="help-block"><a data-toggle="modal" href="#modal_add_item"><i class="fa fa-paperclip"></i> {$_L['Attach File']}</a> </div>*}
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



    </div>




    <input type="hidden" id="_lan_no_results_found" value="{$_L['No results found']}">
{/block}

{block name="script"}
    <script>

        String.prototype.replaceAll = function(search, replacement){
            var target = this;
            return target.split(search).join(replacement);
        };

        $(document).ready(function () {

            //  alert('{$c2_currency->rate}');

            var from_currency;

            var currency_rate;

            var $exchange_rate = $("#exchange_rate");
            var $currency_to = $("#currency_to");


            // var balance_helper;
            var $account = $("#account");
            $account.on('change',function () {
                var account_id = $account.val();
                $.get(base_url + 'transactions/get_balance/' + account_id, function (txt) {
                    $("#balance_helper").html(txt);
                })
            });
            var c1_rate = {$c2_currency->rate};
            var c2_rate = 1/{$c2_currency->rate};
            $('#currency_from').on('change',function () {
                from_currency = this.value;
                if(from_currency == 'USD'){
                    currency_rate = {$c2_currency->rate};


                    $currency_to.val('IQD');

                }
                else if(from_currency == 'IQD'){
                    currency_rate = 1/{$c2_currency->rate};
                    // alert(currency_rate);
                    $currency_to.val('USD');
                }
                else{

                }

                $exchange_rate.val(currency_rate);
            });

            var $c1_amount = $("#c1_amount");
            var $c2_amount = $("#c2_amount");

            var c1_amount_val;
            var c2_amount_val;
            $c1_amount.on('keyup',function () {
                c1_amount_val = $c1_amount.val().replace("$ ","");
                c1_amount_val = c1_amount_val.replaceAll(",","");
                $c2_amount.val(c1_amount_val*c1_rate);
            });

            $c2_amount.on('keyup',function () {
                c2_amount_val = $c2_amount.val().replace("IQD ","");
                c2_amount_val = c2_amount_val.replaceAll(",","");
                $c1_amount.val(c2_amount_val*c2_rate);
            });

            $('[data-toggle="datepicker"]').datepicker();

            $('.iqd').autoNumeric('init', {

                aSign: 'IQD ',
                dGroup: 3,
                aPad: true,
                pSign: 'p',
                aDec: '.',
                aSep: ','

            });


            $("#account").select2({
                    theme: "bootstrap",
                    language: {
                        noResults: function () {
                            return $("#_lan_no_results_found").val();
                        }
                    }
                }
            );

            $("#pmethod").select2({
                    theme: "bootstrap",
                    language: {
                        noResults: function () {
                            return $("#_lan_no_results_found").val();
                        }
                    }
                }
            );



            $("#emsg").hide();


            var _url = $("#_url").val();




            var $ib_form_submit = $("#submit");





            $ib_form_submit.click(function (e) {
                e.preventDefault();
                $('#ibox_form').block({ message: null });
                var _url = $("#_url").val();
                $.post(_url + 'transactions/exchange-post/', {


                    account: $('#account').val(),
                    date: $('#date').val(),

                    amount: $('#amount').val(),
                    currency_from: $('#currency_from').val(),
                    c1_amount: $('#c1_amount').val(),
                    c2_amount: $('#c2_amount').val(),

                    description: $('#description').val(),

                    ref: $('#ref').val()

                })
                    .done(function (data) {
                        var sbutton = $("#submit");
                        var _url = $("#_url").val();
                        if ($.isNumeric(data)) {

                            location.reload();
                        }
                        else {
                            $('#ibox_form').unblock();
                            var body = $("html, body");
                            body.animate({ scrollTop:0 }, '1000', 'swing');
                            $("#emsgbody").html(data);
                            $("#emsg").show("slow");
                        }
                    });
            });
        });
    </script>
{/block}
