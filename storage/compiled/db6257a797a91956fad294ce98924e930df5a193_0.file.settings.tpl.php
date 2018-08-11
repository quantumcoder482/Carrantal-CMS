<?php
/* Smarty version 3.1.32, created on 2018-07-22 18:56:21
  from '/Users/razib/Documents/valet/stackb/apps/woocommerce/views/settings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b550b95cae903_55455403',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db6257a797a91956fad294ce98924e930df5a193' => 
    array (
      0 => '/Users/razib/Documents/valet/stackb/apps/woocommerce/views/settings.tpl',
      1 => 1532299571,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b550b95cae903_55455403 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13778678385b550b95ca3891_84626755', "content");
}
/* {block "content"} */
class Block_13778678385b550b95ca3891_84626755 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_13778678385b550b95ca3891_84626755',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Users/razib/Documents/valet/stackb/vendor/smarty/smarty/libs/plugins/function.counter.php','function'=>'smarty_function_counter',),));
?>



    <div class="row">

        <div class="col-md-3 ib_profile_width">
            <?php echo $_smarty_tpl->tpl_vars['menu']->value;?>

        </div>

        <div class="col-md-9">


            <div class="ibox float-e-margins animated fadeIn">
                <div class="ibox-title">
                    <h3>Settings</h3>
                </div>
                <div class="ibox-content">

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-md-6"><h4>Your Stores</h4></div>
                        <div class="col-md-6">
                            <a class="btn btn-primary pull-right" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
woocommerce/app/add-store">Add New Store</a>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">URL</th>
                            <th scope="col">Key</th>
                            <th scope="col">Manage</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if ($_smarty_tpl->tpl_vars['integrations_count']->value > 0) {?>

                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['integrations']->value, 'integration');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['integration']->value) {
?>
                                <tr>
                                    <th scope="row"><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
</th>
                                    <td><?php echo $_smarty_tpl->tpl_vars['integration']->value->name;?>
</td>
                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['integration']->value->url;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['integration']->value->url;?>
</a> </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['integration']->value->key;?>
</td>
                                    <td>
                                        <?php if (!$_smarty_tpl->tpl_vars['integration']->value->is_default) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
woocommerce/app/make-default-integration/<?php echo $_smarty_tpl->tpl_vars['integration']->value->id;?>
" class="btn btn-success">Make Default</a>
                                        <?php }?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
woocommerce/app/edit-integration/<?php echo $_smarty_tpl->tpl_vars['integration']->value->id;?>
" class="btn btn-primary">Edit</a>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
woocommerce/app/delete-integration/<?php echo $_smarty_tpl->tpl_vars['integration']->value->id;?>
" class="btn btn-danger">Delete</a>

                                    </td>
                                </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                            <?php } else { ?>

                            <tr>
                                <td colspan="6" class="text-center">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
woocommerce/app/add-store">You didn't add any Store, Click here to add one</a>
                                </td>
                            </tr>

                        <?php }?>

                        </tbody>
                    </table>

                </div>
            </div>



        </div>

    </div>
<?php
}
}
/* {/block "content"} */
}
