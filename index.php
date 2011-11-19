<?php
    /*
                     APPEL DES RESSOURCES
        -- inclusions, declarations et initialisations --
    */
    
    include("header.php");
        
    $smarty = new Smarty();     // Instance de Smarty
    $smarty->caching = 0;       // Desactive la mise en cache
    $smarty->force_compile = 1; // On demande de toujours compiler
 
    // Instance de Bob (hérité de PDO), ce sera notre interface avec les données du site
    $Bob = new Bob(database_host, database_port, database_name, 
                   database_user, database_pass); 
    
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
                                
                                case "EDITER":
                                    $template = "admin_categories";
                                    if(isset($_GET["id"]))
                                    {
                                        if($Bob->modifCategorie(intval($_GET["id"])))
                                        {
                                            $message = "Categorie modifiee avec succes";
                                        }
                                        else
                                        {
                                            $erreur = true;
                                            $message = $Bob->getErreur();
                                        }                                        
                                    }
                                    else
                                    {
                                        $erreur = true;
                                        $message = "ID de la categorie à modifier manquant";
                                    }                                    
                                break;
                                
                                case "SUPPR":
                                    $template = "admin_categories";
                                    if(isset($_GET["id"]))
                                    {
                                        if($Bob->supprCategorie(intval($_GET["id"])))
                                        {
                                            $message = "Categorie supprimée avec succes";
                                        }
                                        else
                                        {
                                            $erreur = true;
                                            $message = $Bob->getErreur();
                                        }                                        
                                    }
                                    else
                                    {
                                        $erreur = true;
                                        $message = "ID de la categorie à modifier manquant";
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
                    
                    /* Gestion des images */
                    case "IMAGES":
                        if(isset($_GET["action"]))
                        {
                            switch($_GET["action"])
                            {
                                case "UPLOAD":
                                    $template = "admin_images";
                                    if($Bob->uploadImage())
                                    {
                                        $message = "L'image est bien arrivée";
                                    }
                                    else
                                    {
                                        $erreur = true;
                                        $message = $Bob->getErreur();
                                    }
                                break;
                                
                                default:
                                    $template = "admin_images";
                                break;
                            }
                        }
                        
                        // Si on vient d'arriver sur la gestion des images
                        else                        
                            $template = "admin_images";
                        
                    break;
                    
                    case "PRODUITS":
                        $template = "admin_produits";
                        if(isset($_GET["action"]))
                        {
                            switch($_GET["action"])
                            {
                                case "CREER":
                                    if($Bob->creerProduit())
                                    {
                                        $message = "Le produit a bien été ajouté";
                                    }
                                    else
                                    {
                                        $erreur = true;
                                        $message = $Bob->getErreur();
                                    }
                                break;
                            }
                        }
                    break;
                    
                    /* Sinon, ou si on nous le demande explicitement */
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
                if(isset($_POST['recherche']))
                {
                    $Bob->recherche($_POST['recherche']);
                    $template = "recherche";
                    $message = "recherche effectuée!";
                }
                else
                {
                    $erreur = true;
                    $message = "Erreur recherche";
                    $template = ("accueil");
                }
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
            
            case "AJOUTECOMMENTAIRE":            
				if(!isset($_GET["id"]))
                {
                    $template = "accueil";
                    $message = "Id du produit manquant";
                    $erreur = true;
                }
                else
                {
                    $prod = $Bob->getProduit(intval($_GET["id"]));
                    if(!$prod)
                    {
                        $template = "accueil";
                        $message = "Produit non trouvé";
                        $erreur = true;
                    }
                    else
                    {        
						$smarty->assign("prod", $prod);
						$template = "fiche_produit"; 
							          
						if(!$Bob->creerCommentaire($prod))
						{
							$erreur = true;
							$message = $Bob->getErreur();
						}
						else
						{
							$message = "Commentaire bien ajouté";							  
						}                        
                    }
                }
            break;
                        
            /* Sinon, ou si on demande explicitement l'accueil */
            case "ACCUEIL":
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
            
            //Si on nous demande de déconnecter l'utilisateur
            case "DECONNECTION":            
                unset($_SESSION["connecte"]);
                session_destroy();
                $template = "accueil";
            break;    
                                            
            // Si on demande la page about
            case "ABOUT":
                $template = "about";
            break;
            
            // Si on demande la page about
            case "CONTACT":
                $template = "contact";
            break;
            
            //Si on nous demande d'afficher les catégories
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
            
            // La fiche d'un produit
            case "FICHEPRODUIT":
                if(!isset($_GET["id"]))
                {
                    $template = "accueil";
                    $message = "Id du produit manquant";
                    $erreur = true;
                }
                else
                {
                    $prod = $Bob->getProduit(intval($_GET["id"]));
                    if(!$prod)
                    {
                        $template = "accueil";
                        $message = "Produit non trouvé";
                        $erreur = true;
                    }
                    else
                    {                    
                        $smarty->assign("prod", $prod);
                        $template = "fiche_produit";   
                    }
                }
            break;
            
            // La recherche avancée
            case "RECHERCHE_AVANCEE":
                $template = "recherche_avancee";
            break;            
            
            // Sinon on affiche la page d'acceuil
            default:
                $template = "accueil";
            break;
        }
    }    

    // Si on veut generer une image
    elseif(isset($_GET["image"]))
    {
        $img = $Bob->getImage(intval($_GET["image"]));
        if($img != NULL)
        {
            if(isset($_GET["s"])) {                
                $h = $img->getHeight();
                $w = $img->getWidth();    
                $s = floatval($_GET["s"]);
                $img->setHeight(round($s*$h));
                $img->setWidth(round($s*$w));
            }
            else {
                if(isset($_GET["h"]))
                    $img->setHeight(intval($_GET["h"]));
                    
                if(isset($_GET["w"]))
                    $img->setWidth(intval($_GET["w"]));    
            }
            
            $img->generer();
            // -- Cette méthode met fin à l'execution du script -- //
        }
    }
    
    // Infos textuelle demandée
    elseif(isset($_GET["ajax"]))
    {
        switch($_GET["ajax"])
        {
            case "existe_membre":
                if(isset($_GET["pseudo"]))
                {
                    if($Bob->membreExiste($_GET["pseudo"]))
                    {
                        die(print("1"));
                    }
                    else
                    {
                        die(print("0"));
                    }
                }
                else
                {
                    die(print("Erreur"));
                }
            break;
            
            default:
                die(print("Erreur"));
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
        "categories" => $Bob->getCategories(),
        "images" => $Bob->getImages(),
        "produits" => $Bob->getProduits(),
        "commentaires" => $Bob->getCommentaires()
    ));
        
    // On affiche la page compilée à l'aide du template passé ici
    $smarty->display("templates\\".$template.".tpl");   
?>
