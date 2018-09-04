{extends file="$layouts_client"}

{block name="content"}
  
    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        {$_L['Contract s Agreement']} 
                    </h5>
                </div>
                <div class="ibox-content">
                
                    <table class="table table-bordered table-hover sys_table footable" {if $view_type=='filter' } data-filter="#foo_filter" data-page-size="10"
                        {/if}>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{$_L['Date Created']}</th>
                                <th>{$_L['Vehicle']}</th>
                                <th>{$_L['Invoice']}</th>
                                <th>{$_L['Title']}</th>
                                <th>{$_L['Action']}</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                
                            {foreach $d as $ds}
                            <tr>
                                <td>
                                    {$ds['id']}
                                </td>
                                <td>
                                    {$ds['created_date']}
                                </td>
                                <td >
                                   {$val[$ds['id']]['vehicle']}
                                </td>
                                <td>
                                    {$val[$ds['id']]['invoice']}
                                </td>
                                <td>
                                    <a href="#" class="show_contract" id="{$ds['id']}"> {$val[$ds['id']]['contract']}</a>
                                </td>
                                <td>
                                    {if $ds['status'] eq 0}
                                    <span class="btn btn-primary btn-xs" style="opacity:0;" disabled><i class="fa fa-file-pdf-o"></i></span>
                                    <span class="btn btn-warning btn-xs" style="background-color:#FFA500; border-color:#FFA500; color:#f8f8f8; width:65px">Pending</span>
                                    {else}
                                    <span class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i></span>
                                    <span class="btn btn-success btn-xs" style="background-color:#00AA00; border-color:#00AA00; color:#f8f8f8; width:65px">Signed</span>
                                    {/if}
                                </td>
                               
                            </tr>
                            {/foreach}
                
                        </tbody>
                
                        {if $view_type == 'filter'}
                        <tfoot>
                            <tr>
                                <td style="text-align: left;" colspan="10">
                                    <ul class="pagination">
                                    </ul>
                                </td>
                            </tr>
                        </tfoot>
                        {/if}
                
                    </table>
                    {$paginator['contents']}
                </div>
            </div>
        </div>

    </div>
{/block}

{block name="script"}
    <script>
        $(document).ready(function(){
           

            $('.show_contract').on('click', function(e){
                 e.preventDefault();
                 var id=this.id;
                 var _url=$('#_url').val();
                 window.location.href=_url+'client/contract_view/'+id;

            })



        });
    </script>

{/block}
