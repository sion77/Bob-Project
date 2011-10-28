{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
	{assign var='design' value="special"}
{/block}

{* Le contenu de la page *}
{block name=content}
	<div id="page-admin">
		<div id="panneau-admin">
			<h1>Panneau d'administrateur</h1>
			<div class="icon-panneau-admin">
				<a href="index.php?admin=MEMBRES"><img src="img/usericon.jpg" alt="Gestion des membres"/></a>
				<a href="index.php?admin=MEMBRES">Gestion des membres</a>
			</div>	
			<div class="icon-panneau-admin">
				<a href="index.php?admin=CATEGORIES"><img src="img/boxicon.jpg" alt="Gestion des categories"/></a>
				<a href="index.php?admin=CATEGORIES">Gestion des categories</a>
			</div>
		</div>
	</div>
{/block}
