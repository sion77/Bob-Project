{extends file="modele/main.tpl"}

{block name=design}
	{assign name="design" value="special/inscr-connect.css"}
{/block}

{block name=content}
	<div id="form-inscription">
		<h1>INSCRIPTION !</h1>
		<h4>Les deux mots de passe doivent être identiques.</h4>
		<h6>Veuillez ne pas tenter d'injections SQL S.V.P, merci ;)</h6>
		
		<form action="index.php?action=INSCRIPTION" method="post">		
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
					<th><label for="pass2">Confirmation :</label></td>
					<td><input id="pass2" name="pass2" type="password" /></td>
					<span class="tooltip">Le mot de passe de confirmation doit être identique à celui d'origine</span>
					
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
			Une autre raison importante	est que nous sommes de méchants administrateurs qui vendent vos données privées et nous enregistrons vos données banquaires,
			ce qui constitue notre principale source de revenus 8D
		</p>
	</div>
	<script language="javascript" src="script.js"></script>
{/block}
