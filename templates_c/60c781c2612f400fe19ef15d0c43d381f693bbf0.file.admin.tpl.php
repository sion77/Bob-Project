<?php /* Smarty version Smarty 3.1.4, created on 2011-10-27 17:59:00
         compiled from "templates\admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125954ea99be48cb725-67086232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60c781c2612f400fe19ef15d0c43d381f693bbf0' => 
    array (
      0 => 'templates\\admin.tpl',
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
  'nocache_hash' => '125954ea99be48cb725-67086232',
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
  'unifunc' => 'content_4ea99be4e7192',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea99be4e7192')) {function content_4ea99be4e7192($_smarty_tpl) {?><?php echo '<?xml';?> version="1.0" encoding="UTF-8"<?php echo '?>';?>

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
				
	<div id="page-admin">
		<div id="panneau-admin">
			<h1>Panneau d'administrateur</h1>
			<div class="icon-panneau-admin">
				<a href="index.php?admin=MEMBRES"><img src="img/usericon.jpg" alt="Gestion des membres"/></a>
				<a href="index.php?admin=MEMBRES">Gestion des membres</a>
			</div>	
			<div class="icon-panneau-admin">
				<a href="index.php?admin=CATEGORIES"><img src="img/boxicon.jpg" alt="Gestion des categories"/></a>
				<a href="index.php?admin=CATEGORIES">Gestion des categories</a>
			</div>
		</div>
	</div>

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