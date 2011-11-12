{* Modèle de la page *}
{extends file="modele/main.tpl"}

{* Le contenu de la page *}
{block name=content}
	<h1>Gestion des images</h1>
	<h2>Ajout d'une image</h1>

	<form action="index.php?admin=IMAGES&amp;action=UPLOAD" method="POST" enctype="multipart/form-data">
	<p>
		<label for="titre">Titre</label> : 
		<input type="text" name="titre" id="titre"/><br/><br/>
		
		<label for="desc">Description</label> :<br/>
		<textarea name="desc" id="desc" cols="50" rows="10"></textarea><br/><br/>
		
		<label for="img">Image</label> :<br/>
		<input type="file" name="img" id="img"/><br /><br />
		
        <input type="submit" value="Envoyer" />
	</p>
	</form>

	<h2>Images utilisées</h2>
	{foreach from=$images item=img}
		{if $img->used()}
			<img src="index.php?image={$img->getId()}" /><br/>
		{/if}
	{/foreach}	
	<h2>Images inutilisées</h2>
	{foreach from=$images item=img}
		{if !$img->used()}
			<img src="index.php?image={$img->getId()}" /><br/>
		{/if}
	{/foreach}	
	
{/block}
