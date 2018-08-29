{extends file="$layouts_admin"}


{block name="content"}
    <div class="row">

        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        {$_L['Add Contract s Agreement']} 
                    </h5>
                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>

                    <form class="form-horizontal" id="rform">

                        <div class="form-group">
                            <!-- <label class="col-lg-2 control-label" for="vehicle_num">{$_L['Vehicle No']}</label> -->
                            <div class="col-lg-12">
                                <input type="text" id="title" name="title" class="form-control" autocomplete="off" placeholder="Title">
                            </div>
                        </div>
                        
                        <hr>
                       
                        <div class="form-group">
                            <!-- <label class="col-lg-2 control-label" for="description">{$_L['Description']}</label> -->

                            <div class="col-lg-12"><textarea id="description" name="description" class="form-control" rows="3"></textarea>

                            </div>
                        </div>

                   
                       
                        <input type="hidden" name="vehicle_file" id="vehicle_file" value="">
                        <input type="hidden" name="cert_file" id="cert_file" value="">

                        <div class="form-group">
                            <div class="col-lg-12">

                                <button class="btn btn-primary" type="submit" id="submit">{$_L['Save']}</button>
                                <button class="btn btn-info" type="submit" id="submit">{$_L['Save n Close']}</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                         {$_L['Merge Tags']}
                    </h5>
                </div>
                <div class="ibox-content" id="ibox_form">
                    <div>
                        tags
                    </div>

                </div>
            </div>
       
        </div>


    </div>
{/block}