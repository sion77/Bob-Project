<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html 
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
                
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        {include file="modele/entete.tpl"}
        
    </head>
    <body>
        <div id="header">
         <div id="logo">
                    <a href="index.php">
                        <img src="img/logo.png" alt="Chez Bob"/>
                    </a>
                </div>
                    
            <div id="espace_haut">
                <div id="espace_membre">
                    {include file="modele/espace_membre.tpl"}
                </div>
                <div id="espace_recherche">
                    <!--    <img src="img/search_icon.jpg" alt="search_icon"/> -->
					<script type="text/javascript" src="js/clearrech.js"></script>
                    <form action="index.php" method="get">
						<input type="hidden" name="action" value="RECHERCHE" />
                        <input id="rechtext" type="text" name="recherche" value="Rechercher" onfocus="clearrechtext();" onblur="textout();"/>
                        <input type="submit" value="GO" />
                    </form>
                    <a href="index.php?page=RECHERCHE_AVANCEE" title="Recherche avancée">Recherche avancée</a>
                </div>
            </div>
        </div>
        <div id="body">
            <div id="menu">
                {include file="modele/menu.tpl"}
            </div>                            
            <div id="fastbar">
                
            </div>
            <div id="content">
                {if $message}
                    <p id="contenu_message">
                        {if $erreur}
                            <span class="erreur">Erreur : 
                        {else}
                            <span class="message">
                        {/if}
                            {$message}
                        </span>
                    <p>
                {/if}
                {block name=content}
                    Ici doit se trouver le contenu de la page.
                {/block}
            </div>                        
        </div>
        <div id="footer">
            <div id="sitemap">
                
            </div>
            <div id="credits_droits">
                Site crée par Sylafrs, Neo et RFK78 !
            </div>
            <div id="partenaires">                
                <img src="img/smarty_logo.png" alt="Utilise Smarty"/>
            </div>                        
        </div>
    </body>
</html>
