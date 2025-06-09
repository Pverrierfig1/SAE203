<?php
$page = "Annuaire des fournisseurs";
$description = "Page annuaire des fournisseurs";
$keywords = "annuraire fournisseurs";
include("./scripts/functions.php");
parametres($page, $description, $keywords);
entete($page);
navigation($page);

if (!isset($_SESSION['username']) or !in_array("Administrateur", $_SESSION['roles']) or !in_array("Manager", $_SESSION['roles']) or !in_array("Direction", $_SESSION['roles'])){
  header('Location: ./accueil.php');        // vérification si l'utilisateurs peut accéder a la page, si non il est rediriger sur l'accueil
}

// Vérifie si un utilisateur est connecté et récupère son login
$login = $_SESSION['username'] ?? null;

// Chargement de la liste d'utilisateurs pour vérifier le rôle de l'utilisateur connecté
$liste_util = json_decode(file_get_contents("data/utilisateurs.json"), true);
$roles_connecte = [];

// Récupération des rôles de l'utilisateur connecté
if (isset($liste_util[$login]['roles'])) {
    $roles_connecte = $liste_util[$login]['roles'];
}

// Détermination si l'utilisateur est un administrateur
$est_admin = in_array('Administrateur', $roles_connecte);

// Chargement des fournisseurs
$fournisseurs = json_decode(file_get_contents("data/fournisseurs.json"), true);

echo "<div class='container ml-5 mr-5'>";
echo "<h1 class='mt-5 mb-4'>🏢 Annuaire des fournisseurs partenaires</h1>";

echo('
    <form class="d-flex mb-4" method="GET" action="#">
        <input class="form-control me-2" type="text" placeholder="Rechercher un fournisseur" name="recherche">
        <button class="btn btn-info" type="submit">Rechercher</button>
    </form>');

// Formulaire POST envoyant les actions vers gestion_fournisseur.php
echo "<form method='POST' action='gestion_fournisseur.php'>";

// Si l'utilisateur est un administrateur, on affiche un bouton pour ajouter
if ($est_admin) {
    echo "<h2 class='mb-3'>Ajouter un nouveau fournisseur :</h2>";
    echo "<button class='btn btn-success mb-3' type='submit' name='ajouter' value='ajouter'>Ajouter un fournisseur</button>";
}

// Tableau des fournisseurs
echo "<table class='table table-striped table-info'>";
echo "<thead><tr><th>Logo</th><th>Nom</th><th>Description</th><th>Actions</th></tr></thead>";
echo "<tbody>";

foreach ($fournisseurs as $id => $fournisseur) {
    $nom = htmlspecialchars($fournisseur['nom']);
    $description = htmlspecialchars($fournisseur['description']);
    $logo = "./images/logo/" . $fournisseur['logo'];
    if (isset($_GET["recherche"]) && $_GET["recherche"] != "" && !str_contains($fournisseur["nom"], $_GET["recherche"])){
        continue; //str_contains uniquement dispo sur php 8 !
    }
    // Vérifie si le logo existe, sinon image par défaut
    if (!file_exists($logo)) {
        $logo = "./images/logo/default_logo.jpg";
    }

    echo "<tr>";
    echo "<td><img src='$logo' alt='Logo de $nom' width='80' height='80'></td>";
    echo "<td>$nom</td>";
    echo "<td>$description</td>";
    echo "<td>";

    // Actions admin
    if ($est_admin) {
        echo "<button class='btn btn-warning me-1' type='submit' name='modifier' value='$id'>Modifier</button>";
        echo "<button class='btn btn-danger' type='submit' name='supprimer' value='$id'>Supprimer</button>";
    } else {
        echo "-";
    }

    echo "</td>";
    echo "</tr>";
}

echo "</tbody></table>";
echo "</form>";
echo "</div>";

pieddepage();
?>