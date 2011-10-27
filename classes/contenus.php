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
