<?php
echo"
<div id='creationCommande'>
<form method='POST' action='index.php?uc=administrer&action=confirmerConnexion'>
   <fieldset>
     <legend>Identification administrateur</legend>
	   <p>
       <label for='Login'>Login</label>
       <input id='Login' type='text' name='Login' value='$Login' size='30' maxlength='45'>
       </p>
	   <p>
		<label for='Mot de passe'>Mot de passe</label>
		<input id='mdp' type='password' name='mdp' value='$mdp' size='30' maxlength='45'>
       </p>
      <p>
         <input type='submit' value='Se connecter' name='Connecter'>
         <a href='index.php'><input type='button' value='Annuler'></a>
      </p>
</form>
</div>
";
?>