{extends file="modele/main.tpl"}

{block name=design}
    {assign var='design' value="special/inscr-connect"}
{/block}

{block name=content}
    <script type="text/javascript" src="js/inscription.js"></script>
    <div id="form-inscription">
        <h1>INSCRIPTION !</h1>
        <h4>Les deux mots de passe doivent être identiques.</h4>
        <h6>Veuillez ne pas tenter d'injections SQL S.V.P, merci ;)</h6>
        
        <form action="index.php?action=INSCRIPTION" method="post" onsubmit="return verifForm(this)">        
            <table>
                <tr>
                    <th><label for="pseudo">Pseudo :</label></td>
                    <td><input onchange="checkPseudo(this);" id="pseudo" name="pseudo" type="text"  /></td>
                    <td><img src="img/croix.png" id="pseudoEtat" alt="rien"></img></td>
                </tr>
                <tr>
                    <th><label for="pass">Mot de passe :</label></td>
                    <td><input onchange="checkPass(this);" id="pass" name="pass" type="password" /></td>
                    <td><img src="img/bob_js1.png" id="passEtat"></img></td>
                </tr>
                <tr>
                    <th><label for="pass2">Confirmation :</label></td>
                    <td><input onchange="checkPass2(this);" id="pass2" name="pass2" type="password" /></td>
                    <!-- td><span class="tooltip">Le mot de passe de confirmation doit être identique à celui d'origine</span></td -->
                    <td><img src="img/croix.png" id="confirmEtat"></td>
                </tr>
                <tr>
                    <td colspan="2" class="centre"><input type="submit" value="Je m'inscris" /></td>
                </tr>
            </table>    
        </form>
    </div>
    <div id="pourquoi-sinscrire">
        <h2> Pourquoi s'inscrire sur Brico-Bob ? </h2>
        <p>
            Il existe de nombreuses raisons qui pourraient vous pousser à vous inscrire sur Brico-Bob. Tout d'abord parce que 
            ce site est cool.</br>
            </br> 
            Ensuite parce que si vous ne le faites pas, vous ne pourrez rien acheter, ni louer, vous ne pourrez
            qu'admirer les superbes offres que nous vous proposons.</br>
            </br>
            Ensuite parce que ce site est cool.</br>
            </br>
            Une autre raison importante    est que nous sommes de méchants administrateurs qui vendent vos données privées et nous enregistrons vos données banquaires,
            ce qui constitue notre principale source de revenus 8D
        </p>
    </div>
{/block}
