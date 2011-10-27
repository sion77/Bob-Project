<?php /* Smarty version Smarty 3.1.4, created on 2011-10-27 17:59:06
         compiled from ".\templates\modele\entete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:242444ea99beaabf4d8-62901103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b23786a0e5c647ca9c67549d853f62c89fc95c0' => 
    array (
      0 => '.\\templates\\modele\\entete.tpl',
      1 => 1319734013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242444ea99beaabf4d8-62901103',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'noDesign' => 0,
    'design' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_4ea99beacc0a6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea99beacc0a6')) {function content_4ea99beacc0a6($_smarty_tpl) {?><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="pragma"		content="no-cache"				   />
<link rel="stylesheet" media="screen" href="style.css" type="text/css"/>

<?php $_smarty_tpl->tpl_vars["noDesign"] = new Smarty_variable(false, null, 0);?>


	<?php $_smarty_tpl->tpl_vars['design'] = new Smarty_variable("special/accueil", null, 0);?>


<?php if (!$_smarty_tpl->tpl_vars['noDesign']->value){?>
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['design']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
		<link rel="stylesheet" media="screen" href="css/<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
.css" type="text/css"/>
	<?php } ?>
<?php }?>

<title>Site - Chez Bob</title>
<?php }} ?>