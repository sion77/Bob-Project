<?php /* Smarty version Smarty 3.1.4, created on 2011-10-25 12:39:37
         compiled from "templates\inscription.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173254ea6ae093ef4d5-82924135%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56fec87ad8abd67e025e9b14e4baf41c119b6d90' => 
    array (
      0 => 'templates\\inscription.tpl',
      1 => 1319535864,
      2 => 'file',
    ),
    '052881f7f30ed3dac613b15ae7bee0674d848f7e' => 
    array (
      0 => '.\\templates\\modele\\main.tpl',
      1 => 1319543087,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173254ea6ae093ef4d5-82924135',
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
  'unifunc' => 'content_4ea6ae09b4d83',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea6ae09b4d83')) {function content_4ea6ae09b4d83($_smarty_tpl) {?><?php echo '<?xml';?> version="1.0" encoding="UTF-8"<?php echo '?>';?>

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
				
	<div id="form-inscription">
		<h1>INSCRIPTION !</h1>
		<h4>Les deux mots de passe doivent être identiques.</h4>
		<h6>Veuillez ne pas tenter d'injections SQL S.V.P, merci ;)</h6>
		
		<form action="index.php?action=INSCRIPTION" method="post">		
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
					<th><label for="pass2">Confirmation :</label></td>
					<td><input id="pass2" name="pass2" type="password" /></td>
					<span class="tooltip">Le mot de passe de confirmation doit être identique à celui d'origine</span>
					
				</tr>
				<tr>
					<td colspan="2" class="centre"><input type="submit" value="Je m'inscris" /></td>
				</tr>
			</table>	
		</form>
	</div>
	<div id="pourquoi-sinscrire">
		<h2> Pourquoi s'inscrire sur Brico-Bob ? </h2>
		<p>
			Il existe de nombreuses raisons qui pourraient vous pousser à vous inscrire sur Brico-Bob. Tout d'abord parce que 
			ce site est cool.</br>
			</br> 
			Ensuite parce que si vous ne le faites pas, vous ne pourrez rien acheter, ni louer, vous ne pourrez
			qu'admirer les superbes offres que nous vous proposons.</br>
			</br>
			Ensuite parce que ce site est cool.</br>
			</br>
			Une autre raison importante	est que nous sommes de méchants administrateurs qui vendent vos données privées et nous enregistrons vos données banquaires,
			ce qui constitue notre principale source de revenus 8D
		</p>
	</div>
	<script language="javascript" src="script.js"></script>

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