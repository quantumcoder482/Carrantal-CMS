<?php
/* Smarty version 3.1.32, created on 2018-06-15 11:20:13
  from '/Users/razib/Dropbox/valet/stackb/ui/theme/default/app_wrapper.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b23d92defb9c9_42586762',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2cfbf79cdc7d3082fae1ef840bd334acba1254a6' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/ui/theme/default/app_wrapper.tpl',
      1 => 1514456083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../../../".((string)$_smarty_tpl->tpl_vars[\'plugin_directory\']->value)."/views/".((string)$_smarty_tpl->tpl_vars[\'_include\']->value).".tpl' => 1,
  ),
),false)) {
function content_5b23d92defb9c9_42586762 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php $_smarty_tpl->_subTemplateRender("file:../../../".((string)$_smarty_tpl->tpl_vars['plugin_directory']->value)."/views/".((string)$_smarty_tpl->tpl_vars['_include']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
$_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['layouts_admin']->value));
}
}
