<?php
$page = "Gestion des utilisateurs";
$description = "Page de gestion";
$keywords = "gestion";

$roles = ["Administrateur", "Manager", "Direction", "Salarié"];

function deleteFolder($folder) {
    foreach (scandir($folder) as $child) {
        if ($child != "." && $child != "..") {
	        $path = $folder."/".$child;

	        if (is_dir($child)) {
	            deleteFolder($path);
	        } else {
	            unlink($path);
	        }
        }
    }
    rmdir($folder);
}

function deleteFolder($folder) {
    foreach (scandir($folder) as $child) {
        if ($child != "." && $child != "..") {
	        $path = $folder."/".$child;

	        if (is_dir($child)) {
	            deleteFolder($path);
	        } else {
	            unlink($path);
	        }
        }
    }
    rmdir($folder);
}

include("./scripts/functions.php");

$data = json_decode(file_get_contents("./data/utilisateurs.json"),true);

parametres($page,$description,$keywords);

entete($page);

navigation($page);

if (isset($_POST["name"])){ //traitement de l'inscription d'un utilisateur

  //echo("<pre>".print_r($_POST,true)."</pre>");
  $username = strtolower($_POST["prenom"]).".".strtolower($_POST["name"]); //clé = prenom.nom
  if (!isset($data[$username])){
        $data[$username] = array("nom" => $_POST["name"],"prenom"=>$_POST["prenom"],"telephone"=>$_POST["tel"],"roles"=>$_POST["roles"],"email"=>$_POST["email"],"password"=>password_hash($_POST["password"], PASSWORD_DEFAULT),"bio"=>"");
        //print_r($data);
        $result = file_put_contents("./data/utilisateurs.json", json_encode($data));
        if ($result === false){ //retourne un nombre d'octets ou false 
          alert("<strong>Erreur !</strong> L'utilisateur n'a pas été enregistré...");
        }
        else{
        echo('
        <div class="alert alert-success mt-5 container">
          <strong>Utilisateur créé !</strong>
        </div>');
        }
      }
  else{
      alert("<strong>Erreur !</strong> Email invalide.");
    }
}
elseif(isset($_POST["ajouter"])){ //affichage de l'inscription de l'utilisateur
//les roles sont sous forme de tableau pour ne pas avoir a les transformer a la l'envoi du form
  echo('
<div class="container">
  <h1 class="mt-4">Création d\'un utilisateur</h1>
    <form method="POST" action="#">
      <a href="./gestion.php" class="btn btn-info">Tableau de bord</a>
      <button type="submit" class="btn btn-info" name="ajouter">Ajout d\'employé</button>
      <a href="./annuaire_entreprise.php" class="btn btn-info">Gérer les employés</a>
     </form>
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
      <input type="email" class="form-control" id="email" placeholder="Entez un e-mail" name="email" required>
<<<<<<< HEAD
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
=======
    </div>');
    foreach($roles as $role){
      $checked = "";
      if ($role == "Salarié"){
        $checked = "checked";
      }
         echo ('
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="'.$role.'" name="roles[]" value="'.$role.'" '.$checked.'>
            <label class="form-check-label" for="'.$role.'">'.$role.'</label>
          </div>');
         }
  echo('
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
    <div class="mb-3 mt-3">
      <label for="password" class="form-label">Entrez le mot de passe de l\'utilisateur</label>
      <input type="password" class="form-control" id="password" placeholder="Entez un mot de passe" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Création</button>
  </form> 
</div>
  ');

}
<<<<<<< HEAD
elseif(isset($_POST["modification"])){ //

=======
elseif(isset($_POST["modification"])){ // Modificication de l'utilisateur
    $username = $_POST["modification"];

    if (!isset($data[$username])) {
         alert("<strong>Erreur !</strong> L'utilisateur n'existe pas...");
    } else {
        $user = $data[$username];

        echo('
        <div class="container">
            <h1 class="mt-4">Modification de l\'utilisateur '.$user["prenom"].' '.$user["nom"].'</h1>
            <form method="POST" action="#">
               <input type="hidden" name="username" value="'.$username.'">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" value="'.htmlspecialchars($user["nom"]).'" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" value="'.htmlspecialchars($user["prenom"]).'" disabled>
                </div>

                <div class="mb-3">
                    <label for="tel" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="'.htmlspecialchars($user["telephone"]).'" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="'.htmlspecialchars($user["email"]).'" required>
                </div>');
                  foreach($roles as $role){
                      $checked = "";
                      if (in_array($role, $user["roles"])){
                        $checked = "checked";
                      }
                      echo ('
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="'.$role.'" name="roles[]" value="'.$role.'" '.$checked.'>
                        <label class="form-check-label" for="'.$role.'">'.$role.'</label>
                      </div>');
                  }
              echo('
                    <div class="mt-4">
                      <button type="submit" class="btn btn-primary" name="valider_modification">Modifier</button>
                      <a href="./gestion.php" class="btn btn-secondary">Annuler</a>
                    </div>
            </form>
        </div>');

    }
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
}
elseif(isset($_POST["suppression"])){ // On supprime les donnnées de l'utilisateur, image, les upload, ect
  $prenom = $data[$_POST["suppression"]]["prenom"];
  $nom = $data[$_POST["suppression"]]["nom"];
	$photo = pp_search($prenom,$nom);
	unset($data[$_POST["suppression"]]);
	file_put_contents("./data/utilisateurs.json", json_encode($data));
	if (is_dir("./data/users/".$_POST["suppression"])){
		deleteFolder("./data/users/".$_POST["suppression"]); //rmdir ne permet pas de supprimer tout les fichiers dedans, on fait donc une fonction récursive qui supprime tout dedans d'abord...
	}
	if (file_exists($photo)){
		unlink($photo);
	}
	echo('
    <div class="alert alert-success mt-5 container">
          <p>L\'utilisateur <strong>'.$prenom.' '.$nom.'</strong> à été supprimé</p>
    </div>');
}
<<<<<<< HEAD
=======
elseif (isset($_POST["valider_modification"])){
    $username = $_POST["username"];
    $data[$username]["telephone"] = $_POST["tel"];
    $data[$username]["email"] = $_POST["email"];
    $data[$username]["roles"] = $_POST["roles"];

    $result = file_put_contents("./data/utilisateurs.json", json_encode($data));
    if ($result === false) {
      alert("<strong>Erreur !</strong> Les modifications n'ont pas été enregistrées.");
    } else {
      echo('
        <div class="alert alert-success mt-5 container">
          <strong>Utilisateur modifié avec succès !</strong>
        </div>');
    }
}
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
else{
  $file = file("./data/client.csv",FILE_SKIP_EMPTY_LINES);
  echo('
<div class="container-fluid row">
          <div class="btn-group-vertical col-1">
            <form method="POST" action="#">
              <a href="./gestion.php" class="btn btn-info">Tableau de bord</a>
              <button type="submit" class="btn btn-info mt-2" name="ajouter">Ajout d\'employé</button>
              <a href="./annuaire_entreprise.php" class="btn btn-info mt-2">Gérer les employés</a>
            </form>
          </div> 
          <div class="row col text-center">
            <h2 class="mt-4">Tableau de bord</h1>
            <hr class="mt-4 mb-5">
                <div class="col card bg-primary p-4 me-4">
                    <h3>Nombres d\'employés</h3>
                    <p>'.count($data).'</p>
                </div>
                <div class="col card bg-warning p-4 me-4">
                    <h3>Nombre de clients</h3>
                    <p>'.(count($file)-1).'</p>
                </div>
                <div class="col card bg-success p-4 me-4">
                    <h3>Stockage utilisé par le partage</h3>
                    <p>'.round(stockage("./data/users")/1024/1024,2).'Mo</p>
              </div>
          </div>
          <div class="div text-center mt-5 row">
              <div class="col card bg-secondary p-4 ms-4 me-4">
                <h3>RAM utilisé par le serveur</h3>
                <p>'.round(memory_get_usage()/1024/1024, 2).'Mo</p>
              </div>
              <div class="col card bg-dark p-4 text-white me-4">
                <h3>Espace disponible</h3>
                <p>'.(round(disk_free_space("./")/disk_total_space("./")*100,2)).'%</p>
              </div>
              <div class="col card bg-info p-4 me-4">
                <h3>Espace disponible (en Go)</h3>
                <p>'.round(disk_free_space("./")/1024/1024/1024).'Go</p>
            </div>
          </div>
    </div>
</div>
<div class="container card bg-light p-5 mt-5 text-center">
    <h2><u>Bienvenue sur le tableau de bord</u></h2>
    <p>Gérez facilement le contenu, les utilisateurs et les paramètres du site grâce à cet espace centralisé.
        Suivez les statistiques, effectuez des mises à jour et assurez le bon fonctionnement de la plateforme en toute simplicité.</p>
</div>

    ');
}

pieddepage();
?>
