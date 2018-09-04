{extends file="$layouts_client"}

{block name="content"}
  
    <div class="row">

        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        {$_L['Contract']} - {$contract['title']} 
                    </h5>
                </div>
                <div class="ibox-content">
                                        
                    <form class="form-horizontal" id="rform">
                        
                        <div class="form-group">
                            <div class="col-lg-12" style="height:600px; border-style:solid;border-color: #DCDCDC; overflow:scroll">
                                <!-- <textarea id="content" name="content" class="form-control sysedit" rows="20"></textarea> -->
                                <p></p>
                                <div style="text-align:center" ><img src="{$logo_url}" width="270px" /></div> 
                                <p style="text-align:center">{$company_name}</p>
                                <div style="text-align:center">{$caddress}</div>
                                <hr>
                                <p><h1 style="text-align:center">{$contract['title']}</h1></p>
                                <p>{$content}</p>
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="i-checks" name="agree" id="agree" {if $d['status'] eq 1} checked {/if} > {$_L['contract agreement text']}
                                </label>
                            </div>    
                        </div>

                    
                        <div class="form-group">
                            <div class="col-lg-4" style="text-align:center">
                                {if $d['status'] eq 1}
                                <div><span style="text-align:center; margin-bottom:5px; font-weight: 600">{$d['submit_name']}</span></div>
                                <hr style="margin-top:5px; margin-bottom:5px">
                                {else}
                                <input type="text" id="name" name="name" class="form-control" style="text-align:center" autocomplete="off">
                                {/if}
                                <label for="name" style="font-weight:400">{$_L['Name']}</label>
                            </div>
                        
                        
                            <div class="col-lg-4" style="text-align:center">
                                {if $d['status'] eq 1}
                                <div><span style="text-align:center; margin-bottom: 5px; font-weight: 600" data-date-format="yyyy-mm-dd" data-auto-close="true" disabled>{$d['submit_date']}</span></div>
                                <hr style="margin-top:5px; margin-bottom: 5px">
                                {else}
                                <input type="text" id="date" name="date" class="form-control" style="text-align:center" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true" value="{$today}" {if $d['status'] eq 0} disabled {/if}>
                                {/if}
                                <label for="date" style="font-weight:400">{$_L['Date']}</label>
                            </div>
                    

                            
                            <div class="col-lg-4">
                                {if $d['status'] eq 1}
                                <button class="btn btn-lg" type="button" id="submit_agree" style="width:100%" disabled>{$_L['Send Confirmation']}</button>
                                {else}
                                <button class="btn btn-primary btn-lg" type="button" id="submit_agree" style="width:100%">{$_L['Send Confirmation']}</button>
                                {/if}
                            </div>
                        </div>
                        
                        <input type="hidden" name="id" id="id" value="{$id}">
                        <!-- <input type="hidden" name="cert_file" id="cert_file" value=""> -->
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="font-weight:600">
                    {$_L['Information']}
                </div>
                <div class="ibox-content" id="ibox_form">
                    <div>
                        <table class="info">
                            <tr>
                                <td>Name:</td>
                                <td>{$user['account']}</td>
                            </tr>
                            <tr>
                                <td>NRIC:</td>
                                <td>{$user['nric']}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>{$user['address']}</td>
                            </tr>
                            <tr>
                                <td>Vehicle No.</td>
                                <td>{$vehicle['vehicle_num']}</td>
                            </tr>
                            <tr>
                                <td>Make/Model:</td>
                                <td>{$vehicle['vehicle_type']}</td>
                            </tr>
                            <tr>
                                <td>Start Date:</td>
                                <td>{$invoice['date']}</td>
                            </tr>
                            <tr>
                                <td>End Date:</td>
                                <td>{$invoice['duedate']}</td>
                            </tr>
                            <tr>
                                <td>Duration:</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>Deposit:</td>
                                <td class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}">{$deposit['deposit_amount']}</td>
                            </tr>
                            <tr>
                                <td>Balance:</td>
                                <td class="amount" data-a-sign="{$config['currency_code']} " data-a-dec="{$config['dec_point']}" data-a-sep="{$config['thousands_sep']}">{$deposit['balance']}</td>
                            </tr>
                            
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
{/block}
{block name="script"}
<script>
    $(document).ready(function () {
 
        var _url = $("#_url").val();
        var ib_submit=$('#submit_agree');

        var i_checks = $('.i-checks');
        i_checks.iCheck({
            checkboxClass: 'icheckbox_square-blue'
        });

        ib_submit.on('click', function(e){

            e.preventDefault();
            $('#date').prop('disabled', false);
       
            $.post(_url+'client/contract_agree/', $('#rform').serialize())
            .done(function(data){
                if($.isNumeric(data)){
                    location.reload();
                }else {
                     location.reload();
                }
            });
        });

        $('.show_contract').on('click', function (e) {
            e.preventDefault();
            var id = this.id;
            var _url = $('#_url').val();
            window.location.href = _url + 'client/contract_view/' + id;

        })


    });
</script> 
{/block}