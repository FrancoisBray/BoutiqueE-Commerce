<?php
echo"
<div id='creationCommande'>
<form enctype='multipart/form-data' method='POST' action='index.php?uc=administrer&action=confirmerAjout'>
   <fieldset>
     <legend>Ajouter un produit</legend>
	   <p>
       <label for='description'>Description</label>
       <input id='desc' type='text' name='desc' value='$description' size='30' maxlength='45'>
       </p>
	   <p>
		<label for='prix'>Prix</label>
		<input id='prix' type='text' name='prix' value='$prix' size='30' maxlength='45'>
       </p>
	   	   <p>
		<label for='Photo'>Image</label>
		<input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
		<input type='file' name='image' size='50'>
       </p>
	  <p>
         <input type='submit' value='Valider' name='valider'>
         <input type='reset' value='Annuler' name='annuler'> 
      </p>
</form>
</div>
";
?>