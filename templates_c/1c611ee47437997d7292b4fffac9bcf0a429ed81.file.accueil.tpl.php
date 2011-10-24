<?php /* Smarty version Smarty 3.1.4, created on 2011-10-24 19:21:25
         compiled from "templates\accueil.tpl" */ ?>
<?php /*%%SmartyHeaderCode:235244ea5b908a44ad9-53438387%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c611ee47437997d7292b4fffac9bcf0a429ed81' => 
    array (
      0 => 'templates\\accueil.tpl',
      1 => 1319483831,
      2 => 'file',
    ),
    '325c040ac3eb2e57c3cb2db39552570ef3cca8a8' => 
    array (
      0 => '.\\templates\\main.tpl',
      1 => 1319483962,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235244ea5b908a44ad9-53438387',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_4ea5b908bbd58',
  'variables' => 
  array (
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea5b908bbd58')) {function content_4ea5b908bbd58($_smarty_tpl) {?><?php echo '<?xml';?> version="1.0" encoding="UTF-8"<?php echo '?>';?>

<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
				
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<!-- 
			# Balises d'en-tête 
			## Balises meta		
		
			* Content-Type : Permet de spécifier l'encodage du contenu
			* pragme=no-cache : Permet de demander de ne pas faire de mise en cache
						
			## Balises de lien
					
			* link style.css : Insère le design
						
			## Autres balises
						
			* title : Ajoute le titre
		-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="pragma"		content="no-cache"				   />
		<link rel="stylesheet" media="screen" href="style.css" type="text/css"/>
		<title>Site - Chez Bob</title>
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
					<<?php ?>?php espaceMembre(); ?<?php ?>>
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
				<ul id="liste_menu">
					<li><a href='index.php?page=CATEGORIES'>Acheter</a>
						<ul class="sous-menu">
							<span class="first-elem-sous-menu"><li><a href='index.php?page=SOUSCATEGORIES&amp;id=1'>Jardin</a></li></span>
							<li><a href='#'>Menuiserie</a></li>
							<li><a href='#'>Sols</a></li>
							<li><a href='#'>Quilcaillerie</a></li>
							<span class="last-elem-sous-menu"><li><a href='#'>Peinture</a></li></span>
						</ul>
					</li>
					<li><a href='index.php?page=CATEGORIES-LOCATION'>Louer</a>
						<ul class="sous-menu">
							<span class="first-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
							<li><a href='#'>Porn Pics</a></li>
							<li><a href='#'>Porn Pics</a></li>
							<li><a href='#'>Porn Pics</a></li>
							<li><a href='#'>Porn Pics</a></li>
							<span class="last-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
						</ul>
					</li>
					<li><a href='index.php?page=ABOUT'>Contact</a>
					</li>
					<li><a href='#'>Donate !</a>
						<ul class="sous-menu">
							<span class="first-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
							<li><a href='#'>Porn Pics</a></li>
							<li><a href='#'>Porn Pics</a></li>
							<li><a href='#'>Porn Pics</a></li>
							<li><a href='#'>Porn Pics</a></li>
							<li><a href='#'>Porn Pics</a></li>
							<span class="last-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
						</ul>
					</li>
				</ul>
			</div>							
			<div id="fastbar">
				
			</div>
			<div id="content">
				<?php if ($_smarty_tpl->tpl_vars['message']->value){?>
					<p id="contenu_message">
						<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

					<p>
				<?php }?>
				
					
				
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