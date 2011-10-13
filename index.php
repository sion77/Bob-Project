<?php
	session_start(); // Permet d'utiliser les sessions.
	
	$link = mysql_connect("localhost", "root", ""); // Se connecte à une bdd en localhost
	mysql_select_db("projet_bob", $link); // Nom de la base
	
	include_once("php\\fonctions.php"); // Contient les fonctions manipulant la BDD
	include_once("php\\page.php");      // Contient la fonction page et ses sous-fonctions (comme contenu)
	                                    // Et les fonctions de contenus contenues dans contenus.php

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
					/* Gestion des membres */
					case "MEMBRES":
					
						// Si on nous demande de faire quelque chose
						if(isset($_GET["action"]))
						{
							switch($_GET["action"])
							{
								// Supprimer un membre
								case "SUPPRIMER":
									if(isset($_GET["id"]))
										admin_supprimerMembre(intval($_GET["id"]));
									else
										page("ADMIN_MEMBRES", '<span class="erreur">Erreur : id non renseigné</span>');
								break;
								
								// Sinon
								default:
									page("ADMIN_MEMBRES");
								break;
							}
						}
						
						// Si on vient d'arriver sur la gestion des membres
						else
							page("ADMIN_MEMBRES");
					break;
					
					/* Gestion des categories */
					case "CATEGORIES" : 
						page("ADMIN_CATEGORIES");
					break;
					
					/* Sinon, ou si on demande explicitement l'accueil */
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
			// Si on veut faire une recherche rapide
			case "RECHERCHE":
				page("ACCUEIL", '<span class="erreur">Fonction non implémentée</span>'); // Pas pour le moment
			break;
		
			//Si on nous demande d'inscrire un utilisateur
			case "INSCRIPTION":
				if(isset($_POST["pseudo"]) && isset($_POST["pass"]) && isset($_POST["pass2"]))
				{
					$ok = Membre::inscription($_POST["pseudo"], $_POST["pass"], $_POST["pass2"]); 
					if($ok)
					{
						page("ACCUEIL");
					}
					else
					{
						page("ACCEUIL", '<span class="Error">'.Membre::get_erreur().'</span>');
					}
				}
				else
					page("INSCRIPTION", '<span class="Error">Erreur : données manquantes</span>');
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
			// Si on veut faire une recherche rapide
			case "RECHERCHE_ACCUEIL":
				page("ACCUEIL", '<span class="erreur">Fonction non implémentée</span>'); // Pas pour le moment
			break;
			
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