<?php /* Smarty version Smarty 3.1.4, created on 2011-10-25 12:07:21
         compiled from "templates\connection.tpl" */ ?>
<?php /*%%SmartyHeaderCode:55474ea6a679a66ad5-71546284%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bcbdd2f7fdbae8a4a8f07b87e85dcf98a8baa158' => 
    array (
      0 => 'templates\\connection.tpl',
      1 => 1319544424,
      2 => 'file',
    ),
    '052881f7f30ed3dac613b15ae7bee0674d848f7e' => 
    array (
      0 => '.\\templates\\modele\\main.tpl',
      1 => 1319543087,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55474ea6a679a66ad5-71546284',
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
  'unifunc' => 'content_4ea6a67a1e152',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea6a67a1e152')) {function content_4ea6a67a1e152($_smarty_tpl) {?><?php echo '<?xml';?> version="1.0" encoding="UTF-8"<?php echo '?>';?>

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
				
	<div id="form-connection">
		<h1>CONNECTION !</h1>
		<form action="index.php?action=CONNECTION" method="post">
			<table>
				<tr>
					<th><label for="pseudo">Pseudo :</label></td>
					<td><input id="pseudo" name="pseudo" type="text" /></td>
				</tr>
				<tr>
					<th><label for="pass">Mot de passe :</label></td>
					<td><input id="pass" name="pass" type="password" /></td>
				</tr>
				<tr>
					<td colspan="2" class="centre"><input type="submit" value="C'est parti !" /></td>
				</tr>
			</table>	
		</form>
	</div>
	<div id="pub-connection">
		<img src="img/neweststuffpub.jpg" alt="Newest Stuff"/>
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