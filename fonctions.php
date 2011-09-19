<?php

	function inscription()
	{
		if(isset($_POST["pseudo"]) && isset($_POST["pass"]) && isset($_POST["pass2"]))
		{
		
		}
		else
			page("INSCRIPTION", "Erreur : données manquantes");
	}

?>