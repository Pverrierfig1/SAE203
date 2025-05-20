<?php

function parametres($titre,$description,$keywords){
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
  <meta name="author" content="Esteban Heschung">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="icon" href="./images/logo.png">
</head>
<body>');
}

function entete($titre){
  echo("<header class='p-3 bg-primary text-white'>
    <div class='container-fuild'>
      <div class='row'>
        <div class='col text-start img-fluid'>
          <img src='images/logo.png' alt='Logo de notre société' width='100'>
        </div>
        <div class='mt-4 col-6 text-center'>
          <h1>Hydrofix</h1>
        </div>
        <div class='mt-4 col text-center'>
        "); 
        if (isset($_SESSION['username'])){
          echo("<a href='./deconnexion.php' class='btn btn-danger'>Deconnexion</a><br>");
          echo("<p class='mt-3'>Vous êtes connecté en tant que : <br>".$_SESSION['nom']." ".$_SESSION['prenom']." </p>
          <a href='mailto:".$_SESSION['email']."' class='text-white'>".$_SESSION['email']."</a>");
        } 
        else{
          echo("<a href='./connexion.php' class='btn btn-info'>Connexion</a>");
          } 
        if (isset($_SESSION['username'])){
          echo "<br>";
          $format = array(".png",".jpg",".jpeg");
          $pp = "./images/default.jpg";
          foreach ($format as $key => $value) {
            $nom_photo = "./images/".strtolower($_SESSION['prenom']."_".$_SESSION['nom']).$value;
            if (file_exists($nom_photo)){
              $pp = $nom_photo;
              break;
            }
          }
          echo("<img src='".$pp."' alt='photo de profil utilisateur' width='100'>");
        }
        echo("
        </div>
      </div>
    </div>
  </header>");
}

function navigation($page){
  echo( "
  <nav class='navbar navbar-expand-lg navbar-light bg-light'>
  <div class='container'>
    <a class='navbar-brand' href='../accueil_wordpress.html'>Hydrofix</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse justify-content-center' id='navbarNav'>
      <ul class='navbar-nav'>
        <li class='nav-item'>
          <a class='nav-link " . ($page == 'accueil' ? 'active' : '') . "' href='./accueil.php'>Accueil</a>
        </li>
        <li class='nav-item dropdown'>
          <a class='nav-link " . ($page == 'Qui' ? 'active' : '') . " dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown'>Gestionnaire de fichiers</a>
          <ul class='dropdown-menu'>
            <li><a class='dropdown-item' href='./partage.php'>Visualisation</a></li>
            <li><a class='dropdown-item' href='./depot.php'>Modification</a></li>
          </ul>
        </li>
        <li class='nav-item'>
          <a class='nav-link " . ($page == 'Histoire' ? 'active' : '') . "' href='./annuaire_entreprise.php'>Annuaire entreprise</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link " . ($page == 'Activités' ? 'active' : '') . "' href='./annuaire_fournisseurs.php'>Annuaires des fournisseurs partenaires</a>
        </li>");
        if (admin() !== false) {echo("<li class='nav-item'>
            <a class='nav-link " . ($page == 'Partenaires' ? 'active' : '') . "' href='./annuaire_client.php'>Annuaire des clients</a>
        </li>");
        };
        if (admin() !== false) {echo("<li class='nav-item'>
            <a class='nav-link " . ($page == 'wiki' ? 'active' : '') . "' href='./wiki.php'>Wiki</a>
          </li>");
        };
        echo("
      </ul>
    </div>
  </div>
</nav>");
}

function pieddepage(){
  date_default_timezone_set('Europe/Paris');
  $date = date("d/m/y - H:i:s");
echo ("
    <footer class='bg-light text-center shadow mt-5'>
          <img src='images/logo.png' alt='Logo de notre société' class='img-fluid' width='75'>
     <div class='text-center'>
        <span>" . $date . " — &copy;Hydrofix. Tous droits réservés</span>
        <br>
        <br>
      </div>
    </footer>
");
}

function alert($texte){
  echo('
  <div class="container alert alert-danger alert-dismissible fade show mt-4">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    '.$texte.'
  </div>');
}

function admin(){
  if (isset($_SESSION['roles'])){
    $key = array_search("administrateur", $_SESSION['roles']);
    if ($key !== false){
      return true;
    }
    else{
      return false;
    }
  }
  return false;
}

function stockage($rep){
  $taille = 0;
  $repertoire = $rep;
  $rep_recurs = scandir($repertoire);
  foreach($rep_recurs as $cont){
    if ($cont === "." || $cont === ".."){
      continue;
    }
    $chemin = $repertoire."/".$cont;
    if (is_file($chemin)){
      $taille += filesize($chemin);
    }
    elseif (is_dir($chemin)) {
      $taille += stockage($chemin);
    }
  }
  return $taille;
}

?>
