<?php
    /*
                     APPEL DES RESSOURCES
        -- inclusions, declarations et initialisations --
    */
    
 // session_save_path("mes_zolies_sessions");        // Endroit de sauvegarde des sessions
 // session_name("J'aime les nouilles au beurre");   // Nom de la session
    session_start();                                 // Permet d'utiliser les sessions.

    require("Smarty\\Smarty.class.php"); // Contient Smarty
    require("classes\\Bob.class.php");   // Contient Bob
        
    $smarty = new Smarty();     // Instance de Smarty
    $smarty->caching = 0;       // Desactive la mise en cache
    $smarty->force_compile = 1; // On demande de toujours compiler
    
    $Bob = new Bob("localhost", 3306, "projet_bob", "root", ""); // Instance de Bob (hérité de PDO), ce sera notre interface avec les données du site
    
    $template = "accueil"; // Template qui sera utilisé (modifié dans le code ci-dessous)
    $message = false;      // Pas de message (au départ)
    $erreur = false;       // Par défaut, s'il y a un message, ce n'est pas une erreur
    
    /*
        DEBUT DU PROGRAMME PRINCIPAL
        -- traitement des données --
    */

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
                                    {
                                        $Bob->supprimerMembre(intval($_GET["id"]));
                                    }
                                    else
                                    {
                                        $template = "admin_membres";
                                        $message = "id non renseigné";
                                        $erreur = true;
                                    }                                    
                                break;
                                
                                // Promouvoir un membre (au rang d'admin)
                                case "PROMO":
                                    if(isset($_GET["id"]))
                                    {
                                        $Bob->promoMembre(intval($_GET["id"]));
                                    }
                                    else
                                    {
                                        $template = "admin_membres";
                                        $message = "id non renseigné";
                                        $erreur = true;
                                    }
                                break;
                                
                                // Sinon
                                default:                                    
                                    $template = "admin_membres";
                                break;
                            }
                        }
                        
                        // Si on vient d'arriver sur la gestion des membres
                        else
                            $template = "admin_membres";
                    break;
                    
                    /* Gestion des categories */
                    case "CATEGORIES" :                         
                        
                        // Si on nous demande de faire quelque chose
                        if(isset($_GET["action"]))
                        {
                            switch($_GET["action"])
                            {
                                case "CREER":
                                    $template = "admin_categories";
                                    if($Bob->creerCategorie())
                                    {
                                        $message = "Catégorie ajoutée avec succès";
                                    }
                                    else
                                    {
                                        $erreur = true;
                                        $message = $Bob->getErreur();
                                    }
                                break;
                                
                                default:
                                    $template = "admin_categories";
                                break;
                            }
                        }
						
						elseif(isset($_GET["page"]))
						{
							switch($_GET["page"])
							{
								case "EDITER":
									if(isset($_GET["id"]))
									{
										$template = "admin_editer_categorie";
									}
									else
									{	
										$template = "admin_categories";
										$erreur = true;
										$message = "Id de la catégorie manquante";
									}
								break;
								
								case "ACCUEIL":
								default:
                                    $template = "admin_categories";
                                break;
							}
						}
                        
                        // Si on vient d'arriver sur la gestion des catégories
                        else
                            $template = "admin_categories";
                    break;
                    
                    /* Sinon, ou si on demande explicitement l'accueil */
                    case "ACCUEIL":
                    default:
                        $template = "admin";
                    break;
                }
            }
            else
                $template = "accueil";
        }
        else
            $template = "accueil";
    }
    
    // Si on nous demande de faire quelque chose 
    elseif(isset($_GET["action"])) 
    {
        switch($_GET["action"]) 
        {
            // Si on veut faire une recherche rapide
            case "RECHERCHE":
                $erreur = true;
                $message = "Fonction non implémentée";
                $template = "accueil";
            break;
        
            // Si on nous demande d'inscrire un utilisateur
            case "INSCRIPTION":                
                if(isset($_POST["pseudo"]) && isset($_POST["pass"]) && isset($_POST["pass2"]))
                {    
                    if($membre = $Bob->inscription($_POST["pseudo"], $_POST["pass"], $_POST["pass2"]))
                    {
                        $Bob->connection($_POST["pseudo"], $_POST["pass"]);
                        $template = "accueil";
                        $message = "Votre inscription s'est déroulée avec succès";                                    
                    }
                    else
                    {
                        $template = "inscription";
                        $message = $Bob->getErreur();
                        $erreur = true;
                    }
                }        
                else
                {
                    $template = "inscription";
                    $erreur = true;
                    $message = "Données manquantes";
                }
            break;
            
            // Si on nous demande de connecter l'utilisateur
            case "CONNECTION":
                if(isset($_POST["pseudo"]) || isset($_POST["pass"]))
                {    
                    if($membre = $Bob->connection($_POST["pseudo"], $_POST["pass"]))
                    {
                        $template = "accueil";
                    }
                    else
                    {
                        $template = "connection";
                        $erreur = true;
                        $message = $Bob->getErreur();
                    }
                }
                else
                {                            
                    $template = "connection";
                    $message = "Il manque des données";
                    $erreur = true;
                }
            break;
            
            // Si on nous demande de déconnecter l'utilisateur
            case "DECONNECTION":            
                unset($_SESSION["connecte"]);
                session_destroy();
                $template = "accueil";
            break;    
                        
            // Sinon retour a l'accueil
            default:
                $template = "accueil";
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
				if(!isset($_SESSION["connecte"]))
				{
					$template = "inscription";
				}
				else
				{
					$template = "accueil";
					$erreur = true;
					$message = "Vous êtes déjà inscrit : vous êtes même connecté !";
				}
            break;
            
            // On affiche le formulaire de connection
            case "CONNECTION":
				if(!isset($_SESSION["connecte"]))
				{
					$template = "connection";
				}
				else
				{
					$template = "accueil";
					$erreur = true;
					$message = "Vous êtes déjà connecté";
				}
            break;
            
            // Si on demande la page about
            case "ABOUT":
                $template = "about";
            break;
            
            // Si on nous demande d'afficher les catégories
            case "CATEGORIES":
                $template = "categories";                
            break;
            
            // Si on nous demande d'afficher les sous-catégories
            case "SOUSCATEGORIES":
                if(isset($_GET["id"]))
                {
                    $sc = $Bob->getCategorie(intval($_GET["id"]));
                    if($sc != false)
                    {                        
                        $smarty->assign("sc", $sc);
                        $template = "sous_categories";
                    }
                    else
                    {
                        $erreur = true;
                        $message = "cet id n'est pas attribué";
                        $template = "categories";
                    }
                }
                else
                {
                    $erreur = true;
                    $message = "Il manque l'id de la categorie";
                    $template = "categories";
                }
            break;
            
            // La fiche d'un produit
            case "FICHEPRODUIT":
                $template = "fiche_produit";
            break;
            
            // Sinon on affiche la page d'acceuil
            default:
                $template = "accueil";
            break;
        }
    }
    
    // Si on vient tout juste de se connecter sur le site 
    else
    {
        $template = "accueil";
    }
    
    /*
           AFFICHAGE DE LA PAGE 
        -- resultat du traitement --
    */
    
    // On passe les variables à smarty
    $smarty->assign(array(
        "erreur" => $erreur,
        "message" => $message,
        "connecte" => isset($_SESSION["connecte"]),
		"Bob" => $Bob,
		"membres" => $Bob->getMembres(),
		"categories" => $Bob->getCategories()
    ));
        
    // On affiche la page compilée à l'aide du template passé ici
    $smarty->display("templates\\".$template.".tpl");    
?>