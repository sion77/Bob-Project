<?php
	function afficheCategories()
	{		
		echo "<div id=\"panneau-categories\">";
		
		$sql = "SELECT idCat AS \"id\", nomCat AS \"titre\" 
				FROM categorie
				WHERE idParent IS NULL";
				
		$req = mysql_query($sql) or die(erreur_sql($sql));
		while($rep = mysql_fetch_array($req))
		{
			echo "<div class=\"categorie\">";
				echo "<img src=\"img/categorie-jardin.jpg\" alt=\"Test categories\"/>";
				echo "<a href=\"index.php?page=SOUSCATEGORIES&amp;id=".$rep["id"]."\">".$rep["titre"]."</a>";
			echo "</div>";
		}
		echo "</div>";
		mysql_free_result($req);
	}

	function afficheSousCategories($id)
	{// $id securisee	
				
		$sql = "SELECT idCat AS \"id\",
			           nomCat AS \"nom\"
					FROM categorie
					WHERE idCat = '".$id."'";
		
		$req = mysql_query($sql) or die (erreur_sql($sql));
		
		if($rep = mysql_fetch_array($req))
		{		
			mysql_free_result($req);
			
			echo "<div id=\"page-sous-categories\">";
				echo "<h2>".$rep["nom"]."</h2>";
				echo "<img src=\"img/pub-ideejardin.jpg\" alt=\"Test categories\"/>";
				
				$sql = "SELECT idCat AS \"id\",
						   nomCat AS \"titre\",
						   descriptionCat AS \"desc\"
						FROM categorie
						WHERE idParent = '".$id."'";
			
				$req = mysql_query($sql) or die (erreur_sql($sql));
			
				while($rep = mysql_fetch_array($req))
				{
					echo "<div class=\"sous-categorie\">";
						echo "<h4>".$rep["titre"]."</h4>";
						echo "<img src=\"img/souscat-tondeuses.jpg\" alt=\"Test categories\"/>";
						echo "<p>".$rep["desc"]."</p>";
						echo "<a href='#'>Voir les autres produits</a>";
					echo "</div>";
				}
				mysql_free_result($req);
			
			echo "</div>";
		}
		else
		{
			mysql_free_result($req);
			page("CATEGORIES", "<span class=\"erreur\">Erreur : la catégorie n°".$id." n'existe pas !</span>");
		}
	}

	function afficheFicheProduit()
	{
		?>
		
		<div id="fiche-produit">
			<span id="categorie-fiche-produit">JARDIN ></span><span id="sous-categorie-fiche-produit">Outils</span>
			<img src="img/rateau.jpg" alt="Rateau"/>
			<div id="fiche-technique-produit">
				<h2> TRONCONEUSE DE LA MORT QUI TUE </h2>
				
				<div id="fiche-technique-description-produit">
				<p> Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
				Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
				Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
				Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique </p>
				</div>
				
				<div id="prix-fiche-produit"><h4>666E</h4></div>
				
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
				
				<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
				<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
				<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
				<div class="rating-star"><img src="img/greystar.png" alt="greyStar" /></div>
				<div class="rating-star"><img src="img/greystar.png" alt="greyStar" /></div>
				<div id="fiche-produit-nbavis"><p>( 5 Avis )</p></div>
				
			</div>
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
