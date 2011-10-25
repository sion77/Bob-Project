<?php
	session_start(); // Permet d'utiliser les sessions.
		
	require("Smarty\\Smarty.class.php"); // Contient Smarty
	include_once("php\\fonctions.php"); // Contient les fonctions manipulant la BDD
	include_once("php\\page.php");      // Contient la fonction page et ses sous-fonctions (comme contenu)
	                                    // Et les fonctions de contenus contenues dans contenus.php
										
	include_once("php\\classes\\Bob.php");
		
	$smarty = new Smarty();
	$smarty->caching = 0;
	$smarty->force_compile = 1;
	
	$bob = new Bob("localhost", 3306, "projet_bob", "root", "", $smarty);

	$bob->analyser();
	
	if($bob->estAction())
		$bob->executer();
	
	$bob->afficher();
	
?>