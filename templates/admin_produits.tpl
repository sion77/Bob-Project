{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{block name=content}
    <h1>Ajouter un produit</h1>
	<form method="post" action="index.php?admin=PRODUITS&amp;action=CREER">
	<p>
		<label for="nom">Nom du produit : </label>
		<input type="text" name="nom" id="nom" /><br/><br/>

		<label for="desc">Description :</label><br/>
		<textarea id="desc" name="desc" rows="15" cols="100"></textarea><br/><br/>

		<label for="prix">Prix :</label>
		<input type="text" name="prix" id="prix" /><br/><br/>

		<label for="offre">Louable :</label>
		<input type="text" name="offre" id="offre" /><br/><br/>

		<label for="mere">Attacher à : </label>
		<select id="cat" name="mere">
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
		
		<input type="submit" value="Envoyer" />
	</p>
	</form>    
    <h1>Modifier un produit</h1>
    <ul>
        {foreach from=$produits item=cat}
            <li>{$cat->getNom()}</li>
        {/foreach}
    </ul>
{/block}
