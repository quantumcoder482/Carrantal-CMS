<?php
/* Smarty version 3.1.32, created on 2018-06-21 08:00:29
  from '/Users/razib/Documents/valet/stackb/ui/theme/default/client_modal_view_item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b2b935db5c074_03419669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd976f9f98bb348d170569b64343aedbd39546ee' => 
    array (
      0 => '/Users/razib/Documents/valet/stackb/ui/theme/default/client_modal_view_item.tpl',
      1 => 1509647862,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b2b935db5c074_03419669 (Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        <?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>

    </h3>
</div>
<div class="modal-body">



    <div class="row">
        <div class="col-lg-4">
            <div class="cui-ecommerce--catalog--item">
                <div class="cui-ecommerce--catalog--item--img">
                    <div class="cui-ecommerce--catalog--item--like cui-ecommerce--catalog--item--like__selected">
                        <i class="icmn-heart3 cui-ecommerce--catalog--item--like--liked"><!-- --></i>
                        <i class="icmn-heart4 cui-ecommerce--catalog--item--like--unliked"><!-- --></i>
                    </div>
                    <a href="javascript: void(0);">
                        <?php if ($_smarty_tpl->tpl_vars['item']->value->image != '') {?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
storage/items/<?php echo $_smarty_tpl->tpl_vars['item']->value->image;?>
" class="img-responsive">
                        <?php } else { ?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
ui/lib/imgs/item_placeholder.png">
                        <?php }?>
                    </a>


                </div>
            </div>

        </div>
        <div class="col-lg-8">

            <h3><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</h3>
            <h4><?php echo ib_money_format($_smarty_tpl->tpl_vars['item']->value->sales_price,$_smarty_tpl->tpl_vars['config']->value);?>
</h4>

            <hr>
            <div class="cui-ecommerce--product--descr">
                <?php echo $_smarty_tpl->tpl_vars['item']->value->description;?>

            </div>
            <hr>


            <form class="form-inline" id="form_add_to_cart">
                <div class="form-group">

                    <input type="number" class="form-control" id="form_item_quantity" name="form_item_quantity" placeholder="Quantity" value="1">
                    <input type="hidden" id="form_item_id" name="form_item_id" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">

                </div>
                <button type="submit" class="btn btn-primary add_to_cart"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
            </form>

        </div>
    </div>




</div>
<div class="modal-footer">



    <button type="button" data-dismiss="modal" class="btn btn-danger"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Cancel'];?>
</button>
    </div><?php }
}
