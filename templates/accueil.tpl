{* Le mod�le de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
	<link rel="stylesheet" media="screen" href="css/special/accueil.css" type="text/css"/>
{/block}

{* Le contenu de la page *}
{block name=content}
	<div id="pub">
		<img src="img/test 960x200.jpg" alt="Merci de d�bloquer votre bloqueur de pubs pour la survie du site. Merci m_(-_-)_m" /> 
	</div>
	<div id="coup_coeur">
		<div class="boite_coup_coeur" id="best_seller">

			<h1> Meilleure vente du momment !</h1>
			<h3> Titre article </h3>
			
			<img src="img/marteau.jpg" alt="Test image"/>
			
			<p> Ceci est la description de l'article. Ce texte sera surement tronqu� au cas ou il sera trop long
				Certains elements ici seront a changer pour mettre des liens vers la fiche de l'article.
				 </p>
				
			<span id="prix_article_bestseller" class="prix_article_coup_coeur">5e</span>  
			<span id="voirficheproduit_bestseller" class="voirficheproduit_coup_coeur"><a href='index.php?page=FICHEPRODUIT'>Voir fiche produit</a></span>
		</div>
		
		<div class="boite_coup_coeur" id="nouveaute">
		
		<h1> Exclusivit� BricoBob !</h1>
			<h3> Titre article </h3>
			
			<img src="img/marteau.jpg" alt="Test image"/>
			
			<p> Ceci est la description de l'article. Ce texte sera surement tronqu� au cas ou il sera trop long
				Certains elements ici seront a changer pour mettre des liens vers la fiche de l'article.
				 </p>
				
			<span id="prix_article_nouveaute" class="prix_article_coup_coeur">79.99e</span> 
			<span id="voirficheproduit_nouveaute" class="voirficheproduit_coup_coeur"><a href='index.php?page=FICHEPRODUIT'>Voir la fiche produit</a></span>
		
		</div>
	</div>
{/block}