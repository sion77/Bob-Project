<?php

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
