<?php

function parametres($titre, $description, $keywords){
  session_start();
  echo('
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>'.$titre.'</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="'.$description.'">
  <meta name="keywords" content="'.$keywords.'">
  <meta name="author" content="Pol, Esteban, Kylian, Hugo, Quentin, Mathéo">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="icon" href="./images/logo.png">
  <script src="./scripts/JavaScript.js" defer></script>
</head>
<body>');
}

function entete($titre){
  echo("
  <header class='p-3 bg-primary text-white'>
    <div class='container-fluid'>
      <div class='row'>
        <div class='col text-start img-fluid'>
          <img src='images/logo.png' alt='Logo de notre société' width='100'>
        </div>
        <div class='mt-4 col-6 text-center'>
          <h1>Hydrofix</h1>
        </div>
        <div class='mt-4 col text-center'>
          <div class='row'>
            <div class='mt-2 col'>");
  
  if (isset($_SESSION['username'])){
    echo("<a href='./deconnexion.php' class='btn btn-danger'>Déconnexion</a><br>");
    echo("<p class='mt-2'>Vous êtes connecté en tant que : <br><b>".$_SESSION['nom']." ".$_SESSION['prenom']."</b></p>");
  } else {
    echo("<a href='./connexion.php' class='btn btn-info'>Connexion</a>");
  }

  echo("</div>
        <div class='mt-1 col'>");

  if (isset($_SESSION['username'])){
    $pp = "./images/default.jpg";
    $search = pp_search($_SESSION['prenom'], $_SESSION['nom']);
    if ($search && file_exists($search)){
      $pp = $search;
    }
    echo("<a href='./profil.php'><img src='".$pp."' alt='photo de profil utilisateur' width='100' class='rounded'></a>");
  }

  echo("</div>
          </div>
        </div>
      </div>
    </div>
  </header>");
}

function navigation($page){
  echo("
  <nav class='navbar navbar-expand-lg navbar-light bg-light'>
    <div class='container'>
      <a class='navbar-brand' href='../wordpress/index.php'>Hydrofix</a>
      <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav'>
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse justify-content-center' id='navbarNav'>
        <ul class='navbar-nav'>
          <li class='nav-item'>
            <a class='nav-link ".($page == 'Accueil' ? 'active' : '')."' href='./accueil.php'>Accueil</a>
          </li>");

  if (isset($_SESSION['username'])){
    echo("
          <li class='nav-item dropdown'>
            <a class='nav-link ".($page == 'Page de partage' ? 'active' : '')." dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown'>Gestionnaire de fichiers</a>
            <ul class='dropdown-menu'>
              <li><a class='dropdown-item' href='./partage.php'>Visualisation</a></li>
              <li><a class='dropdown-item' href='./depot.php'>Upload de fichiers</a></li>
            </ul>
          </li>");
  }
  if (isset($_SESSION['username']) && (in_array("Administrateur", $_SESSION['roles']) or in_array("Manager", $_SESSION['roles']) or in_array("Direction", $_SESSION['roles']))){
    echo("
          <li class='nav-item'>
            <a class='nav-link ".($page == "Annuaire de l'entreprise" ? 'active' : '')."' href='./annuaire_entreprise.php'>Annuaire entreprise</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link ".($page == 'Annuaire des fournisseurs' ? 'active' : '')."' href='./annuaire_fournisseurs.php'>Annuaire des fournisseurs</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link ".($page == 'Annuaire des clients' ? 'active' : '')."' href='./annuaire_client.php'>Annuaire des clients</a>
          </li>");
  }
  if (isset($_SESSION['username']) && (in_array("Administrateur", $_SESSION['roles']) or in_array("Manager", $_SESSION['roles']))){
    echo("
          <li class='nav-item'>
            <a class='nav-link ".($page == 'Gestion des fournisseurs' ? 'active' : '')."' href='./gestion_fournisseur.php'>Gestion des fournisseurs</a>
          </li>");
  }

  if (isset($_SESSION['username']) && in_array("Administrateur", $_SESSION['roles'])){
    echo("
          <li class='nav-item'>
            <a class='nav-link ".($page == 'Gestion des utilisateurs' ? 'active' : '')."' href='./gestion.php'>Gestion</a>
          </li>");
  }

  echo("
          <li class='nav-item'>
            <a class='nav-link ".($page == 'Wiki' ? 'active' : '')."' href='./wiki.php'>Wiki</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>");
}

function pieddepage(){
  date_default_timezone_set('Europe/Paris');
  $date = date("d/m/y - H:i:s");
  echo("
  <footer class='bg-light text-center shadow mt-5'>
    <img src='images/logo.png' alt='Logo de notre société' class='img-fluid' width='75'>
    <div class='text-center'>
      <span>".$date." — &copy;Hydrofix. Tous droits réservés</span>
      <br><br>
    </div>
  </footer>
</body>
</html>");
}

function alert($texte){
  echo('
  <div class="container alert alert-danger alert-dismissible fade show mt-4">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    '.$texte.'
  </div>');
}

function stockage($rep){
  $taille = 0;
  $rep_recurs = scandir($rep);
  foreach($rep_recurs as $cont){
    if ($cont === "." || $cont === "..") continue;
    $chemin = $rep."/".$cont;
    if (is_file($chemin)) $taille += filesize($chemin);
    elseif (is_dir($chemin)) $taille += stockage($chemin);
  }
  return $taille;
}

function pp_search($prenom, $nom){
  $formats = [".png", ".jpg", ".jpeg"];
  foreach ($formats as $ext){
    $nom_photo = "./images/images_utilisateur/".strtolower($prenom."_".$nom).$ext;
    if (file_exists($nom_photo)) return $nom_photo;
  }
  return null;
}
?>