{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{* Pas de design supplémentaire *}

{* Le contenu de la page *}
{block name="content"}
	<ul>
		{foreach from=$categories item=cat} 
			{$cat->affiche()}
		{/foreach}
	</ul>
{/block}
