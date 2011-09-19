<?php

	function inscription()
	{
		// On verifie que tout à été entré
		if(isset($_POST["pseudo"]) && isset($_POST["pass"]) && isset($_POST["pass2"]))
		{
			// On vérifie que les mots de passe sont identiques
			if($_POST["pass"] == $_POST["pass2"])
			{
				// On crypte le mot de passe pour qu'il ne soit pas lisible du premier coup d'oeil dans la BDD
				$pass = sha1($_POST["pass"]);
				
				// On echappe les quotes pour éviter les injections SQL.
				$pseudo = mysql_real_escape_string($_POST["pseudo"]);
				
			}
			else
				page("INSCRIPTION", '<span class="Error">Erreur : mots de passe différents</span>');
		}
		else
			page("INSCRIPTION", '<span class="Error">Erreur : données manquantes</span>');
	}

?>