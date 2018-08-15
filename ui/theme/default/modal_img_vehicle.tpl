<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
   
            {$d['vehicle_num']} - {$d['vehicle_type']}
      
    </h3>
</div>

<div class="modal-body">

    <form class="form-horizontal" id="ib_modal_form">

        <div class="row">
            <div class="col-md-12">

                <img src="{$vehicle_img_path}" width="100%" />

            </div>
        </div>

    </form>

</div>
<div class="modal-footer">
    
    <button class="btn btn-primary view_submit" type="submit" id="view_submit">
         {$_L['Close']}
    </button>

</div>