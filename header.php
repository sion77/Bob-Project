<?php
	/*------------- Sessions ------------------*/
 
 // session_save_path("mes_zolies_sessions");        // Endroit de sauvegarde des sessions
 // session_name("J'aime les nouilles au beurre");   // Nom de la session
    session_start();                                 // Permet d'utiliser les sessions.
		
	/*------------- Constantes ----------------*/

	// Informations relatives à la BDD
	define("database_host", "localhost");  // Le serveur contenant la base de donnée
	define("database_port", 3306);         // Le port du serveur sur lequel se connecter
	define("database_name", "projet_bob"); // Le nom de la base de donnée
	define("database_user", "root");       // Le nom d'utilisateur
	define("database_pass", "");           // Le mot de passe de l'utilisateur
	
	// Informations relatives aux images
	define("image_defaut_categorie", "img/catego.jpg"); // Image par défaut utilisée pour une catégorie
	
	/*------- Inclusion des classes -----------*/
	
	require("Smarty\\Smarty.class.php");     // Contient Smarty
	require("classes\\Image.class.php");     // Contient Image
    require("classes\\Membre.class.php");    // Contient Membre
    require("classes\\Categorie.class.php"); // Contient Categorie
	require("classes\\Produit.class.php");   // Contient Produit
    require("classes\\Bob.class.php");       // Contient Bob
		    
?>