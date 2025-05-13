<?php
$page = "acceuil.php";
$description = "Page d'accueil";
$keywords = "default";

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);

pieddepage();
?>