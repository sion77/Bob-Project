{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var="design" value="special/categorie"}
{/block}

{* Le contenu de la page *}
{block name=content}
    <div id="panneau-categories">
        {foreach from=$categories item=mere}        
                <div class="categorie">
                    {if $mere->getImg() == null}
						<img src="img/categorie-jardin.jpg" alt="Test categories"/>
					{else}
						<img src="index.php?image={$mere->getImg()->getId()}&amp;h=170&amp;w=225" 
						     alt="image {$mere->getNom()}"/>
					{/if}
                    <a href="index.php?page=SOUSCATEGORIES&amp;id={$mere->getId()}">{$mere->getNom()}</a>
                </div>        
        {/foreach}
    </div>
{/block}
