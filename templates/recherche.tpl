{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le contenu de la page *}
{block name=content}
    <div id="page-resultats-recherche">
        <h2>resultats recherche</h2>    
        <h3>Recherche exacte</h3>
		{foreach from=$result.exact item=p}
			{* On affiche le titre, l'image et la description du produit *}
			<div class="produit_trouve">				 
                <h4><a href="index.php?page=FICHEPRODUIT&amp;id={$p->getId()}">{$p->getNom()}</a></h4>
                {if $p->getImg() == null}
                    <img src="{$smarty.const.image_defaut_produit}"
                         alt="produit" />
                {else}
                    <img src="index.php?image={$p->getImg()->getId()}&amp;w=110&amp;h=110" 
                         alt="image : {$p->getImg()->getTitre()}"/>
                {/if}                
                <p>
                        {$p->getDesc()}
                </p>                
			</div>
		{foreachelse}
			Pas de résultat exact
		{/foreach}
		
		<h3>Voir aussi</h3>
        {foreach from=$result.ressemble item=r}
			<div class="produit_trouve">				
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
					<p>
							{$r.produit->getDesc()}
					</p>                
				</div>
			</div>
		{foreachelse}
			Aucun resultat ressemblant
		{/foreach}
		
    </div>
{/block}
