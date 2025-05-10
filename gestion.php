<?php
$page = "Gestion des utilisateurs";
$description = "Page de gestion";
$keywords = "default";

include("./scripts/functions.php");
$data = json_decode(file_get_contents("./data/utilisateurs.json"),true);

parametres($page,$description,$keywords);

entete($page);

navigation($page);

if (isset($_POST["name"])){

  //echo("<pre>".print_r($_POST,true)."</pre>");
  $username = strtolower($_POST["prenom"]).".".strtolower($_POST["name"]); //clé = prenom.nom
  if (!isset($data[$username])){
      $data[$username] = array("nom" => $_POST["name"],"prenom"=>$_POST["prenom"],"telephone"=>$_POST["tel"],"roles"=>$_POST["roles"],"password"=>password_hash($_POST["password"], PASSWORD_DEFAULT));
      //print_r($data);
      file_put_contents("./data/utilisateurs.json", json_encode($data));
  }
  else{
    echo('
      <div class="alert alert-danger mt-5 container">
        <strong>Erreur !</strong> L\'utilisateur existe déja.
      </div>');
  }

}
else{
//les roles sont sous forme de tableau pour ne pas avoir a les transformer a la l envoie du form
  echo('
<div class="container">
<h1>Création d\'un utilisateur</h1>
 <form action="#" method="POST">
  <div class="mb-3 mt-3">
    <label for="name" class="form-label">Nom de l\'utilisateur</label>
    <input type="text" class="form-control" id="name" placeholder="Entrez un nom" name="name" required> 
  </div>
  <div class="mb-3">
    <label for="prenom" class="form-label">Entrez le prénom de l\'utilisateur</label>
    <input type="text" class="form-control" id="prenom" placeholder="Entez un prénom" name="prenom" required>
  </div>
    <div class="mb-3">
    <label for="tel" class="form-label">Entrez le numéro de téléphone de l\'utilisateur</label>
    <input type="tel" class="form-control" id="tel" placeholder="Entez un numéro de téléphone" name="tel" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Entrez l\'e-mail de l\'utilisateur</label>
    <input type="email" class="form-control" id="password" placeholder="Entez un e-mail" name="email" required>
  </div>
  <div class="form-check">
      <h2>Séléctionnez les rôle de l\'utilisateur</h2>
      <input type="checkbox" class="form-check-input" id="check1" name="roles[]" value="administrateur">
      <label class="form-check-label" for="check1">Administrateur</label>
  </div>
  <div class="form-check">
      <input type="checkbox" class="form-check-input" id="check3" name="roles[]" value="manager">
      <label class="form-check-label" for="check3">Manager</label>
  </div>
  <div class="form-check">
      <input type="checkbox" class="form-check-input" id="check4" name="roles[]" value="direction">
      <label class="form-check-label" for="check4">Direction</label>
  </div>
  <div class="form-check">
      <input type="checkbox" class="form-check-input" id="check2" name="roles[]" value="salarie" checked>
      <label class="form-check-label" for="check2">Salarié</label>
  </div>
  <div class="mb-3 mt-3">
    <label for="password" class="form-label">Entrez le mot de passe de l\'utilisateur</label>
    <input type="password" class="form-control" id="password" placeholder="Entez un mot de passe" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">Création</button>
</form> 
</div>
  ');

}

pieddepage();
?>