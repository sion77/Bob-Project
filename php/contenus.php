<?php
	function afficheCategories()
	{
		?>
		
		<div id="panneau-categories">
			<div class="categorie">
				<img src="img/categorie-jardin.jpg" alt="Test categories"/>
				<a href='index.php?page=SOUSCATEGORIES'>Jardin</a>
			</div>
			
			<div class="categorie">
				<img src="img/categorie-jardin.jpg" alt="Test categories"/>
				<a> Titre categ </a>
			</div>
			
			<div class="categorie">
				<img src="img/categorie-jardin.jpg" alt="Test categories"/>
				<a> Titre categ </a>
			</div>
			
			<div class="categorie">
				<img src="img/categorie-jardin.jpg" alt="Test categories"/>
				<a> Titre categ </a>
			</div>
			
			<div class="categorie">
				<img src="img/categorie-jardin.jpg" alt="Test categories"/>
				<a> Titre categ </a>
			</div>
			
			<div class="categorie">
				<img src="img/categorie-jardin.jpg" alt="Test categories"/>
				<a> Titre categ </a>
			</div>
			
			<div class="categorie">
				<img src="img/categorie-jardin.jpg" alt="Test categories"/>
				<a> Titre categ </a>
			</div>
			
			<div class="categorie">
				<img src="img/categorie-jardin.jpg" alt="Test categories"/>
				<a> Titre categ </a>
			</div>
		</div>
		
		<?php
	}
?>

<?php
	function afficheSousCategories()
	{
		?>
		<div id="page-sous-categories">
			
				<h2>JARDIN<h2>
				<img src="img/pub-ideejardin.jpg" alt="Test categories"/>
				<div class="sous-categorie">
					<h4>Tondeuses</h4>
					<img src="img/souscat-tondeuses.jpg" alt="Test categories"/>
					<p> Ceci est une tondeuse. Une tondeuse à gazon est une machine manuelle ou motorisée, 
					qui sert à couper l'herbe des gazons et pelouses de manière à obtenir un tapis d'une hauteur régulière.</p>
					<a href='#'>Voir les autres produits</a>
				</div>
				
				<div class="sous-categorie">
					<h4>Tondeuses</h4>
					<img src="img/souscat-tondeuses.jpg" alt="Test categories"/>
					<p> Ceci est une tondeuse. Une tondeuse à gazon est une machine manuelle ou motorisée, 
					qui sert à couper l'herbe des gazons et pelouses de manière à obtenir un tapis d'une hauteur régulière.</p>
				</div>
				
				<div class="sous-categorie">
					<h4>Tondeuses</h4>
					<img src="img/souscat-tondeuses.jpg" alt="Test categories"/>
					<p> Ceci est une tondeuse. Une tondeuse à gazon est une machine manuelle ou motorisée, 
					qui sert à couper l'herbe des gazons et pelouses de manière à obtenir un tapis d'une hauteur régulière.</p>
				</div>
				
				<div class="sous-categorie">
					<h4>Tondeuses</h4>
					<img src="img/souscat-tondeuses.jpg" alt="Test categories"/>
					<p> Ceci est une tondeuse. Une tondeuse à gazon est une machine manuelle ou motorisée, 
					qui sert à couper l'herbe des gazons et pelouses de manière à obtenir un tapis d'une hauteur régulière.</p>
				</div>
				
				<div class="sous-categorie">
					<h4>Tondeuses</h4>
					<img src="img/souscat-tondeuses.jpg" alt="Test categories"/>
					<p> Ceci est une tondeuse. Une tondeuse à gazon est une machine manuelle ou motorisée, 
					qui sert à couper l'herbe des gazons et pelouses de manière à obtenir un tapis d'une hauteur régulière.</p>
				</div>

		</div>
		<?php
	}
?>
	
<?php
	function afficheFicheProduit()
	{
		?>
		<div id="fiche-produit">
			<span id="categorie-fiche-produit">JARDIN ></span><span id="sous-categorie-fiche-produit">Outils</span>
			<img src="img/rateau.jpg" alt="Rateau"/>
		</div>
		<?php
	}


