{extends file="$layouts_admin"}

{block name="content"}
    <div class="row">

        <div class="col-md-12">


            <div style="overflow: auto;">

                <div style="min-width: 1545px; max-width: 1545px;">

                    <!--sütun başlangıç-->
                    <div class="panel panel-deep-orange kanban-col">
                        <div class="panel-heading">

                            Not Started

                        </div>

                        <div class="panel-body">
                            <div id="not_started" class="kanban-centered kanban-droppable-area">
                                {foreach $tasks_not_started as $tns}
                                    <article class="kanban-entry cursor-move" id="item_{$tns['id']}" draggable="true">
                                        <div class="kanban-entry-inner">
                                            <div class="kanban-label">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="javascript:void(0)" id="v_{$tns['id']}" class="v_item">{$tns['title']}</a>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12">

                                                        <img src="{getAdminImage($tns['aid'])}" class="img-circle" style="max-width: 30px; margin-bottom: 5px;" alt="{$tns['created_by']}"> {$tns['created_by']}


                                                    </div>


                                                    <div class="col-md-12">

                                                        <small class="mmnt">{strtotime({$tns['created_at']})}</small>
                                                        {*<br>*}
                                                        {*<a href="javascript:void(0)" class="c_delete" id="d_{$tns['id']}"><i class="fa fa-trash"></i> </a>*}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </article>

                                {/foreach}
                            </div>
                        </div>



                        {*<div class="panel-body kanban-centered kanban-droppable-area">*}
                        {*<article class="kanban-entry cursor-move" id="item1" draggable="true">*}
                        {*<div class="kanban-entry-inner">*}
                        {*<div class="kanban-label">*}

                        {*<div class="row">*}
                        {*<div class="col-md-12">*}
                        {*<a href="#">How to Install this ?</a>*}
                        {*<hr>*}
                        {*</div>*}
                        {*<div class="col-md-8">*}
                        {*<img src="http://ib.local/storage/pics/croppedImg_3141.jpeg" class="img-circle" style="max-width: 30px; margin-bottom: 5px;" alt="Tahsin Hasan">*}
                        {*<img src="http://ib.local/storage/pics/croppedImg_3141.jpeg" class="img-circle" style="max-width: 30px;" alt="Tahsin Hasan">*}
                        {*<img src="http://ib.local/storage/pics/croppedImg_3141.jpeg" class="img-circle" style="max-width: 30px;" alt="Tahsin Hasan">*}
                        {*<img src="http://ib.local/storage/pics/croppedImg_3141.jpeg" class="img-circle" style="max-width: 30px;" alt="Tahsin Hasan">*}
                        {*<img src="http://ib.local/storage/pics/croppedImg_3141.jpeg" class="img-circle" style="max-width: 30px;" alt="Tahsin Hasan">*}
                        {*<img src="http://ib.local/storage/pics/croppedImg_3141.jpeg" class="img-circle" style="max-width: 30px;" alt="Tahsin Hasan">*}

                        {*</div>*}
                        {*<div class="col-md-4">*}
                        {*<small>Created At</small> <br>*}
                        {*<small>15/10/2014</small>*}
                        {*</div>*}
                        {*</div>*}

                        {*</div>*}
                        {*</div>*}
                        {*</article>*}
                        {*</div>*}

                    </div>
                    <!--sütun bitiş-->
                    <!--sütun başlangıç-->
                    <div class="panel panel-primary kanban-col">
                        <div class="panel-heading">

                            In Progress

                        </div>
                        <div class="panel-body">
                            <div id="in_progress" class="kanban-centered kanban-droppable-area">


                                {foreach $tasks_in_progress as $tns}
                                    <article class="kanban-entry cursor-move" id="item_{$tns['id']}" draggable="true">
                                        <div class="kanban-entry-inner">
                                            <div class="kanban-label">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="javascript:void(0)" id="v_{$tns['id']}" class="v_item">{$tns['title']}</a>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12">

                                                        <img src="{getAdminImage($tns['aid'])}" class="img-circle" style="max-width: 30px; margin-bottom: 5px;" alt="{$tns['created_by']}"> {$tns['created_by']}


                                                    </div>


                                                    <div class="col-md-12">

                                                        <small class="mmnt">{strtotime({$tns['created_at']})}</small>
                                                        {*<br>*}
                                                        {*<a href="javascript:void(0)" class="c_delete" id="d_{$tns['id']}"><i class="fa fa-trash"></i> </a>*}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </article>

                                {/foreach}


                            </div>
                        </div>

                    </div>
                    <!--sütun bitiş-->
                    <!--sütun başlangıç-->
                    <div class="panel panel-light-green kanban-col">
                        <div class="panel-heading">

                            Completed

                        </div>
                        <div class="panel-body">
                            <div id="completed" class="kanban-centered kanban-droppable-area">


                                {foreach $tasks_completed as $tns}
                                    <article class="kanban-entry cursor-move" id="item_{$tns['id']}" draggable="true">
                                        <div class="kanban-entry-inner">
                                            <div class="kanban-label">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="javascript:void(0)" id="v_{$tns['id']}" class="v_item">{$tns['title']}</a>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12">

                                                        <img src="{getAdminImage($tns['aid'])}" class="img-circle" style="max-width: 30px; margin-bottom: 5px;" alt="{$tns['created_by']}"> {$tns['created_by']}


                                                    </div>


                                                    <div class="col-md-12">

                                                        <small class="mmnt">{strtotime({$tns['created_at']})}</small>
                                                        {*<br>*}
                                                        {*<a href="javascript:void(0)" class="c_delete" id="d_{$tns['id']}"><i class="fa fa-trash"></i> </a>*}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </article>

                                {/foreach}


                            </div>
                        </div>

                    </div>

                    <div class="panel panel-blue-grey kanban-col">
                        <div class="panel-heading">

                            Deferred

                        </div>
                        <div class="panel-body">
                            <div id="deferred" class="kanban-centered kanban-droppable-area">


                                {foreach $tasks_deferred as $tns}
                                    <article class="kanban-entry cursor-move" id="item_{$tns['id']}" draggable="true">
                                        <div class="kanban-entry-inner">
                                            <div class="kanban-label">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="javascript:void(0)" id="v_{$tns['id']}" class="v_item">{$tns['title']}</a>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12">

                                                        <img src="{getAdminImage($tns['aid'])}" class="img-circle" style="max-width: 30px; margin-bottom: 5px;" alt="{$tns['created_by']}"> {$tns['created_by']}


                                                    </div>


                                                    <div class="col-md-12">

                                                        <small class="mmnt">{strtotime({$tns['created_at']})}</small>
                                                        {*<br>*}
                                                        {*<a href="javascript:void(0)" class="c_delete" id="d_{$tns['id']}"><i class="fa fa-trash"></i> </a>*}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </article>

                                {/foreach}


                            </div>
                        </div>

                    </div>

                    <div class="panel panel-grey kanban-col" style="border-right: 1px solid #ffffff;">
                        <div class="panel-heading">

                            Waiting on someone else

                        </div>
                        <div class="panel-body">
                            <div id="waiting_on_someone" class="kanban-centered kanban-droppable-area">


                                {foreach $tasks_waiting as $tns}
                                    <article class="kanban-entry cursor-move" id="item_{$tns['id']}" draggable="true">
                                        <div class="kanban-entry-inner">
                                            <div class="kanban-label">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="javascript:void(0)" id="v_{$tns['id']}" class="v_item">{$tns['title']}</a>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12">

                                                        <img src="{getAdminImage($tns['aid'])}" class="img-circle" style="max-width: 30px; margin-bottom: 5px;" alt="{$tns['created_by']}"> {$tns['created_by']}


                                                    </div>


                                                    <div class="col-md-12">

                                                        <small class="mmnt">{strtotime({$tns['created_at']})}</small>
                                                        {*<br>*}
                                                        {*<a href="javascript:void(0)" class="c_delete" id="d_{$tns['id']}"><i class="fa fa-trash"></i> </a>*}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </article>

                                {/foreach}


                            </div>
                        </div>

                    </div>
                    <!--sütun bitiş-->


                </div>
            </div>



        </div>

    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary waves-effect waves-light add_task" href="#">
            <i class="fa fa-plus"></i>
        </a>
    </div>
{/block}