<?php
	session_start();
	
	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("projet_bob", $link);
	
	include_once("php\\fonctions.php");
	include_once("php\\page.php");

	// Accès au panneau d'admin
	if(isset($_GET["admin"]))
	{
		// Que si on est connecte
		if(isset($_SESSION["connecte"]) && isset($_SESSION["admin"]))
		{
			// Que si on est admin
			if($_SESSION["admin"] == true)
			{
				// Selon ce que l'on veut faire..
				switch($_GET["admin"])
				{
					case "MEMBRES":
						page("ADMIN_MEMBRES");
					break;
				
					case "ACCUEIL":
					default:
						page("ADMIN_ACCUEIL");
					break;
				}
			}
			else
				page("ACCUEIL");
		}
		else
			page("ACCUEIL");
	}
	
	//Si on nous demande de faire quelque chose 
	elseif(isset($_GET["action"])) 
	{
		switch($_GET["action"]) 
		{
			//Si on nous demande d'inscrire un utilisateur
			case "INSCRIPTION":
				inscription(); 
			break;
			
			//Si on nous demande de connecter l'utilisateur
			case "CONNECTION":
				connection();
			break;
			
			//Si on nous demande de déconnecter l'utilisateur
			case "DECONNECTION":
				unset($_SESSION["connecte"]);
				session_destroy();
				page("ACCEUIL");
			break;	
			
			//Si on nous demande d'afficher les catégories
			case "CATEGORIES":
				page("CATEGORIES");
			break;
			
			//Si on nous demande d'afficher les sous-catégories
			case "SOUSCATEGORIES":
				page("SOUSCATEGORIES");
			break;
			
			case "FICHEPRODUIT":
				afficheFicheProduit();
			break;
			
			// Si on demande la page about
			case "ABOUT":
				page("ABOUT");
			break;
			
			//Sinon retour a l'accueil
			default:
				page("ACCUEIL");
			break;
		}
	}
	
	// Si l'adresse est de la forme http://bob-poject.com/index.php?page=XXX
	elseif(isset($_GET["page"]))
	{
		switch($_GET["page"])
		{	
			// On affiche le formulaire d'inscription
			case "INSCRIPTION":
				page("INSCRIPTION");
			break;
			
			// On affiche le formulaire de connection
			case "CONNECTION":
				page("CONNECTION");
			break;
			
			// Si on demande la page about
			case "ABOUT":
				page("ABOUT");
			break;
			
			//Si on nous demande d'afficher les catégories
			case "CATEGORIES":
				page("CATEGORIES");
			break;
			
			//Si on nous demande d'afficher les sous-catégories
			case "SOUSCATEGORIES":
				page("SOUSCATEGORIES");
			break;
			
			case "FICHEPRODUIT":
				page("FICHEPRODUIT");
			break;
			
			// Sinon on affiche la page d'acceuil
			default:
				page("ACCUEIL");
			break;
		}
	}
	
	// Si on vient tout juste de se connecter sur le site 
	else
	{
		page("ACCEUIL");
	}	
	
	mysql_close($link);
?>