<?php /* Smarty version Smarty 3.1.4, created on 2011-10-27 17:59:03
         compiled from "templates\admin_membres.tpl" */ ?>
<?php /*%%SmartyHeaderCode:194934ea99be7321ec5-22031246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3d3f2a4ff25a77746c3a5be88b9854ab30dbeea' => 
    array (
      0 => 'templates\\admin_membres.tpl',
      1 => 1319734013,
      2 => 'file',
    ),
    '052881f7f30ed3dac613b15ae7bee0674d848f7e' => 
    array (
      0 => '.\\templates\\modele\\main.tpl',
      1 => 1319734013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '194934ea99be7321ec5-22031246',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'message' => 0,
    'erreur' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_4ea99be7afe2c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea99be7afe2c')) {function content_4ea99be7afe2c($_smarty_tpl) {?><?php echo '<?xml';?> version="1.0" encoding="UTF-8"<?php echo '?>';?>

<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
				
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<?php echo $_smarty_tpl->getSubTemplate ("modele/entete.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</head>
	<body>
		<div id="header">
			<div id="espace_haut">
				<div id="logo">
					<a href="index.php">
						<img src="img/logo.jpg" alt="Chez Bob"/>
					</a>
				</div>
					
				<div id="espace_membre">
					<?php echo $_smarty_tpl->getSubTemplate ("modele/espace_membre.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				</div>
				<div id="espace_recherche">
					<!--	<img src="img/search_icon.jpg" alt="search_icon"/> -->
					<!-- GET pour pouvoir retourner à un résultat de recherche aisément -->
					<form action="index.php?action=RECHERCHE" method="get">
						<input type="text" name="recherche" value="Rechercher" />
						<input type="submit" value="GO" />
					</form>
					<a href="index.php?page=RECHERCHE_AVANCEE" title="Recherche avancée">Recherche avancée</a>
				</div>
			</div>
		</div>
		<div id="body">
			<div id="menu">
				<?php echo $_smarty_tpl->getSubTemplate ("modele/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			</div>							
			<div id="fastbar">
				
			</div>
			<div id="content">
				<?php if ($_smarty_tpl->tpl_vars['message']->value){?>
					<p id="contenu_message">
						<?php if ($_smarty_tpl->tpl_vars['erreur']->value){?>
							<span class="erreur">Erreur : 
						<?php }else{ ?>
							<span class="message">
						<?php }?>
							<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

						</span>
					<p>
				<?php }?>
				
	<h1>Gestion des membres</h1>
	<table>
		<tr>
			<th style="text-align: center;">Id</th>
			<th style="text-align: center;">Pseudo</th>
			<th style="text-align: center;">Actions</th>
		</tr>
		
		<?php  $_smarty_tpl->tpl_vars['membre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['membre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['membres']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['membre']->key => $_smarty_tpl->tpl_vars['membre']->value){
$_smarty_tpl->tpl_vars['membre']->_loop = true;
?>
			<tr>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['membre']->value->getId();?>
</td>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['membre']->value->getPseudo();?>
</td>
				<?php if ($_smarty_tpl->tpl_vars['membre']->value->estAdmin()){?>					
					<td style="text-align: center;">Admin</td>					
				<?php }else{ ?>
					<td style="text-align: left;">
						<ul>
							<li>
								<a href="index.php?admin=MEMBRES&amp;action=PROMO&amp;id=<?php echo $_smarty_tpl->tpl_vars['membre']->value->getId();?>
">
									Rendre admin
								</a>
							</li>
							<li>
								<a href="index.php?admin=MEMBRES&amp;action=SUPPRIMER&amp;id=<?php echo $_smarty_tpl->tpl_vars['membre']->value->getId();?>
">
									Supprimer
								</a>
							</li>
						</ul>
					</td>
				<?php }?>
			</tr>			
		<?php } ?>
		
	</table>

			</div>						
		</div>
		<div id="footer">
			<div id="sitemap">
				
			</div>
			<div id="credits_droits">
				Site crée par Sylafrs, Neo et RFK78 !
			</div>
			<div id="partenaires">
				
			</div>						
		</div>
		<script type="text/javascript" src="script.js"></script>
	</body>
</html><?php }} ?>