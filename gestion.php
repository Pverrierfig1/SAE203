<?php
$page = "Accueil";
$description = "Page d'accueil";
$keywords = "default";

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);


echo('
<h1>Création d\'un utilisateur</h1>
 <form action="#">
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
    <input type="tel" class="form-control" id="tel" placeholder="Entez un prénom" name="tel" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Entrez l\'e-mail de l\'utilisateur</label>
    <input type="email" class="form-control" id="password" placeholder="Entez un e-mail" name="email" required>
  </div>
  <div class="form-check mb-3">
  		<h2>Séléctionnez les rôle de l\'utilisateur</h2>
      <input type="checkbox" class="form-check-input" id="check1" name="admin">
      <label class="form-check-label" for="check1">Administrateur</label>
      <input type="checkbox" class="form-check-input" id="check2" name="salaries">
      <label class="form-check-label" for="check2">Salarié</label>
      <input type="checkbox" class="form-check-input" id="check3" name="manager">
      <label class="form-check-label" for="check3">Manager</label>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Entrez le mot de passe de l\'utilisateur</label>
    <input type="password" class="form-control" id="password" placeholder="Entez un mot de passe" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">Création</button>
</form> 
	');

pieddepage();
?>