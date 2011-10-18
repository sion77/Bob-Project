<?php

	// Affiche les categories dans des blocs
	function afficheCategories()
	{		
		// Bloc panneau-categories
		echo "<div id=\"panneau-categories\">";
		
			// "Demande le numéro et le nom de chaque catégorie sans parent"
			$sql = "SELECT idCat AS \"id\", nomCat AS \"titre\" 
					FROM categorie
					WHERE idParent IS NULL";
					
			// Pour chaque ligne de résultat
			$req = mysql_query($sql) or die(erreur_sql($sql)); // Execute la requete
			while($rep = mysql_fetch_array($req))              // Recupere le resultat de la prochaine ligne
			{
				// Bloc categorie (image de la catégorie + lien vers la page contenant ses sous-catégories)
				echo "<div class=\"categorie\">";
					echo "<img src=\"img/categorie-jardin.jpg\" alt=\"Test categories\"/>";
					echo "<a href=\"index.php?page=SOUSCATEGORIES&amp;id=".$rep["id"]."\">".$rep["titre"]."</a>";
				echo "</div>";
			}			
			mysql_free_result($req); // Libere le resultat
			
		echo "</div>";
	}

	// Affiche les sous-catégories
	function afficheSousCategories($id)
	{// $id securisee	
				
		// Recupere le nom de la catégorie dont l'id est $id
		$sql = "SELECT nomCat AS \"nom\"
				FROM categorie
				WHERE idCat = '".$id."'";
		
		// Execute la requete et pour chaque ligne de résultat
		$req = mysql_query($sql) or die (erreur_sql($sql));
		if($rep = mysql_fetch_array($req))
		{		
			// Libère le résultat
			mysql_free_result($req);
			
			// Bloc "page-sous-categorie"
			echo "<div id=\"page-sous-categories\">";
			
				// Titre : nom de la catégorie mère (suivie d'une image)
				echo "<h2>".$rep["nom"]."</h2>";
				echo "<img src=\"img/pub-ideejardin.jpg\" alt=\"Test categories\"/>";
				
				// Récupérer l'id, le titre, la description de chaque catégorie dont le père à pour id : $id
				$sql = "SELECT idCat AS \"id\",
						       nomCat AS \"titre\",
						       descriptionCat AS \"desc\"
						FROM categorie
						WHERE idParent = '".$id."'";

				// Executer la requête et, pour chaque ligne de résultat :
				$req = mysql_query($sql) or die (erreur_sql($sql));
				while($rep = mysql_fetch_array($req))
				{
					// Bloc sous-categorie
					echo "<div class=\"sous-categorie\">";
						// On affiche le titre, l'image et la description de la catégorie
						echo "<h4>".$rep["titre"]."</h4>";
						echo "<img src=\"img/souscat-tondeuses.jpg\" alt=\"Test categories\"/>";
						echo "<p>".$rep["desc"]."</p>";
						echo "<a href='#'>Voir les autres produits</a>";
					echo "</div>";
				}
				mysql_free_result($req); // On libère le resultat
			
			echo "</div>";
		}
		
		// On ne trouve pas la catégorie mère :
		else
		{
			// On libère le résultat
			mysql_free_result($req);
			
			// On affiche les catégories sans parent..
			afficheCategories();
		}
	}
	
	// ============ TEMPORAIRE ============
	function afficheFicheProduit()
	{
		?>
		
		<div id="fiche-produit">
			<span id="categorie-fiche-produit">JARDIN ></span><span id="sous-categorie-fiche-produit">Outils</span>
			<div id="image-fiche-produit"><img src="img/tronconeuse.jpg" alt="Tronconeuse"/></div>
			<div id="fiche-technique-produit">
				<h2> TRONCONEUSE DE LA MORT QUI TUE </h2>
				
				<div id="fiche-technique-description-produit">
				<p> Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
				Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
				Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
				Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique </p>
				</div>
				
				<div id="prix-fiche-produit"><h4>666E</h4></div>
				<div id="ajouter-au-panier"><h4>Ajouter au panier !</h4></div>

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
				<p> blabla blablablablablablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablablablablablabla</p>
			</div>
			
			<div class="avis-fiche-produit">
				<h3> Très efficace ! <h3>
				<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
				<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
				<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
				<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
				<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
				<h6> Par : Jean-luc   le 06/06/06 </h6>
				<p> blabla blablablablablablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablablablablablabla</p>
			</div>
			
		</div>
		<?php
	}

	function admin_listerMembres()
	{
		/*
			Demande l'id et le pseudo de chaque utilisateur 
			ainsi qu'un booléen indiquant s'il est admin ou pas.
			Tout cela trié suivant l'id de l'utilisateur
		*/
		$sql = "    -- Récupère les utilisateurs non admins
              		SELECT idUtilisateur AS \"id\", pseudoUtilisateur AS \"pseudo\", '0' AS \"admin\" 
				    FROM utilisateur M, admin A
				    WHERE idUtilisateur <> idAdmin
				UNION
				    -- Récupère les utilisateurs admins
				    SELECT idUtilisateur AS \"id\", pseudoUtilisateur AS \"pseudo\", '1' AS \"admin\"
				    FROM utilisateur M, admin A
				    WHERE idUtilisateur = idAdmin
					
				ORDER BY id";
			
		// On commence le tableau
		?>
			<h1>Gestion des membres</h1>
			<table>
				<tr>
					<th>Id</th>
					<th>Pseudo</th>
					<th>Actions</th>
				</tr>
		<?php
		
		// Executer la requête, puis, pour chaque ligne de résultat
		$req = mysql_query($sql) or die(erreur_sql($sql));
		while($rep = mysql_fetch_array($req))
		{
			// On commence un ligne dans laquelle on met :
			echo "<tr>";
			
				// L'id
				echo "<td>".$rep["id"]."</td>";
				
				// Le pseudo
				echo "<td>".$rep["pseudo"]."</td>";
		
				// "Administrateur" s'il s'agit d'un admin
				if($rep["admin"])
				{
					echo "<td>Admin</td>";
				}
				
				// ou la liste des actions possibles dans le cas d'un utilisateur
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
		mysql_free_result($req); // On libère le résultat
		
		echo "</table>";
		// Fin du tableau
	}
	
	// Permet de lister les catégories
	function admin_listerCategories()
	{
		// Titre de la page
		echo "<h1>Gestion des categories</h1>";
		echo "<h2><span class=\"erreur\">** En cours de création **</span></h2>";
		
		// Pour chaque catégorie sans parent..
		$sql = "SELECT * FROM categorie
				WHERE idParent IS NULL";
				
		// Débute la liste des catégorie
		echo "<ul>";
					
			// Execute la requete, puis, pour chaque ligne de résultat..
			$req = mysql_query($sql) or die(erreur_sql($sql));
			while($rep = mysql_fetch_array($req))
			{
				// On liste les catégories
				echo "<li>".$rep["idCat"].") ".$rep["nomCat"]."</li>";
			}
			mysql_free_result($req); // On libère le resultat
			
		echo "</ul>";
		// Fin de la liste		
	}

?>
