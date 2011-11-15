{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
	{assign var='design' value="special"}
{/block}

{* Le contenu de la page *}
{block name="content"}
	<div id="panneau-gestion-categories">
    <div id="admin_creer_categorie">
        <h1>Ajouter une nouvelle catégorie</h1>
		
        <form action="index.php?admin=CATEGORIES&amp;action=CREER" method="POST">
        <p style="text-align: center;">
            <label for="titre">Le titre : </label>
            <input type="text" id="titre" name="titre" />
            <br/><br/>
            
            <label for="desc">Description : </label><br/>
            <textarea id="desc" name="desc" cols="70" rows="10"></textarea>
            <br/><br/>
            
            <label for="mere">Attacher à : </label>
            <select id="mere" name="mere">
                <option value="NULL">(categorie mère)</option>
                {foreach from=$categories item=cat} 
                    {$cat->afficheOption()}
                {/foreach}
            </select>
            <br/><br/>
			
			<label for="image">Image : </label>
            <select id="image" name="image">
                <option value="NULL">(image par défaut)</option>
                {foreach from=$images item=img} 
                    <option value="{$img->getId()}">{$img->getTitre()}</option>
                {/foreach}
            </select>
            <br/><br/>
            
            <input type="submit" value="Creer"/>
        </p>
        </form>
    </div>
    <div id="admin_edit_categories">
        <h1>Editer une catégorie</h1>
        <div id="admin_arbre_categories">
            <ul>
                {foreach from=$categories item=cat} 
                    {$cat->afficheListe()}
                {/foreach}
            </ul>
        </div>
    </div>
	</div>
{/block}
