<?php
	session_start();
	
	include_once("page.php");

	if(isset($_GET["page"]))
	{
		switch($_GET["page"])
		{
			
			default:
				page("ACCUEIL");
			break;
		}
	}
	else
	{
		page("ACCEUIL");
	}	
?>