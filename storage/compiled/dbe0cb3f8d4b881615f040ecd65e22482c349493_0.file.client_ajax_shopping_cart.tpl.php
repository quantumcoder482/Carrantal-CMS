<?php
/* Smarty version 3.1.32, created on 2018-06-21 08:00:27
  from '/Users/razib/Documents/valet/stackb/ui/theme/default/client_ajax_shopping_cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b2b935b076019_60179222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dbe0cb3f8d4b881615f040ecd65e22482c349493' => 
    array (
      0 => '/Users/razib/Documents/valet/stackb/ui/theme/default/client_ajax_shopping_cart.tpl',
      1 => 1514722363,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b2b935b076019_60179222 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="top-cart-content">
    <div class="top-cart-title">
        <h4>Shopping Cart</h4>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['cart']->value && $_smarty_tpl->tpl_vars['cart']->value->item_count > 0) {?>

    <div class="top-cart-items">



        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>

            <div class="top-cart-item clearfix">
                <div class="top-cart-item-image">
                    <a href="#"><img src="<?php echo Cart::getItemImage($_smarty_tpl->tpl_vars['item']->value['id']);?>
" alt="Blue Shoulder Bag"></a>
                </div>
                <div class="top-cart-item-desc">
                    <a href="#" class="t400"><span class="txt_cart_item_name"><?php echo strTrunc($_smarty_tpl->tpl_vars['item']->value['name']);?>
</span></a>
                    <span class="top-cart-item-price"><?php echo ib_money_format($_smarty_tpl->tpl_vars['item']->value['price'],$_smarty_tpl->tpl_vars['config']->value);?>
 [Total: <?php echo ib_money_format($_smarty_tpl->tpl_vars['item']->value['price']*$_smarty_tpl->tpl_vars['item']->value['qty'],$_smarty_tpl->tpl_vars['config']->value);?>
]</span>
                    <span class="top-cart-item-quantity">x <?php echo $_smarty_tpl->tpl_vars['item']->value['qty'];?>
</span>
                </div>
            </div>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


    </div>
    <div class="top-cart-action clearfix" style="padding-bottom: 0;">
        <span class="top-checkout-price t600 font-secondary text-right pull-right" style="color: #333;"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total'];?>
: <?php echo ib_money_format($_smarty_tpl->tpl_vars['cart']->value->total,$_smarty_tpl->tpl_vars['config']->value);?>
</span>





    </div>

        <hr>

        <a class="btn btn-danger text-right" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
cart/clear">Clear</a>
        <a class="btn btn-primary text-right pull-right" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
cart/checkout">Checkout</a>

    <?php } else { ?>

    <p class="text-center" style="margin-top: 20px;">Your Cart is empty.</p>

        <hr>

    <?php }?>

</div><?php }
}
