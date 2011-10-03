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

	function afficheFicheProduit()
	{
		?>
		<div id="fiche-produit">
			<span id="categorie-fiche-produit">JARDIN ></span><span id="sous-categorie-fiche-produit">Outils</span>
			<img src="img/rateau.jpg" alt="Rateau"/>
		</div>
		<?php
	}
	
	function admin_listerMembres()
	{
		$sql = "SELECT idUtilisateur AS \"id\", pseudoUtilisateur AS \"pseudo\", '0' AS \"admin\"
				FROM utilisateur M, admin A
				WHERE idUtilisateur <> idAdmin
				UNION
				SELECT idAdmin AS \"id\", pseudoUtilisateur AS \"pseudo\", '1' AS \"admin\"
				FROM utilisateur M, admin A
				WHERE idUtilisateur = idAdmin
				ORDER BY id";
				
		?>
			<table>
				<tr>
					<th>Id</th>
					<th>Pseudo</th>
					<th>Actions</th>
				</tr>
		<?php
		
		$req = mysql_query($sql) or die(erreur_sql($sql));
		while($rep = mysql_fetch_array($req))
		{
			echo "<tr>";
				echo "<td>".$rep["id"]."</td>";
				echo "<td>".$rep["pseudo"]."</td>";
		
				if($rep["admin"])
				{
					echo "<td>Admin</td>";
				}
				else
				{
					echo "<td>";
						echo "<ul>";
							echo "<li>";
								echo "<a href=\"index.php?admin=MEMBRES&amp;action=PROMO&amp;id=".$rep["id"]."\">";
									echo "Rendre admin";
								echo "</a>";
							echo "</li>";
							echo "<li>";
								echo "<a href=\"index.php?admin=MEMBRES&amp;action=SUPPRIMER&amp;id=".$rep["id"]."\">";
									echo "Supprimer";
								echo "</a>";
							echo "</li>";
						echo "</ul>";
					echo "</td>";
				}
			echo "</tr>";
		}
		mysql_free_result($req);
		
		echo "</table>";
	}

?>
