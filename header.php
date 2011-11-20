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
    define("image_defaut_categorie", "img/catego.jpg");            // Image par défaut utilisée pour une catégorie
    define("image_defaut_sous_categorie", image_defaut_categorie); // Image par défaut utilisée pour une sous catégorie
    
    // Configuration de la recherche
	define("RECHERCHE_ECART", 3);        // Ecart avec l'indice max (non exact) pour etre accepte
	define("RECHERCHE_MARGE_ERREUR", 5); // Indice min pour etre considere comme ressemblant
	
	/*------- Inclusion des classes -----------*/
    
    require("Smarty/Smarty.class.php");       // Contient Smarty
    require("classes/Image.class.php");       // Contient Image
    require("classes/Membre.class.php");      // Contient Membre et Admin
    require("classes/Categorie.class.php");   // Contient Categorie
    require("classes/Commentaire.class.php"); // Contient Commentaire et Reponse
    require("classes/Produit.class.php");     // Contient Produit
    require("classes/Bob.class.php");         // Contient Bob
	
	/*--------- Fonctions usuelles -----------*/
	
	/* function traduitDate()
	{
	
	} */
	
	function compare($str1, $str2)
	{
		$s1 = str_split($str1); // Le tableau de caracteres de str1
		$s2 = str_split($str2); // Le tableau de caracteres de str2
		$t1 = strlen($str1);    // taille de s1
		$t2 = strlen($str2);    // taille de s2
		
		$cpt = 0;                        // ' l'indice de ressemblance '
		$min = ($t1 > $t2) ? $t2 : $t1;	 // La taille du plus petit tableau
		
		// A l'endroit
		$i = 0; // Position parcourue		
		while($i < $min)
		{
			if($s1[$i] == $s2[$i]) // Même caractere au même endroit
				$cpt++;
			$i++;
		}
		
		// Puis à l'envers
		$tt1 = $t1 - 1; // Indice parcouru pour s1
		$tt2 = $t2 - 1; // Indice parcouru pour s2
		$i = 0;         // Nombre de cases parcourues
		while($i < $min)
		{
			if($s1[$tt1] == $s2[$tt2]) // Même caractere au même endroit (en partant de la fin)
				$cpt++;
				
			$i++;
			$tt1--;
			$tt2--;
		}
		
		// On retourne l'indice
		return $cpt;
	}              
?>
