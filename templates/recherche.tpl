{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var="design" value="special/recherche"}
{/block}

{*
	result :
	- exact : tableau de produits
	- ressemble : tableau :
				  - indice
				  - produit
	- nbExact
	- nbRessemblant

*}

{* Le contenu de la page *}
{block name=content}
    <div id="page-resultats-recherche">
        <h1>Resultats recherche</h1>    
        <h2>Recherche exacte</h2>
		
		<div id="bloc_produits_exact" class="bloc_produits">
			{foreach from=$result.exact item=p}
				{* On affiche le titre, l'image et la description du produit *}
				<div class="produit">						
					<h4><a href="index.php?page=FICHEPRODUIT&amp;id={$p->getId()}">{$p->getNom()}</a></h4>
					{if $p->getImg() == null}
						<img src="{$smarty.const.image_defaut_produit}"
							 alt="produit" />
					{else}
						<img src="index.php?image={$p->getImg()->getId()}&amp;w=110&amp;h=110" 
							 alt="image : {$p->getImg()->getTitre()}"/>
					{/if}                
					<span class="prix_produit">
						{$p->getPrixVente()} €
					</span>                
				</div>
			{foreachelse}
				Pas de résultat exact
			{/foreach}
		</div>
		
		<h2>Voir aussi</h2>
		<div id="bloc_produits_ressemble" class="bloc_produits">
			{foreach from=$result.ressemble item=r}
				<div class="produit">	
					<!-- Indice : {$r.indice} -->
					{* On affiche le titre, l'image et la description du produit *}
					<div class="produit_trouve">				 
						<h4><a href="index.php?page=FICHEPRODUIT&amp;id={$r.produit->getId()}">{$r.produit->getNom()}</a></h4>
						{if $r.produit->getImg() == null}
							<img src="{$smarty.const.image_defaut_produit}"
								 alt="produit" />
						{else}
							<img src="index.php?image={$r.produit->getImg()->getId()}&amp;w=110&amp;h=110" 
								 alt="image : {$r.produit->getImg()->getTitre()}"/>
						{/if}                
						<span class="prix_produit">
							{$r.produit->getPrixVente()} €
						</span>                
					</div>
				</div>
			{foreachelse}
				Aucun resultat ressemblant
			{/foreach}
		</div>
    </div>
{/block}
