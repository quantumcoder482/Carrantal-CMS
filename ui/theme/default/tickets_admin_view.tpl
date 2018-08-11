{extends file="$layouts_admin"}

{block name="content"}




    <div class="row">
        <div class="col-md-4">
            <a href="{$_url}tickets/admin/list/" class="btn btn-primary btn-sm" style="margin-bottom: 15px;"><i
                        class="fa fa-long-arrow-left"></i> Back to the List</a>


            <div class="panel panel-default" id="t_options">


                <div class="panel-body">
                    <h3>{$d->subject}</h3>
                    <hr>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#details"><i class="fa fa-th"></i> Details</a></li>
                        <li><a data-toggle="tab" href="#tasks"><i class="fa fa-tasks"></i> Tasks</a></li>

                    </ul>

                    <div class="tab-content">
                        <div id="details" class="tab-pane fade in active ib-tab-box">


                            <span class="label label-default inline-block"> {$_L['Priority']}: {$d->urgency} </span> &nbsp;

                            <span class="label label-default inline-block"> {$_L['Status']}: <span id="inline_status">{$d->status}</span></span>
                            <hr>
                            <p><strong>Customer:</strong> <a href="{$_url}contacts/view/{$d->userid}">{$d->account}</a></p>
                            <hr>

                            {*<p><strong>Email:</strong> <a href="javascript:void(0)" id="editable_email" data-toggle="tooltip" data-placement="top" title="Mark as Completed">{$d->email}</a></p>*}
                            {*<p><strong>Cc:</strong> <a href="#" id="editable_cc" data-type="text" data-pk="{$d->id}">{$d->cc}</a>*}
                            {*</p>*}
                            {*<p><strong>Bcc:</strong> <a href="#" id="editable_bcc" data-type="text" data-pk="{$d->id}">{$d->bcc}</a>*}
                            {*</p>*}
                            {*<p><strong>Phone:</strong> <a href="#" id="editable_phone" data-type="text"*}
                            {*data-pk="{$d->userid}">{if $c}{$c->phone}{/if}</a></p>*}
                            {*<p><strong>Status:</strong> <a href="#" id="editable_status" data-type="select"*}
                            {*data-pk="{$d->id}">{$d->status}</a></p>*}
                            {*<p><strong>Department:</strong> <a href="#" id="editable_department" data-type="select"*}
                            {*data-pk="{$d->id}">{$department}</a></p>*}
                            {*<p><strong>Assigned To:</strong> <a href="#" id="editable_assigned_to" data-type="select"*}
                            {*data-pk="{$d->id}">{getAdminName($d->aid)}</a></p>*}


                            <a class="btn btn-primary" href="#" id="add_reply">Add Reply</a>
                            <a class="cdelete btn btn-danger" href="#" id="t{$d->id}"><i class="icon-trash"></i> </a>



                            <hr>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <div class="form-material floating">
                                            <select class="form-control" id="editable_department" name="editable_department" size="1">
                                                <option value="None">None</option>
                                                {foreach $departments as $dep}
                                                    <option value="{$dep['id']}" {if $department eq $dep['dname']} selected{/if}>{$dep['dname']}</option>
                                                {/foreach}
                                            </select>
                                            <label for="editable_department">Department</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <div class="form-material floating">
                                            <select class="form-control" id="editable_assigned_to" name="editable_assigned_to" size="1">
                                                <option value="None">None</option>
                                                {foreach $ads as $ad}
                                                    <option value="{$ad['id']}" {if $d->aid eq $ad['id']} selected{/if}>{$ad['fullname']}</option>
                                                {/foreach}
                                            </select>
                                            <label for="editable_assigned_to">Assigned To</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <div class="form-material floating">
                                            <select class="form-control" id="editable_status" name="editable_status" size="1">
                                                <option value="Open" {if $d->status eq 'Open'} selected{/if}>Open</option>
                                                <option value="On Hold" {if $d->status eq 'On Hold'} selected{/if}>On Hold</option>
                                                <option value="Escalated" {if $d->status eq 'Escalated'} selected{/if}>Escalated</option>
                                                <option value="Closed" {if $d->status eq 'Closed'} selected{/if}>Closed</option>

                                            </select>
                                            <label for="editable_status">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <input class="form-control" type="text" id="editable_email" name="editable_email" value="{$d->email}">
                                        <label for="editable_cc">Email</label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <input class="form-control" type="text" id="editable_cc" name="editable_cc" value="{$d->cc}">
                                        <label for="editable_cc">CC</label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <input class="form-control" type="text" id="editable_bcc" name="editable_bcc" value="{$d->bcc}">
                                        <label for="editable_bcc">BCC</label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <input class="form-control" type="text" id="editable_phone" name="editable_phone" value="{if $c}{$c->phone}{/if}">
                                        <label for="editable_phone">Phone</label>
                                    </div>
                                </div>
                            </div>



                            <input type="hidden" name="tid" id="tid" value="{$d->id}">



                            <div class="row">
                                <div class="col-xs-12">
                                    <form>

                                        <hr>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Note</label>
                                            <textarea class="form-control" name="notes" id="notes" rows="3"
                                                      placeholder="Add Note...">{$d->notes}</textarea>
                                        </div>

                                        <button type="submit" id="btn_save_note" class="btn btn-primary">{$_L['Save']}</button>

                                    </form>
                                </div>
                            </div>


                            <hr>

                            <h4>Previous Conversations</h4>

                            <table class="table table-hover">

                                <tbody>

                                {foreach $o_tickets as $o_ticket}

                                    {if $o_ticket['id'] == $d->id}
                                        {continue}
                                    {/if}

                                    <tr>
                                        <td>
                                            <em class="mmnt">{strtotime($o_ticket['created_at'])}</em>
                                            <br>
                                            <p><a href="{$_url}tickets/admin/view/{$o_ticket['id']}">{$o_ticket['subject']}</a></p>
                                            <span class="label label-default inline-block"> {$_L['Status']}: {$d->status} </span> &nbsp;
                                            <span class="label label-default inline-block"> {$_L['Priority']}: {$d->urgency} </span> &nbsp;

                                        </td>
                                    </tr>

                                    {foreachelse}
                                    <tr>
                                        <td>

                                            No Data Available

                                        </td>
                                    </tr>
                                {/foreach}

                                {*<tr>*}
                                {*<td>*}
                                {*<em class="mmnt">1486754289</em>*}
                                {*<br>*}
                                {*<p><a href="#">How to do this?</a></p>*}

                                {*</td>*}
                                {*</tr>*}

                                </tbody>
                            </table>

                        </div>


                        <div id="tasks" class="tab-pane fade ib-tab-box">


                            <form id="ib_add_group" class="form-horizontal push-10-t push-10" method="post">

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="task_subject" name="task_subject">
                                            <label for="task_subject">Task</label>

                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary" id="btn_add_task" type="submit"> Save</button>
                                        <div id="tasks_tools"  style="display: none;">
                                            <hr>
                                            {*<button class="btn btn-green" id="btn_mark_tasks_completed" type="button"><i class="fa fa-check push-5-r"></i> Completed</button>*}
                                            {*<button class="btn btn-warning" id="btn_mark_tasks_not_started" type="button"><i class="fa fa-check push-5-r"></i> Not Started</button>*}
                                            {*<hr>*}
                                            {*<button class="btn btn-danger" id="btn_delete_tasks" type="button"><i class="fa fa-trash push-5-r"></i> Delete</button>*}

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-green no-shadow" id="btn_mark_tasks_completed" data-toggle="tooltip" data-placement="top" title="Mark as Completed"><i class="fa fa-check"></i></button>
                                                <button type="button" class="btn btn-primary no-shadow" id="btn_mark_tasks_not_started" data-toggle="tooltip" data-placement="top" title="Mark as Not Started"><i class="fa fa-clock-o"></i></button>
                                                <button type="button" class="btn btn-danger no-shadow" id="btn_delete_tasks" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                            </div>


                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="tasks_list">

                            </div>


                        </div>

                    </div>





                </div>

            </div>

        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12" id="create_ticket">


                    <!-- The time line -->
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <li class="time-label">
                  <span class="mmnt">
                    {strtotime($d->created_at)}
                  </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            {*<i class="fa fa-envelope bg-blue"></i>*}


                            {if $d->admin neq '0'}
                                {if $user['img'] eq 'gravatar'}
                                    <img src="http://www.gravatar.com/avatar/{($user['email'])|md5}?s=30"
                                         class="img-time-line" alt="{$user['fullname']}">
                                {elseif $user['img'] eq ''}
                                    <img class="img-time-line" src="{$app_url}ui/lib/imgs/default-user-avatar.png" alt="">
                                {else}
                                    <img src="{$user['img']}" class="img-time-line" alt="{$user['account']}">
                                {/if}

                            {elseif ($c)}

                                {if $c->img eq 'gravatar'}
                                    <img src="http://www.gravatar.com/avatar/{($user['email'])|md5}?s=30"
                                         class="img-time-line" alt="{$user['fullname']}">
                                {elseif $c->img eq ''}
                                    <img class="img-time-line" src="{$app_url}ui/lib/imgs/default-user-avatar.png" alt="">
                                {else}
                                    <img src="{$c->img}" class="img-time-line" alt="{$user['account']}">
                                {/if}

                            {else}



                            {/if}


                            <div class="timeline-item">
                                {*<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>*}


                                <h3 class="timeline-header"><a href="javascript:void(0)">{$d->account}</a></h3>

                                <div class="timeline-body">
                                    {$d->message}
                                    <hr>

                                    <a href="#" class="btn btn-warning btn-xs t_edit" data-toggle="tooltip"
                                       data-placement="top" title="" data-original-title="{$_L['Edit']}" id="et{$d->id}"><i
                                                class="glyphicon glyphicon-pencil"></i> </a>
                                </div>

                                {if ($d->attachments) neq ''}
                                    <div class="timeline-footer">
                                        {Tickets::gen_link_attachments($d->attachments)}
                                    </div>
                                {/if}


                            </div>
                        </li>

                        {foreach $replies as $reply}
                            <li class="time-label">
                  <span class="mmnt">
                    {strtotime($reply['created_at'])}
                  </span>
                            </li>
                            <li>
                                {*<i class="fa fa-envelope bg-blue"></i>*}


                                {if $reply['admin'] neq '0'}
                                    <img src="{getAdminImage($reply['admin'],30)}" class="img-time-line">
                                {elseif ($c)}

                                    {if $c->img eq ''}
                                        <img class="img-time-line" src="{$app_url}ui/lib/imgs/default-user-avatar.png"
                                             alt="">
                                    {else}
                                        <img src="{$c->img}" class="img-time-line" alt="{$user['account']}">
                                    {/if}

                                {else}



                                {/if}

                                <div class="timeline-item">
                                    {*<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>*}

                                    <h3 class="timeline-header"><a href="javascript:void(0)">{$reply['replied_by']}</a></h3>

                                    <div class="timeline-body" {if $reply['reply_type'] eq 'internal'} style="background: #FFF6D9;" {/if}>
                                        {$reply['message']}

                                        <hr>

                                        <a href="#" class="btn btn-warning btn-xs no-shadow reply_edit"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="{$_L['Edit']}" id="er{$reply['id']}"><i
                                                    class="glyphicon glyphicon-pencil"></i> </a> &nbsp;
                                        <a href="#" class="btn btn-danger btn-xs no-shadow reply_delete"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="{$_L['Delete']}" id="dr{$reply['id']}"><i
                                                    class="glyphicon glyphicon-trash"></i> </a> &nbsp;

                                        {if $reply['reply_type'] eq 'internal'} <a href="#" class="btn btn-primary btn-xs no-shadow reply_make_public"
                                                                                   data-toggle="tooltip" data-placement="top" title=""
                                                                                   data-original-title="{$_L['Public']}" id="rp{$reply['id']}"><i
                                                    class="fa fa-globe"></i> </a> {/if}

                                    </div>

                                    {if ($reply['attachments']) neq ''}
                                        <div class="timeline-footer">
                                            {Tickets::gen_link_attachments($reply['attachments'])}
                                        </div>
                                    {/if}


                                </div>
                            </li>
                        {/foreach}

                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li class="time-label">
                  <span class="bg-green" id="section_add_reply">
                   Add Reply
                  </span>
                        </li>
                        <li>
                            {if $user['img'] eq ''}
                                <img class="img-time-line" src="{$app_url}ui/lib/imgs/default-user-avatar.png" alt="">
                            {else}
                                <img src="{$user['img']}" class="img-time-line" alt="{$user['account']}">
                            {/if}

                            <div class="timeline-item">


                                <div class="timeline-body">
                                    <form class="form-horizontal push-10-t push-10" method="post">

                                        <ul class="nav nav-pills">
                                            <li class="active" id="reply_public"><a href="#">Public</a></li>
                                            <li id="reply_internal"><a href="#">Internal</a></li>

                                        </ul>

                                        <div class="form-group">
                                            <div class="col-xs-12">

                                            <textarea id="content" class="form-control sysedit"
                                                      name="content"></textarea>
                                                <div class="help-block"><a data-toggle="modal" href="#modal_add_item"><i
                                                                class="fa fa-paperclip"></i> Attach File</a></div>
                                            </div>
                                        </div>

                                        {*<div class="form-group">*}
                                        {*<div class="col-xs-12">*}
                                        {*<label for="exampleInputPassword1">Status</label>*}
                                        {*<select class="form-control">*}
                                        {*<option>Closed</option>*}
                                        {*<option>Pending</option>*}
                                        {*<option>Active</option>*}
                                        {*</select>*}
                                        {*</div>*}
                                        {*</div>*}


                                        <div class="form-group">
                                            <div class="col-xs-12">

                                                <input type="hidden" name="attachments" id="attachments" value="">
                                                <input type="hidden" name="f_tid" id="f_tid" value="{$d->id}">
                                                <input type="hidden" name="cid" id="cid" value="{$d->userid}">

                                                <button class="btn btn-primary" id="ib_form_submit" type="submit"><i
                                                            class="fa fa-send push-5-r"></i> Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {*<div class="timeline-footer">*}
                                {*<a class="btn btn-primary btn-xs">Read more</a>*}
                                {*<a class="btn btn-danger btn-xs">Delete</a>*}
                                {*</div>*}
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->

                        <!-- END timeline item -->
                        <!-- timeline time label -->

                        <!-- /.timeline-label -->
                        <!-- timeline item -->

                        <!-- END timeline item -->
                        <!-- timeline item -->

                        <!-- END timeline item -->
                        <li>
                            <i class="fa fa-life-ring bg-gray"></i>
                        </li>
                    </ul>
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>

    <div id="modal_add_item" class="modal fade" tabindex="-1" data-width="600" style="display: none;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add File</h4>
        </div>
        <div class="modal-body">
            <div class="row">


                <div class="col-md-12">
                    <form action="" class="dropzone" id="upload_container">

                        <div class="dz-message">
                            <h3><i class="fa fa-cloud-upload"></i> Drop File Here</h3>
                            <br/>
                            <span class="note">Or Click to Upload</span>
                        </div>

                    </form>


                </div>


            </div>
        </div>
        <div class="modal-footer">

            <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>

        </div>
    </div>

{/block}

