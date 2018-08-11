<?php
/* Smarty version 3.1.32, created on 2018-07-11 12:12:13
  from '/Users/razib/Documents/valet/stackb/ui/theme/default/handler_bulk_email.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b462c5df188f6_29564608',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a19c34e4fdb93d683567af34324ec6ed210f1e0c' => 
    array (
      0 => '/Users/razib/Documents/valet/stackb/ui/theme/default/handler_bulk_email.tpl',
      1 => 1506420890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b462c5df188f6_29564608 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17421385765b462c5df10369_42000776', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['layouts_admin']->value));
}
/* {block "content"} */
class Block_17421385765b462c5df10369_42000776 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_17421385765b462c5df10369_42000776',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="mail-box">


                        <div class="mail-body">

                            <form class="form-horizontal" method="get">
                                <div class="form-group"><label class="col-sm-2 control-label" for="toemail"><?php echo $_smarty_tpl->tpl_vars['_L']->value['To'];?>
:</label>

                                    <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" id="emails" name="emails"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contacts']->value, 'contact');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['contact']->value) {
echo $_smarty_tpl->tpl_vars['contact']->value['account'];?>
 <<?php echo $_smarty_tpl->tpl_vars['contact']->value['email'];?>
>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></textarea>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Subject'];?>
:</label>

                                    <div class="col-sm-10"><input type="text" id="subject" name="subject" class="form-control" value=""></div>
                                </div>
                            </form>

                        </div>

                        <div class="mail-text">

                            <textarea id="content"  class="form-control sysedit" name="content"></textarea>

                            <div class="clearfix"></div>
                        </div>
                        <div class="mail-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <a href="#" class="choose_from_template" id="choose_from_template"><i class="fa fa-file-text"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Choose from Template'];?>
</a>
                                </div>
                                <div class="col-md-2 text-right">
                                    <button type="submit" id="send_email"  class="btn btn-sm btn-primary"><i class="fa fa-paper-plane-o"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Send'];?>
</button>
                                </div>
                            </div>
                                                    </div>
                        <div class="clearfix"></div>



                    </div>

                </div>

            </div>

        </div>

    </div>
<?php
}
}
/* {/block "content"} */
}
