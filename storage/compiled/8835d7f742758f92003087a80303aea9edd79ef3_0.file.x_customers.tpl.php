<?php
/* Smarty version 3.1.32, created on 2018-07-23 05:09:57
  from '/Users/razib/Documents/valet/stackb/apps/woocommerce/views/x_customers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b559b65014e12_42827844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8835d7f742758f92003087a80303aea9edd79ef3' => 
    array (
      0 => '/Users/razib/Documents/valet/stackb/apps/woocommerce/views/x_customers.tpl',
      1 => 1532336993,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b559b65014e12_42827844 (Smarty_Internal_Template $_smarty_tpl) {
?><form class="form-horizontal" method="post" action="">
    <div class="form-group">
        <div class="col-md-12">
            <div class="input-group">
                <div class="input-group-addon">
                    <span class="fa fa-search"></span>
                </div>
                <input type="text" name="name" id="foo_filter" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Search'];?>
..."/>

            </div>
        </div>

    </div>
</form>

<table class="table table-bordered table-hover sys_table footable" data-filter="#foo_filter" data-page-size="50">
    <thead>
    <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Email</th>
        <th>
            Total Spent
        </th>
        <th>Created at</th>
        <th class="text-right" width="120px;"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
</th>
    </tr>
    </thead>
    <tbody>

    <?php if ($_smarty_tpl->tpl_vars['customers']->value) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customers']->value, 'customer');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->value) {
?>
            <tr>
                <td  data-value="<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
"> <?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
 </td>
                <td> <?php echo $_smarty_tpl->tpl_vars['customer']->value->first_name;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->last_name;?>
 </td>
                <td> <?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
 </td>
                <td class="amount" data-a-sign="<?php echo $_smarty_tpl->tpl_vars['config']->value['currency_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value->total_spent;?>
</td>
                <td data-value="<?php echo strtotime($_smarty_tpl->tpl_vars['customer']->value->date_created);?>
"><?php echo date($_smarty_tpl->tpl_vars['config']->value['df'],strtotime($_smarty_tpl->tpl_vars['customer']->value->date_created));?>
</td>

                <td class="text-right">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
woocommerce/app/view-customer/<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
" class="btn btn-primary">View customer</a>
                </td>
            </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>

    </tbody>

    <tfoot>
    <tr>
        <td colspan="8">
            <ul class="pagination">
            </ul>
        </td>
    </tr>
    </tfoot>

</table><?php }
}
