<?php /* Smarty version Smarty 3.1.4, created on 2011-10-27 17:58:54
         compiled from "templates\fiche_produit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118254ea99bdea44ae5-72904422%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'feb38640fe379a113650bc0f8e8e3b35b611199d' => 
    array (
      0 => 'templates\\fiche_produit.tpl',
      1 => 1319734037,
      2 => 'file',
    ),
    '052881f7f30ed3dac613b15ae7bee0674d848f7e' => 
    array (
      0 => '.\\templates\\modele\\main.tpl',
      1 => 1319734013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118254ea99bdea44ae5-72904422',
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
  'unifunc' => 'content_4ea99bdf3d000',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ea99bdf3d000')) {function content_4ea99bdf3d000($_smarty_tpl) {?><?php echo '<?xml';?> version="1.0" encoding="UTF-8"<?php echo '?>';?>

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
				
	<div id="fiche-produit">
		<span id="categorie-fiche-produit">JARDIN ></span><span id="sous-categorie-fiche-produit">Outils</span>
		
		<div id="image-fiche-produit">
			<img src="img/tronconeuse.jpg" alt="Tronconeuse"/>
		</div>
		<div id="fiche-technique-produit">
			<h2> TRONCONEUSE DE LA MORT QUI TUE </h2>
			
			<div id="fiche-technique-description-produit">
				<p>
					Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
					Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
					Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
					Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique
				</p>
			</div>
			
			<div id="prix-fiche-produit">
				<h4>666E</h4>
			</div>
			<div id="ajouter-au-panier">
				<h4>Ajouter au panier !</h4>
			</div>

			<div id="select-quantite">
				<form method="post" action="#">
				   <p>
					   <label for="pays">Quantité :</label><br />
					   <select name="quantité" id="quantité">
						   <option value="1">1</option>
						   <option value="2">2</option>
						   <option value="3">3</option>
						   <option value="4">4</option>
						   <option value="5">5</option>
						   <option value="6">6</option>
						   <option value="7">7</option>
						   <option value="8">8</option>
					   </select>
				   </p>
				</form>
			</div>
			
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/greystar.png" alt="greyStar" /></div>
			<div class="rating-star"><img src="img/greystar.png" alt="greyStar" /></div>
			
			</br><div id="fiche-produit-nbavis"><h6>( 5 Avis )</h6></div>
		</div>
		
		<div class="avis-fiche-produit">
			<h3> Très efficace ! <h3>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<h6> Par : Jean-luc   le 06/06/06 </h6>
			<p>
				blabla blablablablablablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablablablablablabla
			</p>
		</div>
		
		<div class="avis-fiche-produit">
			<h3> Très efficace ! <h3>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<h6> Par : Jean-luc   le 06/06/06 </h6>
			<p>
				blabla blablablablablablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablablablablablabla
			</p>
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