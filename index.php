<?php
	session_start();
	
	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("projet_bob", $link);
	
	include_once("php\\fonctions.php");
	include_once("php\\page.php");
	
	if(isset($_GET["action"]))
	{
		switch($_GET["action"])
		{
			case "INSCRIPTION":
				inscription();
			break;
			
			case "CONNECTION":
				connection();
			break;
			
			case "DECONNECTION":
				unset($_SESSION["connecte"]);
				session_destroy();
				page("ACCEUIL");
			break;	
			case "CATEGORIES":
				page("CATEGORIES");
			break;
			default:
				page("ACCUEIL");
			break;
		}
	}

	elseif(isset($_GET["page"]))
	{
		switch($_GET["page"])
		{
			case "INSCRIPTION":
				page("INSCRIPTION");
			break;
			
			case "CONNECTION":
				page("CONNECTION");
			break;
			
			default:
				page("ACCUEIL");
			break;
		}
	}
	else
	{
		page("ACCEUIL");
	}	
	
	mysql_close($link);
?>