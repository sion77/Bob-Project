<?php

	include_once("contenus.php");

	function contenu($nomPage)
	{
		switch($nomPage)
		{
			/* Panneau d'admin */
			case "ADMIN_ACCUEIL":
				include("html\\admin_accueil.html");
			break;
			
			case "ADMIN_MEMBRES":
				admin_listerMembres();
			break;
			
			case "ADMIN_CATEGORIES":
				admin_listerCategories();
			break;
			
			/* Inscription/Connection */
			
			case "INSCRIPTION":
				include("html\\inscription.html");
			break;
			
			case "CONNECTION":
				include("html\\connection.html");
			break;
			
			/* Parties du site */
			
			case "CATEGORIES":
				afficheCategories();
			break;
			
			case "SOUSCATEGORIES":
				if(isset($_GET["id"]))
					afficheSousCategories(intval($_GET["id"]));
				else
					afficheCategories();
			break;
			
			case "FICHEPRODUIT":
				afficheFicheProduit();
			break;
			
			case "ABOUT":
				include("html\\about.html");
			break;
			
			/* Accueil */
			
			case "ACCUEIL":
			default:
				include("html\\accueil.html");
			break;
		}
	}
	
	function espaceMembre()
	{
		// Non connecté
		if(!isset($_SESSION["connecte"]))
		{
			?>
				
				<span class="etat-co-espace-membre">
					Vous n'êtes pas connecté, veuillez vous <a href="index.php?page=CONNECTION">Connecter</a>
					ou vous <a href="index.php?page=INSCRIPTION">Inscrire !</a>
				</span>
				
			<?php
		}
				
		// Connecté
		else
		{
			echo $_SESSION["pseudo"];
			if($_SESSION["admin"] == true)
			{
				?>
					<a href="index.php?admin=ACCUEIL">Administrer</a>
				<?php
			}
			?>
				<a href="index.php?action=DECONNECTION">Deconnection</a>
			<?php
		}
	}
	
	function menu()
	{
		?>
			<ul id="menu">
				<li><a href='index.php?page=CATEGORIES'>Acheter</a>
					<ul class="sous-menu">
						<span class="first-elem-sous-menu"><li><a href='index.php?page=SOUSCATEGORIES&amp;id=1'>Jardin</a></li></span>
						<li><a href='#'>Menuiserie</a></li>
						<li><a href='#'>Sols</a></li>
						<li><a href='#'>Quilcaillerie</a></li>
						<span class="last-elem-sous-menu"><li><a href='#'>Peinture</a></li></span>
					</ul>
				</li>
				<li><a href='index.php?page=CATEGORIES-LOCATION'>Louer</a>
					<ul class="sous-menu">
						<span class="first-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<li><a href='#'>Porn Pics</a></li>
						<span class="last-elem-sous-menu"><li><a href='#'>Porn Pics</a></li></span>
					</ul>
				</li>
				<li><a href='index.php?page=ABOUT'>Contact</a>
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
						<div id="espace_haut">
							<div id="logo">
								<a href="index.php">
									<img src="img/logo.jpg" alt="Chez Bob"/>
								</a>
							</div>
						
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
							Site crée par Sylafrs, Neo et RFK78 !
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