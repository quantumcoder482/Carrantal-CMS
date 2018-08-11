<?php
/* Smarty version 3.1.32, created on 2018-06-18 10:21:27
  from '/Users/razib/Dropbox/valet/stackb/ui/theme/default/tickets_admin_view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b27bfe73d3066_35805798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69e330ac6b415108353a3911aecbe14830063089' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/ui/theme/default/tickets_admin_view.tpl',
      1 => 1507716850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b27bfe73d3066_35805798 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14285477415b27bfe738bd44_78099443', "content");
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['layouts_admin']->value));
}
/* {block "content"} */
class Block_14285477415b27bfe738bd44_78099443 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_14285477415b27bfe738bd44_78099443',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>





    <div class="row">
        <div class="col-md-4">
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
tickets/admin/list/" class="btn btn-primary btn-sm" style="margin-bottom: 15px;"><i
                        class="fa fa-long-arrow-left"></i> Back to the List</a>


            <div class="panel panel-default" id="t_options">


                <div class="panel-body">
                    <h3><?php echo $_smarty_tpl->tpl_vars['d']->value->subject;?>
</h3>
                    <hr>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#details"><i class="fa fa-th"></i> Details</a></li>
                        <li><a data-toggle="tab" href="#tasks"><i class="fa fa-tasks"></i> Tasks</a></li>

                    </ul>

                    <div class="tab-content">
                        <div id="details" class="tab-pane fade in active ib-tab-box">


                            <span class="label label-default inline-block"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Priority'];?>
: <?php echo $_smarty_tpl->tpl_vars['d']->value->urgency;?>
 </span> &nbsp;

                            <span class="label label-default inline-block"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Status'];?>
: <span id="inline_status"><?php echo $_smarty_tpl->tpl_vars['d']->value->status;?>
</span></span>
                            <hr>
                            <p><strong>Customer:</strong> <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['d']->value->userid;?>
"><?php echo $_smarty_tpl->tpl_vars['d']->value->account;?>
</a></p>
                            <hr>

                                                                                                                                                                                                                                                                                                                                                                            

                            <a class="btn btn-primary" href="#" id="add_reply">Add Reply</a>
                            <a class="cdelete btn btn-danger" href="#" id="t<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
"><i class="icon-trash"></i> </a>



                            <hr>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <div class="form-material floating">
                                            <select class="form-control" id="editable_department" name="editable_department" size="1">
                                                <option value="None">None</option>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['departments']->value, 'dep');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['dep']->value) {
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['dep']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['department']->value == $_smarty_tpl->tpl_vars['dep']->value['dname']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['dep']->value['dname'];?>
</option>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ads']->value, 'ad');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ad']->value) {
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['ad']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['d']->value->aid == $_smarty_tpl->tpl_vars['ad']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['ad']->value['fullname'];?>
</option>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
                                                <option value="Open" <?php if ($_smarty_tpl->tpl_vars['d']->value->status == 'Open') {?> selected<?php }?>>Open</option>
                                                <option value="On Hold" <?php if ($_smarty_tpl->tpl_vars['d']->value->status == 'On Hold') {?> selected<?php }?>>On Hold</option>
                                                <option value="Escalated" <?php if ($_smarty_tpl->tpl_vars['d']->value->status == 'Escalated') {?> selected<?php }?>>Escalated</option>
                                                <option value="Closed" <?php if ($_smarty_tpl->tpl_vars['d']->value->status == 'Closed') {?> selected<?php }?>>Closed</option>

                                            </select>
                                            <label for="editable_status">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <input class="form-control" type="text" id="editable_email" name="editable_email" value="<?php echo $_smarty_tpl->tpl_vars['d']->value->email;?>
">
                                        <label for="editable_cc">Email</label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <input class="form-control" type="text" id="editable_cc" name="editable_cc" value="<?php echo $_smarty_tpl->tpl_vars['d']->value->cc;?>
">
                                        <label for="editable_cc">CC</label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <input class="form-control" type="text" id="editable_bcc" name="editable_bcc" value="<?php echo $_smarty_tpl->tpl_vars['d']->value->bcc;?>
">
                                        <label for="editable_bcc">BCC</label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <input class="form-control" type="text" id="editable_phone" name="editable_phone" value="<?php if ($_smarty_tpl->tpl_vars['c']->value) {
echo $_smarty_tpl->tpl_vars['c']->value->phone;
}?>">
                                        <label for="editable_phone">Phone</label>
                                    </div>
                                </div>
                            </div>



                            <input type="hidden" name="tid" id="tid" value="<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
