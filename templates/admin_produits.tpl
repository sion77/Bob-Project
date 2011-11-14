{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{block name=content}
	<h1>Ajouter un produit</h1>
	
	<h1>Modifier un produit</h1>
	<ul>
		{foreach from=$produits item=cat}
			<li>{$cat->getNom()}</li>
		{/foreach}
	</ul>
{/block}