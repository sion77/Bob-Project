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
                        <img src="{$smarty.const.image_defaut_categorie}" alt="Test categories"/>
                    {else}
                        <img src="index.php?image={$mere->getImg()->getId()}" 
                             alt="{$mere->getNom()}"/>
                    {/if}
					{if isset($smarty.get.offre)}
						<a href="index.php?page=SOUSCATEGORIES&amp;id={$mere->getId()}&amp;offre={$smarty.get.offre}">{$mere->getNom()}</a>
					{else}
						<a href="index.php?page=SOUSCATEGORIES&amp;id={$mere->getId()}">{$mere->getNom()}</a>
					{/if}
				</div>        
        {/foreach}
    </div>
{/block}
