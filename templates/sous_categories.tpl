{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var="design" value="special/sous-categorie"}
{/block}

{* Le contenu de la page *}
{block name=content}
    <div id="page-sous-categories">
		{* La fastbar dans le titre *}
        <h2>
			{* Le path : tableau des parents *}
			{assign var="path" value=$sc->getPath()}
			
			{* Pour chaque parent (jusqu'à soi) *}
			{foreach from=$path item=cat name="fastbar"} 
			
				{* Entre chaque categorie, on ajoute un '>' *}
				{if !$smarty.foreach.fastbar.first}	
					>
				{/if}
				
				{* Pour chaque parent, on ajoute un lien pour revenir en arrière *}
				{if !$smarty.foreach.fastbar.last}
					<a href="index.php?page=SOUSCATEGORIES&amp;id={$cat->getId()}">{$cat->getNom()}</a> 
				{else}
					{$cat->getNom()}
				{/if}
			{/foreach}
		</h2>            
        <img src="img/pub-ideejardin.jpg" alt="Test categories"/>
                
        {* Bloc categorie *}
        {foreach from=$sc->getFils() item=f}
        
            {* On affiche le titre, l'image et la description de la catégorie *}
            <div class="sous-categorie">            
                <h4><a href="index.php?page=SOUSCATEGORIES&amp;id={$f->getId()}">{$f->getNom()}</a></h4>
                <img src="img/souscat-tondeuses.jpg" alt="Test categories"/>
                <p>
                    {$f->getDesc()}
                </p>
                <a href='#'>Voir les autres produits</a>                
            </div>            
        {/foreach}            
    </div>
{/block}
