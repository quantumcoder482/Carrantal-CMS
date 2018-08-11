<?php
/* Smarty version 3.1.32, created on 2018-06-15 12:06:07
  from '/Users/razib/Dropbox/valet/stackb/apps/notes/views/edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b23e3ef84ec30_41059311',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1528895b44e106784adc467af3432a4d033bb6d4' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/apps/notes/views/edit.tpl',
      1 => 1529078765,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b23e3ef84ec30_41059311 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3094265955b23e3ef84be38_83746872', "content");
}
/* {block "content"} */
class Block_3094265955b23e3ef84be38_83746872 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_3094265955b23e3ef84be38_83746872',
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

                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
notes/app/save">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" name="title" id="title" value="<?php echo $_smarty_tpl->tpl_vars['note']->value->title;?>
">
                        </div>

                        <div class="form-group">
                            <label for="contents">Contents</label>
                            <textarea class="form-control" rows="10" id="contents" name="contents"><?php echo $_smarty_tpl->tpl_vars['note']->value->contents;?>
</textarea>
                        </div>

                        
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['note']->value->id;?>
">

                        <button class="btn btn-primary" type="submit">Save</button>

                    </form>


                </div>
            </div>
        </div>



    </div>



<?php
}
}
/* {/block "content"} */
}
