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

}

function pieddepage(){
  date_default_timezone_set("Europe/Paris");
echo ("
    <footer class='mt-5 p-4 bg-light text-center'>

    </footer>
");
}
?>
