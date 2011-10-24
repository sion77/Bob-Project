<?php

	include_once("contenus.php");

	function contenu($nomPage)
	{
		switch($nomPage)
		{
			/* Panneau d'admin */
			case "ADMIN_ACCUEIL":
				include("html\\admin_accueil.html");
			break;
			
			case "ADMIN_MEMBRES":
				admin_listerMembres();
			break;
			
			case "ADMIN_CATEGORIES":
				admin_listerCategories();
			break;
			
			/* Inscription/Connection */
			
			case "INSCRIPTION":
				include("html\\inscription.html");
			break;
			
			case "CONNECTION":
				include("html\\connection.html");
			break;
			
			/* Parties du site */
			
			case "CATEGORIES":
				afficheCategories();
			break;
			
			case "SOUSCATEGORIES":
				if(isset($_GET["id"]))
					afficheSousCategories(intval($_GET["id"]));
				else
					afficheCategories();
			break;
			
			case "FICHEPRODUIT":
				afficheFicheProduit();
			break;
			
			case "ABOUT":
				include("html\\about.html");
			break;
			
			/* Accueil */
			
			case "ACCUEIL":
			default:
				include("html\\accueil.html");
			break;
		}
	}
?>