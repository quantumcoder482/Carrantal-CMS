<?php
/* Smarty version 3.1.32, created on 2018-05-28 09:47:02
  from '/Users/razib/Dropbox/valet/stackb/ui/theme/default/transfer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b0c0856efbd25_42252197',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b6186c091cd0e5a5cb21c9a062db7f7e5d6cd99' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/ui/theme/default/transfer.tpl',
      1 => 1510617082,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b0c0856efbd25_42252197 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10813321505b0c0856ee7970_99908856', "content");
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14900964695b0c0856efa130_97248192', "script");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['layouts_admin']->value));
}
/* {block "content"} */
class Block_10813321505b0c0856ee7970_99908856 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_10813321505b0c0856ee7970_99908856',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="row">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['New Transfer'];?>
</h5>

                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>
                    <form class="form-horizontal" method="post" id="tform" role="form">
                        <div class="form-group">
                            <label for="faccount" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['From'];?>
</label>
                            <div class="col-sm-9">
                                <select id="faccount" name="faccount" class="form-control">
                                    <option value=""><?php echo $_smarty_tpl->tpl_vars['_L']->value['Choose an Account'];?>
</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
"><?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="taccount" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['To'];?>
</label>
                            <div class="col-sm-9">
                                <select id="taccount" name="taccount" class="form-control">
                                    <option value=""><?php echo $_smarty_tpl->tpl_vars['_L']->value['Choose an Account'];?>
</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
"><?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  value="<?php echo $_smarty_tpl->tpl_vars['mdate']->value;?>
" name="date" id="date" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control amount" id="amount" name="amount">
                            </div>
                        </div>


                        

                        <?php if ($_smarty_tpl->tpl_vars['config']->value['edition'] == 'iqm') {?>

                            <h4 style="border-bottom: 1px solid #eee; padding-bottom: 8px;">Paid As</h4>



                            <div class="form-group">
                                <label for="c1_amount" class="col-sm-3 control-label">$</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="c1_amount" name="c1_amount">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="c2_amount" class="col-sm-3 control-label">IQD</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="c2_amount" name="c2_amount">
                                </div>
                            </div>

                            <hr>

                        <?php }?>

                        <div class="form-group">
                            <label for="tags" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Tags'];?>
</label>
                            <div class="col-sm-9">
                                <select name="tags[]" id="tags"  class="form-control" multiple="multiple">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tags']->value, 'tag');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['tag']->value['text'];?>
"><?php echo $_smarty_tpl->tpl_vars['tag']->value['text'];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                &nbsp;
                            </div>
                            <div class="col-sm-9">
                                <h4><a href="#" id="a_toggle"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Advanced'];?>
</a> </h4>
                            </div>
                        </div>
                        <div id="a_hide">

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Method'];?>
</label>
                                <div class="col-sm-9">
                                    <select id="pmethod" name="pmethod" class="form-control">
                                        <option value=""><?php echo $_smarty_tpl->tpl_vars['_L']->value['Select Payment Method'];?>
</option>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pms']->value, 'pm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pm']->value) {
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['pm']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['pm']->value['name'];?>
</option>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ref" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Ref'];?>
</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ref" name="ref">
                                    <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['_L']->value['ref_example'];?>
</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Submit'];?>
</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Recent Transfers'];?>
</h5>

                </div>
                <div class="ibox-content">

                    <table class="table table-bordered sys_table">
                        <thead>
                        <tr>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tr']->value, 'trs');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['trs']->value) {
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['trs']->value['account'];?>
</td>
                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/manage/<?php echo $_smarty_tpl->tpl_vars['trs']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['trs']->value['description'];?>
</a> </td>
                                <td class="amount"><?php echo $_smarty_tpl->tpl_vars['trs']->value['amount'];?>
</td>
                            </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

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
/* {block "script"} */
class Block_14900964695b0c0856efa130_97248192 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_14900964695b0c0856efa130_97248192',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>
        $(function () {

            var $amount = $("#amount");

            <?php if ($_smarty_tpl->tpl_vars['config']->value['edition'] == 'iqm') {?>


            var c2_amount = $("#c2_amount");

            var c1_amount = $("#c1_amount");

            var c_rate = <?php echo $_smarty_tpl->tpl_vars['currency_rate']->value;?>
;


            function total_c() {

//                var total_amount_c1 = isNaN(parseInt(c1_amount.val())) ? 0 :(c1_amount.val());
//
//                total_amount_c1 = parseFloat(total_amount_c1);
//
//                var total_amount_c2 = isNaN(parseInt(c2_amount.val()/ c_rate)) ? 0 :(c2_amount.val()/ c_rate);
//
//                total_amount_c2 = parseFloat(total_amount_c2);
//
//                var total_amount_c = total_amount_c1 + total_amount_c2;
//
//                $amount.val(total_amount_c);



                if($amount.val() == ''){
                    var total_amount_c1 = isNaN(parseInt(c1_amount.val())) ? 0 :(c1_amount.val());

                    total_amount_c1 = parseFloat(total_amount_c1);

                    var total_amount_c2 = isNaN(parseInt(c2_amount.val()/ c_rate)) ? 0 :(c2_amount.val()/ c_rate);

                    total_amount_c2 = parseFloat(total_amount_c2);

                    var total_amount_c = total_amount_c1 + total_amount_c2;

                    $amount.val(total_amount_c);
                }
                else{
                    var total_amount_c1 = isNaN(parseInt(c1_amount.val())) ? 0 :(c1_amount.val());


                    total_amount_c1 = parseFloat(total_amount_c1);

                    //  console.log(total_amount_c1);
                    var tr_amount = $amount.val();
                    tr_amount = tr_amount.replace("$ ","");
                    tr_amount = tr_amount.replace(" ","");
                    tr_amount = tr_amount.replace(",","");
                    tr_amount = parseFloat(tr_amount);
                    //  console.log(tr_amount);
                    var rest_amount = tr_amount - total_amount_c1;
                    var rest_amount_in_iqd = rest_amount*c_rate;


                    //  console.log(c_rate);
                    //   console.log(rest_amount);


                    // console.log(rest_amount_in_iqd);
                    c2_amount.val(rest_amount_in_iqd);
                }
            }

            c2_amount.keyup(function(){

                total_c();


            });


            c1_amount.keyup(function(){

                total_c();


            });



            <?php }?>
        });
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block "script"} */
}
