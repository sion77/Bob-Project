{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var='design' value="special/accueil"}
{/block}

{block name=script}
    {assign var='script' value="generatepub"}
{/block}

{*
	$bestSeller et $mostPopular sont deux tableaux contenant :
	- un tableau (num) des bestSellers/mostPopular --> tab
	- le nombre d'elements du tableau              --> nb
	- un nombre entre 0 et le nombre précédent	   --> rand
*}

{* Le contenu de la page *}
{block name=content}
    <div id="pub">
        <img src="img/test 960x200.jpg" alt="Merci de débloquer votre bloqueur de pubs pour la survie du site. Merci m_(-_-)_m" /> 
    </div>
    <div id="coup_coeur">
        <div class="boite_coup_coeur" id="best_seller">
            <h1> Meilleure vente du momment !</h1>
            <h3>{$bestSeller.tab[$bestSeller.rand]->getNom()|lower|capitalize}</h3>
            
            <img src="index.php?image={$bestSeller.tab[$bestSeller.rand]->getImg()->getId()}&amp;h=120&amp;w=120" 
				 alt="{$bestSeller.tab[$bestSeller.rand]->getImg()->getTitre()}" />
            
            <p>
				{$bestSeller.tab[$bestSeller.rand]->getDesc()}
			</p>
                
            <span id="prix_article_bestseller" class="prix_article_coup_coeur">
				{$bestSeller.tab[$bestSeller.rand]->getPrixVente()} 
			€</span>  
            <span id="voirficheproduit_bestseller" class="voirficheproduit_coup_coeur">
				<a href='index.php?page=FICHEPRODUIT&id={$bestSeller.tab[$bestSeller.rand]->getId()}'>
					Voir la fiche produit
				</a>
			</span>
        </div>
        
        <div class="boite_coup_coeur" id="most_popular">        
			<h1>Conseillé par BricoBob !</h1>
            <h3>{$mostPopular.tab[$mostPopular.rand]->getNom()|lower|capitalize}</h3>
            <img id="img_most_popular" 
			     src="index.php?image={$mostPopular.tab[$mostPopular.rand]->getImg()->getId()}&amp;h=120&amp;w=120" 
				 alt="alt="{$mostPopular.tab[$mostPopular.rand]->getImg()->getTitre()}" />
                        
            <p>
				{$mostPopular.tab[$mostPopular.rand]->getDesc()}
			</p>
                
            <span id="prix_article_most_popular" class="prix_article_coup_coeur">
				{$mostPopular.tab[$mostPopular.rand]->getPrixVente()} 
			€</span> 
            <span id="voirficheproduit_most_popular" class="voirficheproduit_coup_coeur">
				<a href='index.php?page=FICHEPRODUIT&id={$mostPopular.tab[$mostPopular.rand]->getId()}'>
					Voir la fiche produit
				</a>
			</span>        
        </div>
    </div>
{/block}
