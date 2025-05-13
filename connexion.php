<?php
$page = "Gestion des utilisateurs";
$description = "Page de gestion";
$keywords = "default";

include("./scripts/functions.php");
$data = json_decode(file_get_contents("./data/utilisateurs.json"),true);

parametres($page,$description,$keywords);

entete($page);

navigation($page);

if (isset($_POST["username"]) && isset($data["username"]) && password_verify($_POST["pswd"], $data["username"]["password"])){
  echo("validate");
}
else{
  altert("Utilisateur non valide");
}

echo('
<div class="container">
<h2 class="mt-4">Connexion à l\'intranet</h2>
<form action="#">
  <div class="mb-3 mt-3">
    <label for="username" class="form-label">Pseudo</label>
    <input type="text" class="form-control" id="email" placeholder="Entrez votre pseudo" name="username">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Mot de passe :</label>
    <input type="password" class="form-control" id="pwd" placeholder="Entrez votre mot de passe" name="pswd">
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>
</div>');

pieddepage();
?>
