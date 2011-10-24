<?php /* Smarty version Smarty 3.1.4, created on 2011-10-24 20:30:00
         compiled from "templates\accueil.tpl" */ ?>
<?php /*%%SmartyHeaderCode:292934ea5ca882fe419-65453362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c611ee47437997d7292b4fffac9bcf0a429ed81' => 
    array (
      0 => 'templates\\accueil.tpl',
      1 => 1319488189,
      2 => 'file',
    ),
    '052881f7f30ed3dac613b15ae7bee0674d848f7e' => 
    array (
      0 => '.\\templates\\modele\\main.tpl',
      1 => 1319487131,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '292934ea5ca882fe419-65453362',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_4ea5ca889a35c',
  'variables' => 
  array (
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea5ca889a35c')) {function content_4ea5ca889a35c($_smarty_tpl) {?><?php echo '<?xml';?> version="1.0" encoding="UTF-8"<?php echo '?>';?>

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
					<!-- GET pour pouvoir retourner Ã  un rÃ©sultat de recherche aisÃ©ment -->
					<form action="index.php?action=RECHERCHE" method="get">
						<input type="text" name="recherche" value="Rechercher" />
						<input type="submit" value="GO" />
					</form>
					<a href="index.php?page=RECHERCHE_AVANCEE" title="Recherche avancÃ©e">Recherche avancÃ©e</a>
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
						<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

					<p>
				<?php }?>
				
	<div id="pub">
		<img src="img/test 960x200.jpg" alt="Merci de débloquer votre bloqueur de pubs pour la survie du site. Merci m_(-_-)_m" /> 
	</div>
	<div id="coup_coeur">
		<div class="boite_coup_coeur" id="best_seller">

			<h1> Meilleure vente du momment !</h1>
			<h3> Titre article </h3>
			
			<img src="img/marteau.jpg" alt="Test image"/>
			
			<p> Ceci est la description de l'article. Ce texte sera surement tronqué au cas ou il sera trop long
				Certains elements ici seront a changer pour mettre des liens vers la fiche de l'article.
				 </p>
				
			<span id="prix_article_bestseller" class="prix_article_coup_coeur">5e</span>  
			<span id="voirficheproduit_bestseller" class="voirficheproduit_coup_coeur"><a href='index.php?page=FICHEPRODUIT'>Voir fiche produit</a></span>
		</div>
		
		<div class="boite_coup_coeur" id="nouveaute">
		
		<h1> Exclusivité BricoBob !</h1>
			<h3> Titre article </h3>
			
			<img src="img/marteau.jpg" alt="Test image"/>
			
			<p> Ceci est la description de l'article. Ce texte sera surement tronqué au cas ou il sera trop long
				Certains elements ici seront a changer pour mettre des liens vers la fiche de l'article.
				 </p>
				
			<span id="prix_article_nouveaute" class="prix_article_coup_coeur">79.99e</span> 
			<span id="voirficheproduit_nouveaute" class="voirficheproduit_coup_coeur"><a href='index.php?page=FICHEPRODUIT'>Voir la fiche produit</a></span>
		
		</div>
	</div>

			</div>						
		</div>
		<div id="footer">
			<div id="sitemap">
				
			</div>
			<div id="credits_droits">
				Site crÃ©e par Sylafrs, Neo et RFK78 !
			</div>
			<div id="partenaires">
				
			</div>						
		</div>
		<script type="text/javascript" src="script.js"></script>
	</body>
</html><?php }} ?>