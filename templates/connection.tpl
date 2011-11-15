{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var='design' value="special/inscr-connect"}
{/block}

{* Le contenu de la page *}
{block name=content}
    <div id="form-connection">
        <h1>CONNECTION !</h1>
        <form action="index.php?action=CONNECTION" method="post">
            <table>
                <tr>
                    <th><label for="pseudo">Pseudo :</label></td>
                    <td><input id="pseudo" name="pseudo" type="text" /></td>
                </tr>
                <tr>
                    <th><label for="pass">Mot de passe :</label></td>
                    <td><input id="pass" name="pass" type="password" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="centre"><input type="submit" value="C'est parti !" /></td>
                </tr>
            </table>    
        </form>
    </div>
{/block}
