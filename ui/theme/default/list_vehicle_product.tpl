{extends file="$layouts_admin"}

{block name="style"}
    <link href="{$assets}lib/duallistbox/bootstrap-duallistbox.min.css" rel="stylesheet">
{/block}

{block name="content"}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>{$_L['List']} {$_L['Vehicles']}</h5>
                    <div class="ibox-tools">
                        <a href="{$_url}ps/v-new" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> {$_L['Add Vehicle']}</a>
                    </div>
                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="input-group"><input type="text" placeholder="{$_L['Search']}" id="txtsearch" class="input-sm form-control"> <span class="input-group-btn">
                      <button type="button" id="search" class="btn btn-sm btn-primary"> {$_L['Search']}</button> </span></div>
                    <input type="hidden" id="stype" value="{$type}">

                    <div class="project-list mt-md">
                        <div id="progressbar">
                        </div>

                        <div id="application_ajaxrender">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="_lan_are_you_sure" value="{$_L['are_you_sure']}">
{/block}

{block name="script"}

    <script src="{$assets}lib/duallistbox/jquery.bootstrap-duallistbox.min.js?ver={$file_build}"></script>



{/block}