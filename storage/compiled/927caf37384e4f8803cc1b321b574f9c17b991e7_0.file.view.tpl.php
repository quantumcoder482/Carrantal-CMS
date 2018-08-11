<?php
/* Smarty version 3.1.32, created on 2018-06-15 11:56:28
  from '/Users/razib/Dropbox/valet/stackb/apps/notes/views/view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b23e1ac987917_83200781',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '927caf37384e4f8803cc1b321b574f9c17b991e7' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/apps/notes/views/view.tpl',
      1 => 1529078186,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b23e1ac987917_83200781 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_984201795b23e1ac985f47_27767333', "content");
}
/* {block "content"} */
class Block_984201795b23e1ac985f47_27767333 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_984201795b23e1ac985f47_27767333',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">

                    <h3><?php echo $_smarty_tpl->tpl_vars['note']->value->title;?>
</h3>

                    <hr>

                    <?php echo $_smarty_tpl->tpl_vars['note']->value->contents;?>


                    <hr>

                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
notes/app/list" class="btn btn-primary">Back to the List</a>


                </div>
            </div>
        </div>



    </div>



<?php
}
}
/* {/block "content"} */
}
