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
            <h1> A propos de Brico-Bob </h1>
            
            <p> 
                Brico-Bob est une société fictive crée pour le projet WEB de l'iut d'Orsay. Elle n'existe donc malheuresement pas et vous ne pourrez pas acheter nos magnifiques
                articles de bricolage.</br></br>
                
                Cette page ne sers donc à rien, mis a part "meubler le site" et montrer que cette partie est fonctionnelle. Je vous invite donc à consulter le reste de notre
                site ;-) 
            </p>
        </div>
    </div>
{/block}
