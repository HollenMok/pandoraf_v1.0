<?php /* Smarty version 3.1.27, created on 2015-07-06 04:37:20
         compiled from "E:\wamp\www\pandoraPHP\pandoraPHP\pandoraf_v1.0\applications\pandoraf\templates\view\display\index.html" */ ?>
<?php
/*%%SmartyHeaderCode:3397559a06001284c3_07270334%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54aae2635b1eef41198ae090c091c52566bf53fe' => 
    array (
      0 => 'E:\\wamp\\www\\pandoraPHP\\pandoraPHP\\pandoraf_v1.0\\applications\\pandoraf\\templates\\view\\display\\index.html',
      1 => 1436157435,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3397559a06001284c3_07270334',
  'variables' => 
  array (
    'LA_EMAIL' => 0,
    'email' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_559a0600169d58_18907144',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_559a0600169d58_18907144')) {
function content_559a0600169d58_18907144 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3397559a06001284c3_07270334';
?>

<?php echo $_smarty_tpl->tpl_vars['LA_EMAIL']->value;
echo $_smarty_tpl->tpl_vars['email']->value;

}
}
?>