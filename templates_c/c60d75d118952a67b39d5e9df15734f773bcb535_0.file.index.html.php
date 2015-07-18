<?php /* Smarty version 3.1.27, created on 2015-07-12 20:32:34
         compiled from "D:\wamp\www\pandoraPHP\pandoraf_v1.0\applications\pandoraf\templates\view\display\index.html" */ ?>
<?php
/*%%SmartyHeaderCode:3267555a2cee2c41d44_96177387%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c60d75d118952a67b39d5e9df15734f773bcb535' => 
    array (
      0 => 'D:\\wamp\\www\\pandoraPHP\\pandoraf_v1.0\\applications\\pandoraf\\templates\\view\\display\\index.html',
      1 => 1436733152,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3267555a2cee2c41d44_96177387',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55a2cee2c77547_03691543',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a2cee2c77547_03691543')) {
function content_55a2cee2c77547_03691543 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3267555a2cee2c41d44_96177387';
?>
<html>
<head>
<link href="/applications/pandoraf/templates/view/css/style.css" type="text/css" rel="stylesheet"/>
<?php echo '<script'; ?>
 type="text/javascript" src="/applications/pandoraf/templates/view/js/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/applications/pandoraf/templates/view/js/account.js"><?php echo '</script'; ?>
>
<title>pandoraf</title>
</head>
<body>
Email:<input type="text" id="email" class="color"/>
<br/>
Password:<input type="password" id="password" class="color"/>
<br/>
<input type="button" value="Sign in" id="signin" class="color"/>
</body>
</html>
<?php }
}
?>