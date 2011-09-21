<?php

	include_once("contenus.php");

	function contenu($nomPage)
	{
		switch($nomPage)
		{
			case "INSCRIPTION":
				include(".\\html\\inscription.html");
			break;
			
			case "ACCUEIL":
			default:
				include(".\\html\\accueil.html");
			break;
		}
	}
	
	function espaceMembre()
	{
		// Non connecté
		if(!isset($_SESSION["connecte"]))
		{
		}
				
		// Connecté
		else
		{
		
		}
	}
	
	function menu()
	{
		?>
			<ul id="menu">
				<li><a href='#'>Acheter</a>
					<ul class="sous-menu">
						<span class="first-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
						<li><a href='#'>Porn Pics</a></li>
						<span class="last-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
					</ul>
				</li>
				<li><a href='#'>Louer</a>
					<ul class="sous-menu">
						<span class="first-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<span class="last-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
					</ul>
				</li>
				<li><a href='#'>Contact</a>
					<ul class="sous-menu">
						<span class="first-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<span class="last-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
					</ul>
				</li>
				<li><a href='#'>Donate !</a>
					<ul class="sous-menu">
						<span class="first-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<span class="last-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
					</ul>
				</li>
			</ul>
		<?php
	}
	
	function plan()
	{
	
	}

	function page($nomPage, $message = "")
	{
		?>
			<?xml version="1.0" encoding="UTF-8"?>

			<!DOCTYPE html 
				PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
				"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
				
			<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<meta http-equiv="pragma"		content="no-cache"				   />
					<link rel="stylesheet" media="screen" href="style.css" type="text/css"/>
					<title>Site - Chez Bob</title>
				</head>
				<body>
					<div id="header">
						<div id="logo">
							<a href="index.php">
								<img src="img/logo.jpg" alt="Chez Bob"/>
							</a>
						<div id="espace_haut">
							<div id="espace_membre">
								<?php espaceMembre(); ?>
							</div>
							<div id="espace_recherche">
								<!--	<img src="img/search_icon.jpg" alt="search_icon"/> -->
									<!-- GET pour pouvoir retourner à un résultat de recherche aisément -->
									<form action="index.php" method="get">
										<input type="text" name="recherche" value="Rechercher" />
										<input type="hidden" name="page" value="recherche" />
										<input type="submit" value="GO" />
									</form>
								<a href="search.php" title="Recherche avancée">Recherche avancée</a>
							</div>
						</div>
					</div>
					<div id="body">
						<div id="menu">
							<?php menu(); ?>
						</div>							
						<div id="fastbar">
						
						</div>
						<div id="content">
							<?php 
								if($message != "")
								{
									echo "<p id=\"contenu_message\">".$message."<p>";
								}
								contenu($nomPage); 
							?>
						</div>						
					</div>
					<div id="footer">
						<div id="sitemap">
						
						</div>
						<div id="credits_droits">
							Site crée par Sylafrs, {Thomas LEVASSEUR} et DIEU
						</div>
						<div id="partenaires">
						
						</div>						
					</div>
					<script type="text/javascript" src="script.js"></script>
				</body>
			</html>
		<?php
	}

?>