<?php
/* Smarty version 3.1.32, created on 2018-06-15 11:34:48
  from '/Users/razib/Dropbox/valet/stackb/apps/notes/views/add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b23dc9888a269_66045095',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a182938a6a30c4617990b851efb0272a2b8fd63c' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/apps/notes/views/add.tpl',
      1 => 1529076790,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b23dc9888a269_66045095 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6981868665b23dc98886ac9_12304508', "content");
}
/* {block "content"} */
class Block_6981868665b23dc98886ac9_12304508 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_6981868665b23dc98886ac9_12304508',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">

                    <h3>Add Note</h3>

                    <hr>

                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
notes/app/save">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" name="title" id="title">
                        </div>

                        <div class="form-group">
                            <label for="contents">Contents</label>
                            <textarea class="form-control" rows="10" id="contents" name="contents"></textarea>
                        </div>

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
