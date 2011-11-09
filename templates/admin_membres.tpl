{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Pas de design spécial pour la page *}

{* Le contenu de la page *}
{block name=content}
    <h1>Gestion des membres</h1>
    <table>
        <tr>
            <th style="text-align: center;">Id</th>
            <th style="text-align: center;">Pseudo</th>
            <th style="text-align: center;">Actions</th>
        </tr>
        
        {foreach from=$membres item=membre}
            <tr>
                <td style="text-align: center;">{$membre->getId()}</td>
                <td style="text-align: center;">{$membre->getPseudo()}</td>
                {if $membre->estAdmin()}                    
                    <td style="text-align: center;">Admin</td>                    
                {else}
                    <td style="text-align: left;">
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
                    </td>
                {/if}
            </tr>            
        {/foreach}
        
    </table>
{/block}
