{extends file="$layouts_admin"}

{block name="content"}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Manage_Accounts']}</h5>

                </div>
                <div class="ibox-content">

                    <table class="table table-striped table-bordered">
                        <th>{$_L['Account']}</th>
                        <th>{$_L['Description']}</th>
                        <th>{$_L['Manage']}</th>
                        {foreach $d as $ds}
                            <tr>
                                <td>{$ds['account']}</td>
                                <td>{$ds['description']}</td>
                                <td>
                                    <a href="{$_url}accounts/edit/{$ds['id']}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> {$_L['Edit']}</a>

                                    {if $ds['ib_url'] neq ''}
                                        <a href="{$ds['ib_url']}" target="_blank" class="btn btn-xs btn-primary"><i class="fa fa-globe"></i></a>
                                    {/if}

                                    <a href="{$_url}accounts/delete/{$ds['id']}" id="did{$ds['id']}" class="cdelete btn btn-danger btn-xs"><i class="fa fa-trash"></i> {$_L['Delete']}</a>
                                </td>
                            </tr>
                        {/foreach}


                    </table>

                </div>
            </div>



        </div>



    </div>


    <input type="hidden" id="_lan_are_you_sure" value="{$_L['are_you_sure']}">


{/block}


{block name="script"}

    <script>
        $(function () {
            $(".cdelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                var lan_msg = $("#_lan_are_you_sure").val();
                bootbox.confirm(lan_msg, function(result) {
                    if(result){
                        var _url = $("#_url").val();
                        window.location.href = _url + "accounts/delete/" + id + '/';
                    }
                });
            });
        })
    </script>


{/block}
