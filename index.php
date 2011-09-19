<?php
	session_start();
	
	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("projet_bob", $link);
	
	include_once("fonctions.php");
	include_once("page.php");
	
	if(isset($_GET["action"]))
	{
		switch($_GET["action"])
		{
			case "INSCRIPTION":
				inscription();
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