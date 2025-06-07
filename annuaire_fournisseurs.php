<?php
$page = "Annuaire des fournisseur";
$description = "Page annuaire des fournisseurs";
$keywords = "annuraire fournisseurs";
include("./scripts/functions.php");
parametres($page, $description, $keywords);
entete($page);
navigation($page);

if (isset($_SESSION['username'])) {
    $login = $_SESSION['username'];
} else {
    $login = null;
}

// Chargement des utilisateurs pour vérifier le rôle de l'utilisateur connecté
$liste_util = json_decode(file_get_contents("data/utilisateurs.json"), true);
$roles_connecte = [];

if (isset($liste_util[$login]['roles'])) {
    $roles_connecte = $liste_util[$login]['roles'];
}
$est_admin = in_array('Administrateur', $roles_connecte);

// Chargement des fournisseurs
$fournisseurs = json_decode(file_get_contents("data/fournisseurs.json"), true);

echo "<div class='container ml-5 mr-5'>";
echo "<h1>🏢 Annuaire des fournisseurs partenaires</h1>";
echo "<br><form method='POST' action='gestion_fournisseur.php'>";
echo "<table class='table table-striped table-info'>";
echo "<tr><th>Logo</th><th>Nom</th><th>Description</th><th>Actions</th></tr>";
echo "<h2>Ajouter un nouveau fournisseur :</h2><br>";

if ($est_admin) {
    echo "<button class='btn btn-success' type='submit' name='ajouter' value='ajouter'>Ajouter un fournisseur</button><br><br>";
}

foreach ($fournisseurs as $id => $fournisseur) {
    $nom = htmlspecialchars($fournisseur['nom']);
    $description = htmlspecialchars($fournisseur['description']);
    $logo = "./images/logo/" . $fournisseur['logo'];
    if (!file_exists($logo)) {
        $logo = "./images/logo/default_logo.jpg";
    }
    echo "<tr>";
    echo "<td><img src='$logo' alt='Logo $nom' width='80' height='80'></td>";
    echo "<td>$nom</td>";
    echo "<td>$description</td>";
    echo "<td>";

    if ($est_admin) {
        echo "<button class='btn btn-warning' type='submit' name='modification' value='$id'>Modifier</button> ";
        echo "<button class='btn btn-danger' type='submit' name='suppression' value='$id'>Supprimer</button>";
    } else {
        echo "-";
    }
    echo "</td>";
    echo "</tr>";
}

echo "</table></form></div>";
pieddepage();
?>
