{if $connecte}
    <span class="etat_connecte">
        {$smarty.session.pseudo}
                    
        {if $smarty.session.admin}
            <a href="index.php?admin=ACCUEIL">Administrer</a>
        {/if}
        
        <a href="index.php?action=DECONNECTION">Deconnection</a>
    </span>
{else}
    <span class="etat-non-connecte">
        Vous n'êtes pas connecté, veuillez vous <a href="index.php?page=CONNECTION">Connecter</a>
        ou vous <a href="index.php?page=INSCRIPTION">Inscrire !</a>
    </span>        
{/if}
