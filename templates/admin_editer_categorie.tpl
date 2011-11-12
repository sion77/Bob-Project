{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{* Pas de design supplémentaire *}

{* Le contenu de la page *}
{block name="content"}
	{assign var="cat" value=$Bob->getCategorie($smarty.get.id)}
    <div id="admin_editer_categorie">
        <h1>Editer une catégorie</h1>
        <form method="POST" action="index.php?admin=CATEGORIES&amp;action=EDITER&amp;id={$cat->getId()}">
		<p style="text-align: center;">
            <label for="titre">Le titre : </label>
            <input type="text" id="titre" name="titre" value="{$cat->getNom()}"/>
            <br/><br/>
            
            <label for="desc">Description : </label><br/>
            <textarea id="desc" name="desc" cols="70" rows="10">{$cat->getDesc()}</textarea>
            <br/><br/>
            
            <label for="mere">Attacher à : </label>
            <select id="mere" name="mere">
				<optgroup label="Avant">
					<option value="{$cat->getMere()}">{$cat->affichePath()}</option>
				</optgroup>
				<optgroup label="Modifier">
					<option value="NULL">(categorie mère)</option>
					{foreach from=$categories item=cat} 
						{$cat->afficheOption()}
					{/foreach}
				</optgroup>
            </select>
            <br/><br/>
            
            <input type="submit" value="Modifier"/>
        </p>
		</form>
    </div>
{/block}
