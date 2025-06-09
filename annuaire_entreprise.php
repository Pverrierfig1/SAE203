<?php
$page = "Annuaire de l'entreprise";
$description = "Page annuaire de l'entreprise";
$keywords = "annuaire_entreprise";
include("./scripts/functions.php");
parametres($page, $description, $keywords);
entete($page);
navigation($page);

$login = $_SESSION['username'] ?? null;

$liste_util = json_decode(file_get_contents("data/utilisateurs.json"), true);

$roles_connecte = $liste_util[$login]['roles'] ?? [];
$est_admin = in_array('Administrateur', $roles_connecte);

echo "<div class='container ml-5 mr-5'>";
echo "<h1 class='mt-4'> 📖 Annuaire de l'entreprise </h1> ";

if ($est_admin) {
    // Formulaire pour ajouter un utilisateur
    echo "<h2 class='mt-4 mb-4'>Ajouter un utilisateur :</h2>";
    echo "<form method='POST' action='gestion.php' class='mb-4'>";
    echo "<button class='btn btn-success' type='submit' name='ajouter' value='ajouter'>Ajouter un utilisateur</button>";
    echo "</form>";
}

echo('
    <form class="d-flex mb-4" method="GET" action="#">
        <input class="form-control me-2" type="text" placeholder="Rechercher un utilisateur" name="recherche">
        <button class="btn btn-info" type="submit">Rechercher</button>
    </form>');

// Formulaire pour modifier/supprimer des utilisateurs
echo "<form method='POST' action='gestion.php'>";
echo "<table class='table table-striped table-info'>";
echo "<tr><th>Photo</th><th>Nom</th><th>Prénom</th><th>Fonction</th><th>Bio</th><th>Actions</th></tr>";

// Parcours de chaque utilisateur
foreach ($liste_util as $identifiant => $user) {
    if (isset($_GET["recherche"]) && $_GET["recherche"] != "" && !str_contains($user["nom"], $_GET["recherche"]) && !str_contains($user["prenom"], $_GET["recherche"])){
        continue; //str_contains uniquement dispo sur php 8 !
    }
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $role = implode(", ", $user['roles'] ?? []);
    $bio = $user['bio'];
    $photo = pp_search($prenom, $nom);
    if (!file_exists($photo)) {
        $photo = "./images/default.jpg";
    }

    echo "<tr>";
    echo "<td><img src='$photo' alt='Photo de $prenom $nom' width='80' height='80'></td>";
    echo "<td>$nom</td>";
    echo "<td>$prenom</td>";
    echo "<td>$role</td>";
    echo "<td>$bio</td>";
    echo "<td>";
    if ($est_admin) {
        echo "<button class='btn btn-warning' type='submit' name='modification' value='$identifiant'>Modifier</button> ";
        echo "<button class='btn btn-danger' type='submit' name='suppression' value='$identifiant'>Supprimer</button>";
    } else {
        echo "-";
    }
    echo "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</form>";
echo "</div>";

pieddepage();
?>