<?php

	function erreur_sql($sql)
	{
		print(nl2br("<h1>Erreur sql</h1>			
			<strong>Voici la requete</strong> : 
			".$sql."
			
			<strong>Voici l'erreur</strong> : ".mysql_error()."
			
			<a href=\"index.php\">Retour</a>
			<a href=\"mailto:moi\">Signaler l'erreur</a>"));
	}

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
				
				// On compte le nombre de personnes ayant le pseudo $pseudo
				$req = mysql_query("SELECT idUtilisateur FROM utilisateur WHERE pseudoUtilisateur = '".$pseudo."'");
				$count = mysql_num_rows($req);
				mysql_free_result($req);
				
				// Si personne n'a déjà ce pseudo
				if($count == 0)
				{
					$sql = "INSERT INTO utilisateur(pseudoUtilisateur, passUtilisateur)
							VALUES('".$pseudo."', '".$pass."')";
							
					// Si pas d'erreur
					if(mysql_query($sql))
					{
						$_SESSION["pseudo"] = $pseudo;
						$_SESSION["connecte"] = true;
						$_SESSION["admin"] = false;
						page("ACCUEIL");
					}
					
					// (En cas d'erreur SQL)
					else		
						erreur_sql($sql);
					
				}
				else // PSEUDO DEJA PRIS
					page("INSCRIPTION", '<span class="Error">Erreur : pseudo déjà pris</span>');			
			}
			else // MOTS DE PASSE DIFFERENTS
				page("INSCRIPTION", '<span class="Error">Erreur : mots de passe différents</span>');
		}
		else // DONNEES MANQUANTES
			page("INSCRIPTION", '<span class="Error">Erreur : données manquantes</span>');
	}
	
	function connection()
	{
		if(isset($_POST["pseudo"]) &&
		   isset($_POST["pass"])     )
		{
			if($_POST["pseudo"] != "" &&
			   $_POST["pass"] != ""     )
			{
				$pseudo = mysql_real_escape_string($_POST["pseudo"]);
				$pass = sha1($_POST["pass"]);
				
				$req = mysql_query("SELECT passUtilisateur AS \"pass\", idUtilisateur AS \"id\" 
									FROM utilisateur 
									WHERE pseudoUtilisateur = '".$pseudo."'");
				if($rep = mysql_fetch_array($req))
				{
					mysql_free_result($req);

					if($rep["pass"] == $pass)
					{
						$_SESSION["connecte"] = true;
						$_SESSION["pseudo"] = $pseudo;
						$_SESSION["id"] = $rep["id"];
						$_SESSION["admin"] = false;
						
						$req = mysql_query("SELECT idAdmin FROM admin WHERE idAdmin = '".$rep["id"]."'");
						if(mysql_fetch_row($req))
							$_SESSION["admin"] = true;
						
						page("MAIN");
					}
					else
						page("CONNECTION", '<span class="erreur">Erreur : Mauvais identifiants</span>');
				}
				else
					page("CONNECTION", '<span class="erreur">Erreur : Mauvais identifiants</span>');
				
				mysql_free_result($req);
			}
		}
		else
			page("CONNECTION", '<span class="erreur">Erreur : il manque des données</span>');
	}

?>