">



                            <div class="row">
                                <div class="col-xs-12">
                                    <form>

                                        <hr>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Note</label>
                                            <textarea class="form-control" name="notes" id="notes" rows="3"
                                                      placeholder="Add Note..."><?php echo $_smarty_tpl->tpl_vars['d']->value->notes;?>
</textarea>
                                        </div>

                                        <button type="submit" id="btn_save_note" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Save'];?>
</button>

                                    </form>
                                </div>
                            </div>


                            <hr>

                            <h4>Previous Conversations</h4>

                            <table class="table table-hover">

                                <tbody>

                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['o_tickets']->value, 'o_ticket');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['o_ticket']->value) {
?>

                                    <?php if ($_smarty_tpl->tpl_vars['o_ticket']->value['id'] == $_smarty_tpl->tpl_vars['d']->value->id) {?>
                                        <?php continue 1;?>
                                    <?php }?>

                                    <tr>
                                        <td>
                                            <em class="mmnt"><?php echo strtotime($_smarty_tpl->tpl_vars['o_ticket']->value['created_at']);?>
</em>
                                            <br>
                                            <p><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
tickets/admin/view/<?php echo $_smarty_tpl->tpl_vars['o_ticket']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['o_ticket']->value['subject'];?>
</a></p>
                                            <span class="label label-default inline-block"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Status'];?>
: <?php echo $_smarty_tpl->tpl_vars['d']->value->status;?>
 </span> &nbsp;
                                            <span class="label label-default inline-block"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Priority'];?>
: <?php echo $_smarty_tpl->tpl_vars['d']->value->urgency;?>
 </span> &nbsp;

                                        </td>
                                    </tr>

                                    <?php
}
} else {
?>
                                    <tr>
                                        <td>

                                            No Data Available

                                        </td>
                                    </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                                                                                                                                                                
                                                                
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
                    <?php echo strtotime($_smarty_tpl->tpl_vars['d']->value->created_at);?>

                  </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            

                            <?php if ($_smarty_tpl->tpl_vars['d']->value->admin != '0') {?>
                                <?php if ($_smarty_tpl->tpl_vars['user']->value['img'] == 'gravatar') {?>
                                    <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['user']->value['email']));?>
?s=30"
                                         class="img-time-line" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                                <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['img'] == '') {?>
                                    <img class="img-time-line" src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/imgs/default-user-avatar.png" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['user']->value['img'];?>
" class="img-time-line" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['account'];?>
">
                                <?php }?>

                            <?php } elseif (($_smarty_tpl->tpl_vars['c']->value)) {?>

                                <?php if ($_smarty_tpl->tpl_vars['c']->value->img == 'gravatar') {?>
                                    <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['user']->value['email']));?>
?s=30"
                                         class="img-time-line" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                                <?php } elseif ($_smarty_tpl->tpl_vars['c']->value->img == '') {?>
                                    <img class="img-time-line" src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/imgs/default-user-avatar.png" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['c']->value->img;?>
" class="img-time-line" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['account'];?>
">
                                <?php }?>

                            <?php } else { ?>



                            <?php }?>


                            <div class="timeline-item">
                                

                                <h3 class="timeline-header"><a href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['d']->value->account;?>
</a></h3>

                                <div class="timeline-body">
                                    <?php echo $_smarty_tpl->tpl_vars['d']->value->message;?>

                                    <hr>

                                    <a href="#" class="btn btn-warning btn-xs t_edit" data-toggle="tooltip"
                                       data-placement="top" title="" data-original-title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
