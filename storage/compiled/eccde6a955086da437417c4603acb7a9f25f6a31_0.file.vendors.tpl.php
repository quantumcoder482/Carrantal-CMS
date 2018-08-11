<?php
/* Smarty version 3.1.32, created on 2018-07-10 09:05:01
  from '/Users/razib/Documents/valet/stackb/apps/bluesnap/views/vendors.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b44aefd47d9c4_98905401',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eccde6a955086da437417c4603acb7a9f25f6a31' => 
    array (
      0 => '/Users/razib/Documents/valet/stackb/apps/bluesnap/views/vendors.tpl',
      1 => 1531227892,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b44aefd47d9c4_98905401 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14644874805b44aefd478c96_46421613', "content");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_536637985b44aefd47ceb6_47539474', "script");
}
/* {block "content"} */
class Block_14644874805b44aefd478c96_46421613 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_14644874805b44aefd478c96_46421613',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



    <div class="row">

        <div class="col-md-3 ib_profile_width">
            <?php echo $_smarty_tpl->tpl_vars['menu']->value;?>

        </div>

        <div class="col-md-9">


            <div class="ibox float-e-margins animated fadeIn">
                <div class="ibox-title">
                    <h5>Vendors</h5>
                </div>
                <div class="ibox-content">

                    <div class="text-center" id="loader_balance">
                        <div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="32" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div>
                    </div>

                    <div id="load_balance">

                    </div>



                </div>
            </div>



        </div>

    </div>
<?php
}
}
/* {/block "content"} */
/* {block "script"} */
class Block_536637985b44aefd47ceb6_47539474 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_536637985b44aefd47ceb6_47539474',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php echo '<script'; ?>
>
        $(function () {

        })
    <?php echo '</script'; ?>
>

<?php
}
}
/* {/block "script"} */
}
