{extends file="$layouts_client"}

{block name="content"}


    <div class="panel panel-default">

        <div class="panel-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover sys_table">
                    <thead>
                    <tr>
                        <th class="text-right" data-sort-ignore="true" width="20px;">{$_L['Type']}</th>

                        <th>{$_L['Title']}</th>

                        <th class="text-right" data-sort-ignore="true" width="170px;">{$_L['Download']}</th>
                    </tr>
                    </thead>
                    <tbody>

                    {foreach $d as $ds}

                        <tr>

                            <td>
                                {if $ds['file_mime_type'] eq 'jpg' || $ds['file_mime_type'] eq 'png' || $ds['file_mime_type'] eq 'gif'}
                                    <i class="fa fa-file-image-o"></i>
                                {elseif $ds['file_mime_type'] eq 'pdf'}
                                    <i class="fa fa-file-pdf-o"></i>
                                {elseif $ds['file_mime_type'] eq 'zip'}
                                    <i class="fa fa-file-archive-o"></i>
                                {else}
                                    <i class="fa fa-file"></i>
                                {/if}
                            </td>


                            <td>

                                {$ds['title']}

                            </td>

                            <td class="text-right">

                                <a href="{$_url}client/dl/{$ds['id']}_{$ds['file_dl_token']}/" class="md-btn md-btn-primary"><i class="fa fa-download"></i> {$_L['Download']}</a>

                            </td>


                        </tr>

                    {/foreach}

                    </tbody>



                </table>

            </div>




        </div>
    </div>

{/block}