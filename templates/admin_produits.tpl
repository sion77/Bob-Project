{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{block name=content}
    <h1>Ajouter un produit</h1>
	<form method="post" action="index.php?admin=PRODUITS&amp;action=CREER">
	<p>
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