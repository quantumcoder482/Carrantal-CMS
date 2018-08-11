<?php
/* Smarty version 3.1.32, created on 2018-05-28 11:05:17
  from '/Users/razib/Dropbox/valet/stackb/ui/theme/default/kb_client_view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b0c1aad4f3696_44819436',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a2608d8abae0b7ee79cac20c0ae1391baad7b88' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/ui/theme/default/kb_client_view.tpl',
      1 => 1527519915,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b0c1aad4f3696_44819436 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19983336955b0c1aad4f0783_21255950', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['layouts_client']->value));
}
/* {block "content"} */
class Block_19983336955b0c1aad4f0783_21255950 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_19983336955b0c1aad4f0783_21255950',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-12">


            <div class="panel panel-default">
                <div class="panel-body">

                    <h3><?php echo $_smarty_tpl->tpl_vars['article']->value->title;?>
</h3>
                    <em><?php echo $_smarty_tpl->tpl_vars['adm']->value->fullname;?>
</em> <?php if ($_smarty_tpl->tpl_vars['article']->value->updated_at != '') {?> | <em>Last update: <?php echo $_smarty_tpl->tpl_vars['article']->value->updated_at->diffForHumans();?>
</em> <?php }?>
                    <hr>

                    <?php echo $_smarty_tpl->tpl_vars['article']->value->description;?>


                </div>
            </div>


        </div>
    </div>

<?php
}
}
/* {/block "content"} */
}
