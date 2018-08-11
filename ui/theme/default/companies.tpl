{extends file="$layouts_admin"}

{block name="content"}
    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">
                <div class="panel-body">

                    <a href="#" class="btn btn-primary add_company waves-effect waves-light" id="add_company"><i class="fa fa-plus"></i> {$_L['New Company']}</a>


                </div>

            </div>
        </div>



    </div>

    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">



                    <div class="table-responsive" id="ib_data_table">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="bold">{$_L['Logo']}</th>
                                <th class="bold">{$_L['Company Name']}</th>
                                <th class="bold">{$_L['Email']}</th>
                                <th class="bold">{$_L['Phone']}</th>
                                <th class="text-center bold">{$_L['Manage']}</th>
                            </tr>
                            </thead>
                            <tbody>


                            {foreach $companies as $company}
                                <tr data-id="{$company['id']}">
                                    <td>

                                        {if $company['logo_url'] neq ''}
                                            <img style="max-height: 40px;" src="{$app_url}storage/companies/{$company['logo_url']}">
                                        {else}
                                            <img src="{$app_url}ui/assets/img/default_company.png">
                                        {/if}

                                    </td>
                                    <td> <a class="cview" id="ae{$company['id']}" href="#">{$company['company_name']}</a>
                                    </td>
                                    <td><a href="#" class="send_email">{$company['email']}</a> </td>
                                    <td>{$company['phone']}</td>
                                    <td class="text-right">
                                        <a href="{$_url}" id="be{$company['id']}" class="btn btn-inverse btn-xs cedit" data-toggle="tooltip" title="{$_L['Edit']}"><i class="fa fa-pencil"></i> </a>


                                        <a href="#" class="btn btn-danger btn-xs cdelete" id="c{$company['id']}" data-toggle="tooltip" title="{$_L['Delete']}"><i class="fa fa-trash"></i> </a>
                                    </td>

                                </tr>
                            {/foreach}






                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary waves-effect waves-light add_company" href="#">
            <i class="fa fa-plus"></i>
        </a>
    </div>
{/block}
