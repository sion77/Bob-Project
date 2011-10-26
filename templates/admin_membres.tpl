{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Pas de design spécial pour la page *}

{* Le contenu de la page *}
{block name=content}
	<h1>Gestion des membres</h1>
	<table>
		<tr>
			<th>Id</th>
			<th>Pseudo</th>
			<th>Actions</th>
		</tr>
		
		{foreach from=$membres item=membre}
			<tr>
				<td>{$membre->getId()}</td>
				<td>{$membre->getPseudo()}</td>
				<td>
					{if $membre->estAdmin()}
						Admin
					{else}
						<ul>
							<li>
								<a href="index.php?admin=MEMBRES&amp;action=PROMO&amp;id={$membre->getId()}">
									Rendre admin
								</a>
							</li>
							<li>
								<a href="index.php?admin=MEMBRES&amp;action=SUPPRIMER&amp;id={$membre->getId()}">
									Supprimer
								</a>
							</li>
						</ul>
					{/if}
				</td>
			</tr>			
		{/foreach}
		
	</table>
{/block}
