<?php
	
	// Permet d'afficher la requête erronée et l'erreur contenue dans mysql_error de manière classe
	function erreur_sql($sql)
	{
		print(nl2br("<h1>Erreur sql</h1>			
			<strong>Voici la requete</strong> : 
			".$sql."
			
			<strong>Voici l'erreur</strong> : ".mysql_error()."
			
			<a href=\"index.php\">Retour</a>
			<a href=\"mailto:moi\">Signaler l'erreur</a>"));
	}

	// Permet l'inscription d'un membre
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
	
	// Permet la connection d'un membre
	function connection()
	{
		// Si les champs existent
		if(isset($_POST["pseudo"]) &&
		   isset($_POST["pass"])     )
		{
			// S'ils ne sont pas vides
			if($_POST["pseudo"] != "" &&
			   $_POST["pass"] != ""     )
			{
				// On sécurise tout ça
				$pseudo = mysql_real_escape_string($_POST["pseudo"]);
				
				// On crypte le mot de passe
				$pass = sha1($_POST["pass"]);
				
				// On demande le mot de passe de l'utilisateur dont le pseudo est donné
				$sql = "SELECT passUtilisateur AS \"pass\", idUtilisateur AS \"id\" 
						FROM utilisateur 
						WHERE pseudoUtilisateur = '".$pseudo."'";
				
				// On execute la requete
				$req = mysql_query($sql) or die(erreur_sql($sql));
									
				// Si l'utilisateur existe, on recupère son mot de passe (crypté à l'inscription)
				if($rep = mysql_fetch_array($req))
				{
					mysql_free_result($req); // On libère le résultat

					// On va pouvoir comparer les mots de passes cryptés
					if($rep["pass"] == $pass)
					{
						// Si c'est bon : on se connecte, c'est-à-dire : on remplit $_SESSION
						// (Notemment $_SESSION["connecte"] à true)
						$_SESSION["connecte"] = true;
						$_SESSION["pseudo"] = $pseudo;
						$_SESSION["id"] = $rep["id"];
						$_SESSION["admin"] = false;
						
						// On regarde si l'utilisateur est admin ou non
						$sql = "SELECT idAdmin FROM admin WHERE idAdmin = '".$rep["id"]."'";
						$req = mysql_query($sql) or die(erreur_sql($sql));
						
						if(mysql_fetch_row($req)) // Si c'est le cas..
							$_SESSION["admin"] = true;
							
						mysql_free_result($req); // On libère le résultat
						
						// On retourne à l'accueil (mais connecté)
						page("ACCUEIL");
					}
					
					// Si les mots de passes sont différents
					else
						page("CONNECTION", '<span class="erreur">Erreur : Mauvais identifiants</span>');
				}
				
				// Si on ne trouve pas l'utilisateur
				else
					page("CONNECTION", '<span class="erreur">Erreur : Mauvais identifiants</span>');
			}
			
			// Si un champ est vide
			else 
				page("CONNECTION", '<span class="erreur">Erreur : les données ne sont pas remplies</span>');
		}
		
		// Si un champ manque à l'appel
		else
			page("CONNECTION", '<span class="erreur">Erreur : il manque des données</span>');
	}

	// Cette fonction permet de supprimer un utilisateur
	function admin_supprimerMembre($id)
	{// $id sécurisé
		
		// On commence par se demander si l'utilisateur est administrateur
		$sql = "SELECT * FROM admin WHERE idAdmin = '".$id."'";
		$req = mysql_query($sql) or die(erreur_sql($sql));
		$count = mysql_num_rows($req); // On compte le nombre de lignes de résultat (0 ou 1)
		mysql_free_result($req);
		
		if($count == 0) // Si ce n'est pas un admin
		{
			// On le supprimme
			$sql = "DELETE FROM utilisateur WHERE idUtilisateur = '".$id."'";
			mysql_query($sql) or die(erreur_sql($sql));
			
			page("ADMIN_MEMBRES", "<span class=\"message\">Le membre n°".$id." à bien été supprimé</span>");
		}
		else // Si c'est un admin
			page("ADMIN_MEMBRES", "<span class=\"erreur\">Le membre n°".$id." est administrateur !</span>");
	}
?>