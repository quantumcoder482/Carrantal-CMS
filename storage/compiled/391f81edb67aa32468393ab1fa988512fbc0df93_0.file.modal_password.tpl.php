<?php
/* Smarty version 3.1.32, created on 2018-05-28 11:10:08
  from '/Users/razib/Dropbox/valet/stackb/ui/theme/default/modal_password.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b0c1bd0226023_33290659',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '391f81edb67aa32468393ab1fa988512fbc0df93' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/ui/theme/default/modal_password.tpl',
      1 => 1512859487,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b0c1bd0226023_33290659 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="txt_modal_header">
        <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                        <?php echo $_smarty_tpl->tpl_vars['password']->value['name'];?>

        <?php } else { ?>
            <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add New'];?>

        <?php }?>
    </h3>
</div>
<div class="modal-body">


    <form id="spForm" method="post">



       <div class="row">
           <div class="col-md-6">
               <div class="form-group">
                   <label for="inputName"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Name'];?>
</label>
                   <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $_smarty_tpl->tpl_vars['password']->value['name'];?>
">
               </div>
           </div>
           <div class="col-md-6">
               <div class='form-group'>
                   <label for="inputClientId"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Customer'];?>
</label>

                   <select id="inputClientId" name="client_id" class="form-control s2_contacts">
                       <option value="0"><?php echo $_smarty_tpl->tpl_vars['_L']->value['None'];?>
</option>
                       <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['c']->value, 'cs');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cs']->value) {
?>
                           <option value="<?php echo $_smarty_tpl->tpl_vars['cs']->value['id'];?>
"
                                   <?php if ($_smarty_tpl->tpl_vars['password']->value['client_id'] == ($_smarty_tpl->tpl_vars['cs']->value['id'])) {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['cs']->value['account'];?>
 <?php if ($_smarty_tpl->tpl_vars['cs']->value['email'] != '') {?>- <?php echo $_smarty_tpl->tpl_vars['cs']->value['email'];
}?></option>
                       <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                   </select>

               </div>
           </div>
       </div>

        <div class="form-group">
            <label for="inputUrl"><?php echo $_smarty_tpl->tpl_vars['_L']->value['URL'];?>
</label>
            <input type="text" class="form-control" id="inputUrl" name="url" value="<?php echo $_smarty_tpl->tpl_vars['password']->value['url'];?>
">
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputUsername"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Username'];?>
</label>
                    <input type="text" class="form-control" id="inputUsername" name="username" value="<?php echo $_smarty_tpl->tpl_vars['password']->value['username'];?>
">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputPassword"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Password'];?>
</label>
                    <input type="text" class="form-control" id="inputPassword" name="password" value="<?php echo $_smarty_tpl->tpl_vars['password']->value['password'];?>
">
                </div>
            </div>
        </div>





        <div class="form-group">
            <label for="inputNotes"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Notes'];?>
</label>
            <textarea class="form-control" id="inputNotes" name="description" rows="5"><?php echo $_smarty_tpl->tpl_vars['password']->value['notes'];?>
</textarea>
        </div>


        <input type="hidden" id="password_id" name="password_id" value="<?php echo $_smarty_tpl->tpl_vars['password']->value['id'];?>
">
    </form>

</div>
<div class="modal-footer">


    <button type="button" data-dismiss="modal" class="btn btn-danger"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Cancel'];?>
</button>
    <button class="btn btn-primary modal_submit" type="submit" id="modal_submit"><i
                class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Save'];?>
</button>
</div><?php }
}
