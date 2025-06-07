<?php
$page = "Page de partage";
$description = "Page de dépôt qui permet la confirmation de suppression et le dépôt de fichier";
$keywords = "dépôt_suppression";
$roles = ["Administrateur", "Manager", "Direction", "Salarié"];

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);

if (isset($_POST['bouton_suppression'])){
  $file = $_POST['bouton_suppression'];
  $fichier = $_POST['nomfichier'];
  echo('<div class="container alert alert-danger mt-4 text-center">
    <strong>Suppression</strong> Souhaitez-vous suppimer ce fichier : '.$fichier.' . Veuillez-confirmez la suppression.
    </div>
    <div class="container text-center">
    <form action="#" method="POST">
      <button type="submit" name="bouton_confirm" class="btn btn-sm btn-success" value="'.$file.'">✅ Confirmer</button>
      <button type="submit" name="bouton_annul" class="btn btn-sm btn-danger">❌ Annuler</button>
    </form>
    </div>
      ');
}

if (isset($_POST['bouton_confirm'])){
  unlink($_POST['bouton_confirm']);
  echo('<div class="container alert alert-success alert-dismissible text-center mt-4">Suppression confirmé</div>');
}
if (isset($_POST['bouton_annul'])){
  alert("Suppression annulé");
};

if (isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] === UPLOAD_ERR_OK) {
  $username = $_SESSION["username"];
	$path = "./data/users/".$username;
	if (!is_dir($path)){
		mkdir($path); // on crée un dossier du nom de l'utilisateur si il n'existe pas
	}
	move_uploaded_file($_FILES["fichier"]["tmp_name"], $path."/".$_FILES["fichier"]["name"]); // on met dans le dossier de l'utilisateur le fichier temp
  $uploads = json_decode(file_get_contents("./data/uploads.json"),true);
  $allowed = $_SESSION["roles"];
  if (isset($_POST["roles"])){
    array_merge($allowed, $_POST["roles"]); //En disabled, php ne met pas dans POST la valeur... il faut donc ajouter manuellement.
  }
  $uploads[$username][$_FILES["fichier"]["name"]] = array("roles"=>$allowed,"commentaires"=>$_POST["commentaires"]);
  file_put_contents("./data/uploads.json", json_encode($uploads));
}
echo('
<div class="container">
  <h2 class="mt-3">Déposer un fichier</h2>

  <form action="#" method="POST" enctype="multipart/form-data">
    <div class="mb-4 mt-4">
      <label for="file" class="form-label">Choisissez un fichier</label>
      <input class="form-control" type="file" id="file" name="fichier">
    </div>
    <h3>Partager mon fichier avec :</h3>
');

foreach ($roles as $role) {
    
    $infos = in_array($role, $_SESSION['roles']) ? 'checked disabled' : '';

    echo ('
    <div class="form-check">
    <input type="checkbox" class="form-check-input" id="'.$role.'" name="roles[]" value="'.$role.'" '.$infos.'>
    <label for="'.$role.'" class="form-check-label"> '.$role.'</label><br>
    </div>');
}

echo '
    <label for="comment" class="mt-4">Commentaires :</label>
    <textarea class="form-control" id="comment" name="commentaires"></textarea>
    <button type="submit" class="btn btn-success mt-3">Envoyer</button>
  </form>
</div>';

pieddepage();
?>