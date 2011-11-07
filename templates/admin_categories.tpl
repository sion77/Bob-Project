{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{* Pas de design supplémentaire *}

{* Le contenu de la page *}
{block name="content"}
	<div id="admin_creer_categorie">
		<h1>Ajouter une nouvelle catégorie</h1>
		<form action="" method="POST">
		<p>
			<label for="titre">Le titre : </label>
			<input type="text" id="titre" name="titre" />
			<br/><br/>
			
			<label for="desc">Description : </label><br/>
			<textarea id="desc" name="desc" cols="100" rows="10"></textarea>
			<br/><br/>
			
			<input type="submit" value="Creer"/>
		</p>
		</form>
	</div>
	<div id="admin_edit_categories">
		<h1>Editer une catégorie</h1>
		<noscript>
			<span class="erreur">
				Pour pouvoir attacher, détacher ou supprimer une categorie, 
				il faut activer le javascript !
			</span>
		</noscript>
		<div id="admin_arbre_categories">
			<ul>
				{foreach from=$categories item=cat} 
					{$cat->affiche()}
				{/foreach}
			</ul>
		</div>
		{literal}
			<!-- Script AJAX permettant de modifier la hierarchie sans recharger la page -->
			<script type="text/javascript">
			<!--
				// Appelle index.php?admin=CATEGORIE&amp;AJAX=arbre
				function afficher()
				{
					
				}
			// -->
			</script>
		{/literal}
	</div>
{/block}
