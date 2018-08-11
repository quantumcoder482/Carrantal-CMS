<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        {$d->title}
    </h3>
</div>
<div class="modal-body" style="font-size: 14px;">

    <div class="row">


        <div class="col-md-12">
            <a href="javascript:void(0)" class="btn btn-danger c_delete" id="d_{$d->id}">{$_L['Delete']}</a>
            <a href="javascript:void(0)" class="btn btn-warning c_edit" id="e_{$d->id}">{$_L['Edit']}</a>
            <hr>
            <h4>Description</h4>
            <hr>

            {if $d->description eq ''}
<p>No description available.</p>
                {else}
                {$d->description}
            {/if}
            <hr>

            {*<h4>Comments</h4>*}

            {*<hr>*}



        </div>



    </div>

</div>
<div class="modal-footer">

    <input type="hidden" id="task_id" name="task_id" value="{$d->id}">
    <button type="button" data-dismiss="modal" class="btn btn-danger">{$_L['Close']}</button>
</div>