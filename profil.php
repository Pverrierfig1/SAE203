<?php
$page = "Mon profil";
$description = "Modifier mon profil";
$keywords  = "profil utilisateur";


include("./scripts/functions.php");

parametres($page, $description, $keywords);

$photoDir = './data/photos/';

$liste_util = json_decode(file_get_contents("data/utilisateurs.json"),true);

entete($page);
navigation($page);

if (!isset($_SESSION['username'])){
  header('Location: ./accueil.php');
}

$user = $_SESSION["username"];
$nom = $_SESSION["nom"];
$prenom = $_SESSION["prenom"];
$allowed = array("png", "jpg", "jpeg");

if (isset($_POST["bio"])){
  $liste_util[$user]["bio"] = $_POST["bio"];
  file_put_contents("./data/utilisateurs.json", json_encode($liste_util));
}
if (isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] === UPLOAD_ERR_OK) {
  $extention = pathinfo($_FILES["fichier"]["name"], PATHINFO_EXTENSION); // récupère l'extention de l'image
  if (in_array(strtolower($extention), $allowed)){ // on vérifie que le fichier est une image 
    $img = pp_search($nom,$prenom);
    if (file_exists($img)){
      unlink($img);
    }
    move_uploaded_file($_FILES["fichier"]["tmp_name"],"./images/images_utilisateur/".strtolower($prenom.'_'.$nom).".".$extention);
    echo('
        <div class="alert alert-success mt-5 container">
          <strong>Photo de profil changé !</strong>
        </div>');
  }else{
    alert("<strong>Erreur</strong>Seul les formats PNG,JPG,JPEG sont autorisés...");
  }
}

?>

<div class="container">
  <h1 class="mb-4">👤 Mon Profil</h1>
  <p class="alert alert-info">Modifiez vos informations personnelles.</p>

  <h2>Modifier le profil</h2>

    <form method="POST" action="#" enctype="multipart/form-data">
      <?php
          echo('
            <label for="file" class="form-label">Choisissez une image de profil</label>
          <input class="form-control" type="file" id="file" name="fichier">
          <label class="form-label">Bio</label>
           <textarea name="bio" class="form-control">'.htmlspecialchars($liste_util[$user]["bio"]).'</textarea>
        <button type="submit" name="save" class="btn btn-success mt-5">Enregistrer</button>
        <a href="'.$_SERVER["PHP_SELF"].'" class="btn btn-secondary ms-2 mt-5">Annuler</a>');
    ?>
    </form>
</div>

<?php pieddepage();
?>