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
                    <img src="img/categorie-jardin.jpg" alt="Test categories"/>
                    <a href="index.php?page=SOUSCATEGORIES&amp;id={$mere->getId()}">{$mere->getNom()}</a>
                </div>        
        {/foreach}
    </div>
{/block}
