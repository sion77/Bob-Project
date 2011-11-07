{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
	{assign var='design' value="special/about"}
{/block}

{* Le contenu de la page *}
{block name=content}
	<div id="page-about-bricobob">
		<div id="about">
			
			<img src="img/bobhead.png" alt="Bob Head" />
			<h1> Nous contacter </h1>
			
			<p> 
				Même si la société Brico-Bob n'existe pas réellement, vous pouvez toutefois contacter les réalisateurs de ce site aux adresses suivants :
				<ul>
					<li><strong>Sylvain LAFON : </strong>sylvain.lafon@u-psud.fr</li>
					<li><strong>Thomas LEVASSEUR : </strong>thomas.levasseur@u-psud.fr</li>
					<li><strong>François MAINGRET : </strong>françois.maingret@u-psud.fr</li>
				</ul>
			</p>
		</div>
	</div>
{/block}
