<?php
	session_start(); // Permet d'utiliser les sessions.
		
	require("Smarty\\Smarty.class.php"); // Contient Smarty
	require("classes\\Bob.class.php"); // Contient Bob
		
	$smarty = new Smarty();
	$smarty->caching = 0;
	$smarty->force_compile = 1;
	
	$bob = new Bob("localhost", 3306, "projet_bob", "root", "", $smarty);

	$bob->analyser();
	
	if($bob->estAction())
		$bob->executer();
	
	$bob->afficher();
	
?>