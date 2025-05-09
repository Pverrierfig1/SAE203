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
  <meta name="author" content="EHKMPQ">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="icon" href="/images/logo.png">
</head>
<body>');
}

function entete($titre){
  echo("<header class='p-4 bg-primary text-white'>
    <div class='container-fuild'>
      <div class='row'>
        <div class='col-3 text-start'>
          <img src='/images/logo.png' alt='Logo de notre société' class='img-fluid' width='150'>
        </div>
      </div>
    </div>
  </header>");
}

function navigation($page){
  echo( "
  <nav class='navbar navbar-expand-lg navbar-light bg-light'>
  <div class='container'>
    <a class='navbar-brand' href='../accueil.php'>Hydrofix</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNav'>
      <ul class='navbar-nav'>
        <li class='nav-item'>
          <a class='nav-link " . ($page == 'accueil' ? 'active' : '') . "' href='../accueil.php'>Accueil</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link " . ($page == 'Qui' ? 'active' : '') . "' href='#'>Qui sommes-nous ?</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link " . ($page == 'Histoire' ? 'active' : '') . "' href='#'>Histoire</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link " . ($page == 'Activités' ? 'active' : '') . "' href='#'>Activités</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link " . ($page == 'Partenaires' ? 'active' : '') . "' href='#'>Partenaires</a>
        </li>
      </ul>
    </div>
  </div>
</nav>");
}

function pieddepage(){
  date_default_timezone_set("Europe/Paris");
echo ("
    <footer class='mt-5 p-4 bg-light text-center'>
      <div class='mt-4 p-1 bg-primary text-white rounded'>
                <p class='text-center'>Pol VERRIER FI1A G1 pol.verrier@etudiant.univ-rennes.fr</p>
                <p class='text-center'>".date("m/d/y")." &copy; ".date('Y')."</p> 
                
            </div>
    </footer>
");
}
?>
