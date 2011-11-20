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
             
                {* Pour chaque parent, on ajoute un lien pour revenir en arrière *}
                {if !$smarty.foreach.fastbar.last}
					{if isset($smarty.get.offre)}
						{assign var=lien value="index.php?page=SOUSCATEGORIES&amp;id={$cat->getId()}&amp;offre={$smarty.get.offre}"}
					{else}
						{assign var=lien value="index.php?page=SOUSCATEGORIES&amp;id={$cat->getId()}"}
					{/if}
                    {if !$smarty.foreach.fastbar.first}
                        <span id="sous-categorie-fiche-produit">
                            <a href="{$lien}">
                                {$cat->getNom()|lower|capitalize}</a> 
                            >
                        </span>
                    {else}
                        <span id="categorie-fiche-produit">
                            <a href="{$lien}">
                                {$cat->getNom()|upper}</a> 
                            >
                        </span>
                    {/if}
                {else}
                    {if !$smarty.foreach.fastbar.first}
                        <span id="sous-categorie-fiche-produit">
                            {$cat->getNom()|lower|capitalize}
                        </span>
                    {else}
                        <span id="categorie-fiche-produit">
                            {$cat->getNom()|upper}
                        </span>
                    {/if}
                {/if}
            {/foreach}
        </h2>            
        <img src="img/pub-ideejardin.jpg" alt="Test categories"/>
        <div id="blocs-sous-categories">
            {* Bloc categorie *}
            {foreach from=$sc->getFils() item=f}
            
                {* On affiche le titre, l'image et la description de la catégorie *}
                <div class="sous-categorie">            
                    <h4>
						{if isset($smarty.get.offre)}
							<a href="index.php?page=SOUSCATEGORIES&amp;id={$f->getId()}&amp;offre={$smarty.get.offre}">
						{else}
							<a href="index.php?page=SOUSCATEGORIES&amp;id={$f->getId()}">
						{/if}
							{$f->getNom()}
						</a>
					</h4>
                    {if $f->getImg() == null}
                        <img src="{$smarty.const.image_defaut_sous_categorie}"
                             alt="categorie" />
                    {else}
                        <img src="index.php?image={$f->getImg()->getId()}&amp;w=110&amp;h=110" 
                             alt="image : {$f->getImg()->getTitre()}"/>
                    {/if}                
                    <p>
                        {$f->getDesc()}
                    </p>           
                </div>            
            {/foreach}
        </div>
        <div id="blocs-produits">
        
            {* Bloc produit *}
            {foreach from=$sc->getProduits() item=f}
            {if (!isset($smarty.get.offre) ||
			     ($f->getPrixLocation() > 0 && $smarty.get.offre == "location") ||
			     ($f->getPrixVente() > 0 && $smarty.get.offre == "achat"))}
				
                {* On affiche le titre, l'image et la description de la catégorie *}
                <div class="produit">            
                    <h4>
						{if isset($smarty.get.offre)}
							<a href="index.php?page=FICHEPRODUIT&amp;id={$f->getId()}&offre={$smarty.get.offre}">
						{else}
							<a href="index.php?page=FICHEPRODUIT&amp;id={$f->getId()}">
						{/if}
							{$f->getNom()|lower|capitalize}
						</a>
					</h4>
                    {if $f->getImg() == null}
                        <img src="{$smarty.const.image_defaut_sous_categorie}"
                             alt="categorie" style="height: 110px; width: 100px;" />
                    {else}
                        <img src="index.php?image={$f->getImg()->getId()}&amp;h=110&amp;w=110" 
                             alt="image : {$f->getImg()->getTitre()}"/>
                    {/if}                
                    <span class="prix_produit">
						{if isset($smarty.get.offre)}
							{if $smarty.get.offre == "location"}
								{$f->getPrixLocation()} €
							{else}
								{$f->getPrixVente()} €
							{/if}							
						{else}
							{$f->getPrixVente()} €
						{/if}
                    </span>           
                </div>   
			{/if}
            {/foreach}    
        </div>          
    </div>
{/block}
