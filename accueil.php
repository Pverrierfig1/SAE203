<?php
$page = "acceuil.php";
$description = "Page d'accueil";
$keywords = "default";

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);

?>

<div class="container mt-5 alert alert-info p-4 text-center">
    <div class="col">
        <h3 class="mb-4">Bienvenue sur l’intranet d’Hydrofix</h4>
        <p>
          Cet espace est dédié aux collaborateurs d’Hydrofix. Il vous permet d’accéder rapidement à toutes les ressources internes essentielles : actualités, documents partagés, outils de gestion, et informations pratiques.
        </p>
        <p>
          L’objectif de cet intranet est de favoriser la communication entre les équipes, de centraliser les informations et d’améliorer notre efficacité collective.
        </p>
        <p>
          N’hésitez pas à consulter les différentes rubriques disponibles dans le menu. Bonne navigation !
        </p>
    </div>
    <hr>
    <div class="my-4 row">

     <div class="col">
        <img src="./images/equipe.png" alt="Photo de l'équipe Hydrofix" class="img-fluid rounded">
        <p class="mt-2">Nos équipes au travail</p>
      </div>
      <div class="col">
        <img src="./images/chantier.png" alt="Chantier Hydrofix" class="img-fluid rounded">
        <p class="mt-2">Chantiers en cours</p>
      </div>
      <div class="col">
        <img src="./images/locaux.png" alt="Locaux Hydrofix" class="img-fluid rounded">
        <p class="mt-2">Vie de l’entreprise</p>
     </div>
 	</div>
</div>


<?php

pieddepage();
?>