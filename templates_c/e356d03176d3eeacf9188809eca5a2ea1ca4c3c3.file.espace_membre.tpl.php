<?php /* Smarty version Smarty 3.1.4, created on 2011-10-27 17:59:06
         compiled from ".\templates\modele\espace_membre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139064ea99beacf7476-79744607%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e356d03176d3eeacf9188809eca5a2ea1ca4c3c3' => 
    array (
      0 => '.\\templates\\modele\\espace_membre.tpl',
      1 => 1319734013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139064ea99beacf7476-79744607',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'connecte' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_4ea99beae31c5',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea99beae31c5')) {function content_4ea99beae31c5($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['connecte']->value){?>
	<span class="etat_connecte">
		<?php echo $_SESSION['pseudo'];?>

					
		<?php if ($_SESSION['admin']){?>
			<a href="index.php?admin=ACCUEIL">Administrer</a>
		<?php }?>
		
		<a href="index.php?action=DECONNECTION">Deconnection</a>
	</span>
<?php }else{ ?>
	<span class="etat-non-connecte">
		Vous n'êtes pas connecté, veuillez vous <a href="index.php?page=CONNECTION">Connecter</a>
		ou vous <a href="index.php?page=INSCRIPTION">Inscrire !</a>
	</span>		
<?php }?>
<?php }} ?>