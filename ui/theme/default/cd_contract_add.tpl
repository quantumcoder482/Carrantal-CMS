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
                            <div class="col-lg-12">
                                <input type="text" id="title" name="title" class="form-control" autocomplete="off"
                                    style="border-top-style:hidden; border-left-style:hidden; border-right-style:hidden;font-size: medium; font-weight: 600" placeholder="Title" value="{$title}">
                            </div>
                        </div>
                        
                        <hr>
                       
                        <div class="form-group">
                            <div class="col-lg-12">
                                <textarea id="content" name="content" class="form-control sysedit" rows="3">{$content}</textarea>
                            </div>
                        </div>
                       
                        <input type="hidden" name="id" id="id" value="{$id}">
                        <!-- <input type="hidden" name="cert_file" id="cert_file" value=""> -->

                        <div class="form-group">
                            <div class="col-lg-12">

                                <button class="btn btn-primary" type="submit" id="submit">{$_L['Save']}</button>
                                <button class="btn btn-info" type="submit" id="close">{$_L['Save n Close']}</button>

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
                    <div class="container-fluid" >
                        <button class="btn btn-primary mt-sm" id="insert_name">{$_L['name']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_address">{$_L['address']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_nric">{$_L['nric']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_contact">{$_L['contact']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_date">{$_L['date']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_passdate">{$_L['pass_date']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_vstartdate">{$_L['v_start_date']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_venddate">{$_L['v_end_date']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_vduration">{$_L['v_duration']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_vmakemodel">{$_L['v_make_model']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_vehiclenum">{$_L['vehicle_no']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_invoiceamount">{$_L['invoice_amount']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_deposit">{$_L['deposit']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_depositamount">{$_L['deposit_amount']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_depositbalance">{$_L['deposit_balance']}</button>
                        <button class="btn btn-primary mt-sm" id="insert_depositrepayamount">{$_L['deposit_repay_amount']}</button>
                        <!-- <p><button class="btn btn-primary" id="insert_name">{$_L['name']}</button></p>
                        <p><button class="btn btn-primary" id="insert_address">{$_L['address']}</button></p>
                        <p><button class="btn btn-primary" id="insert_nric">{$_L['nric']}</button></p>
                        <p><button class="btn btn-primary" id="insert_contact">{$_L['contact']}</button></p>
                        <p><button class="btn btn-primary" id="insert_date">{$_L['date']}</button></p>
                        <p><button class="btn btn-primary" id="insert_passdate">{$_L['pass_date']}</button></p>
                        <p><button class="btn btn-primary" id="insert_vstartdate">{$_L['v_start_date']}</button></p>
                        <p><button class="btn btn-primary" id="insert_venddate">{$_L['v_end_date']}</button></p>
                        <p><button class="btn btn-primary" id="insert_vduration">{$_L['v_duration']}</button></p>
                        <p><button class="btn btn-primary" id="insert_vmakemodel">{$_L['v_make_model']}</button></p>
                        <p><button class="btn btn-primary" id="insert_vehiclenum">{$_L['vehicle_no']}</button></p>
                        <p><button class="btn btn-primary" id="insert_invoiceamount">{$_L['invoice_amount']}</button></p>
                        <p><button class="btn btn-primary" id="insert_deposit">{$_L['deposit']}</button></p>
                        <p><button class="btn btn-primary" id="insert_depositamount">{$_L['deposit_amount']}</button></p>
                        <p><button class="btn btn-primary" id="insert_depositbalance">{$_L['deposit_balance']}</button></p>
                        <p><button class="btn btn-primary" id="insert_depositrepayamount">{$_L['deposit_repay_amount']}</button></p> -->
                    </div>
                </div>
            </div>
       
        </div>


    </div>
{/block}
