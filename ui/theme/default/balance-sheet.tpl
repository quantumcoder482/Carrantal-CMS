{extends file="$layouts_admin"}

{block name="content"}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Balance Sheet']} </h5>

                </div>
                <div class="ibox-content">

                    <table class="table table-bordered sys_table">

                        <th width="80%">{$_L['Account']}</th>

                        <th class="text-right">{$_L['Balance']} [USD]</th>
                        <th class="text-right">{$_L['Balance']} [IQD]</th>

                        {foreach $d as $ds}
                            <tr>

                                <td>{$ds['account']}</td>

                                <td class="text-right"><span class="amount{if $ds['balance'] < 0} text-red{/if}">{$ds['balance']}</span></td>
                                <td class="text-right"><span class="{if $ds['balance'] < 0} text-red{/if}">IQD 0.00</span></td>

                            </tr>
                        {/foreach}



                    </table>
                    <table class="table invoice-total">
                        <tbody>

                        <tr>
                            <td><strong>{$_L['TOTAL']} [USD] :</strong></td>
                            <td><strong><span class="amount{if $tbal < 0} text-red{/if}">{$tbal}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>{$_L['TOTAL']} [IQD] :</strong></td>
                            <td><strong><span class="{if $tbal < 0} text-red{/if}">IQD 0.00</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>




        <!-- Widget-2 end-->
    </div> <!-- Row end-->


    <!-- Row end-->


    <!-- Row end-->
{/block}
