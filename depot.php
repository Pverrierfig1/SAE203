<?php
$page = "acceuil.php";
$description = "Page d'accueil";
$keywords = "default";

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);

if (isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] === UPLOAD_ERR_OK) {
	$path = "./data/users/".$_SESSION["username"];
	if (!is_dir($path)){
		mkdir($path); // on crée un dossier du nom de l'utilisateur si il n'existe pas
	}
	move_uploaded_file($_FILES["fichier"]["tmp_name"], $path."/".$_FILES["fichier"]["name"]); // on met dans le dossier de l'utilisateur qui est temporère
}
echo('
<div class="container">
    <h2 class="mt-3">Déposer un fichier</h2>

    <form action="#" method="POST" enctype="multipart/form-data">
      <div class="mb-4 mt-4">
        <label for="file" class="form-label">Choisissez un fichier</label>
        <input class="form-control" type="file" id="file" name="fichier">
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
  </div>');

pieddepage();
?>