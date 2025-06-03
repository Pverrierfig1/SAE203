<?php



$page = "Mon profil";
$description = "Modifier mon profil";
$keywords  = "profil utilisateur";


include("./scripts/functions.php");

parametres($page, $description, $keywords);

$photoDir = './data/photos/';


$liste_util = json_decode(file_get_contents("data/utilisateurs.json"),true);


// Sauvegarde du profil
foreach ($liste_util as $identifiant => $user) {  // $identifiant = clé (ex: jean.roland), $user = tableau des infos
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $role = implode(", ", $user['roles']); // Le rôles est un tableau, on le transforme en chaîne
    $bio = $user['bio']; 
    $photo = pp_search($nom,$prenom);
    if (!file_exists($photo)){
        $photo = "./images/default.jpg";
    }
  }
entete($page);
navigation($page);
?>

<div class="container mt-4">
  <h1 class="mb-4">👤 Mon Profil</h1>
  <div class="alert alert-info">Modifiez vos informations personnelles.</div>

  <h2 class="mt-3">Modifier le profil</h2>

<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
    <div class="mb-4 mt-4">
        <label for="file" class="form-label">Choisissez un fichier</label>
        <input class="form-control" type="file" id="file" name="fichier">
      </div>
      <label class="form-label">Bio</label>
       <textarea name="bio" class="form-control"><?= htmlspecialchars($user['bio']) ?></textarea>
    </div>
    <button type="submit" name="save" class="btn btn-success">Enregistrer</button>
    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-secondary ms-2">Annuler</a>
</form>
</div>
</div>

<?php pieddepage(); ?>