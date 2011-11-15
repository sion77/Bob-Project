{* Modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
	{assign var='design' value="special"}
{/block}

{* Le contenu de la page *}
{block name=content}
	<div id="page-admin-images">
		<div id="admin_images">
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
			<div class="boite_images">
				{foreach from=$images item=img}
					{if $img->used()}
						<img src="index.php?image={$img->getId()}&amp;h=64&amp;w=64" />
					{/if}
				{/foreach}	
			</div>
			<h2>Images inutilisées</h2>
			<div class="boite_images">
				{foreach from=$images item=img}
					{if !$img->used()}
						<img src="index.php?image={$img->getId()}&amp;h=64&amp;w=64" />
					{/if}
				{/foreach}	
			</div>
			<div id="bas-images">
			</div>
		</div>
	</div>
{/block}