" id="et<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
"><i
                                                class="glyphicon glyphicon-pencil"></i> </a>
                                </div>

                                <?php if (($_smarty_tpl->tpl_vars['d']->value->attachments) != '') {?>
                                    <div class="timeline-footer">
                                        <?php echo Tickets::gen_link_attachments($_smarty_tpl->tpl_vars['d']->value->attachments);?>

                                    </div>
                                <?php }?>


                            </div>
                        </li>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['replies']->value, 'reply');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['reply']->value) {
?>
                            <li class="time-label">
                  <span class="mmnt">
                    <?php echo strtotime($_smarty_tpl->tpl_vars['reply']->value['created_at']);?>

                  </span>
                            </li>
                            <li>
                                

                                <?php if ($_smarty_tpl->tpl_vars['reply']->value['admin'] != '0') {?>
                                    <img src="<?php echo getAdminImage($_smarty_tpl->tpl_vars['reply']->value['admin'],30);?>
" class="img-time-line">
                                <?php } elseif (($_smarty_tpl->tpl_vars['c']->value)) {?>

                                    <?php if ($_smarty_tpl->tpl_vars['c']->value->img == '') {?>
                                        <img class="img-time-line" src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/imgs/default-user-avatar.png"
                                             alt="">
                                    <?php } else { ?>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['c']->value->img;?>
" class="img-time-line" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['account'];?>
">
                                    <?php }?>

                                <?php } else { ?>



                                <?php }?>

                                <div class="timeline-item">
                                    
                                    <h3 class="timeline-header"><a href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['reply']->value['replied_by'];?>
</a></h3>

                                    <div class="timeline-body" <?php if ($_smarty_tpl->tpl_vars['reply']->value['reply_type'] == 'internal') {?> style="background: #FFF6D9;" <?php }?>>
                                        <?php echo $_smarty_tpl->tpl_vars['reply']->value['message'];?>


                                        <hr>

                                        <a href="#" class="btn btn-warning btn-xs no-shadow reply_edit"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
" id="er<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];?>
"><i
                                                    class="glyphicon glyphicon-pencil"></i> </a> &nbsp;
                                        <a href="#" class="btn btn-danger btn-xs no-shadow reply_delete"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
" id="dr<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];?>
"><i
                                                    class="glyphicon glyphicon-trash"></i> </a> &nbsp;

                                        <?php if ($_smarty_tpl->tpl_vars['reply']->value['reply_type'] == 'internal') {?> <a href="#" class="btn btn-primary btn-xs no-shadow reply_make_public"
                                                                                   data-toggle="tooltip" data-placement="top" title=""
                                                                                   data-original-title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Public'];?>
" id="rp<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];?>
"><i
                                                    class="fa fa-globe"></i> </a> <?php }?>

                                    </div>

                                    <?php if (($_smarty_tpl->tpl_vars['reply']->value['attachments']) != '') {?>
                                        <div class="timeline-footer">
                                            <?php echo Tickets::gen_link_attachments($_smarty_tpl->tpl_vars['reply']->value['attachments']);?>

                                        </div>
                                    <?php }?>


                                </div>
                            </li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li class="time-label">
                  <span class="bg-green" id="section_add_reply">
                   Add Reply
                  </span>
                        </li>
                        <li>
                            <?php if ($_smarty_tpl->tpl_vars['user']->value['img'] == '') {?>
                                <img class="img-time-line" src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/imgs/default-user-avatar.png" alt="">
                            <?php } else { ?>
                                <img src="<?php echo $_smarty_tpl->tpl_vars['user']->value['img'];?>
" class="img-time-line" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['account'];?>
">
                            <?php }?>

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

                                                                                                                                                                                                                                                                                                                                                                                                                

                                        <div class="form-group">
                                            <div class="col-xs-12">

                                                <input type="hidden" name="attachments" id="attachments" value="">
                                                <input type="hidden" name="f_tid" id="f_tid" value="<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
">
                                                <input type="hidden" name="cid" id="cid" value="<?php echo $_smarty_tpl->tpl_vars['d']->value->userid;?>
">

                                                <button class="btn btn-primary" id="ib_form_submit" type="submit"><i
                                                            class="fa fa-send push-5-r"></i> Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

<?php
}
}
/* {/block "content"} */
}
