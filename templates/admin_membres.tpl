{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var='design' value="special"}
{/block}


{* Le contenu de la page *}
{block name=content}
<<<<<<< HEAD
    <div id="administrer-membres">
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
                    {if $membre->estAdmin()}                    
                        <td>Admin</td>                    
                    {else}
                        <td>
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
    </div>
{/block}
