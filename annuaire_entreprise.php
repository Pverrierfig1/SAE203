<?php
$page = "annuaire_entreprise.php";
$description = "Page annuaire de l'entreprise";
$keywords = "nom, prénom, fonction, photo, bio";
include("./scripts/functions.php");
parametres($page,$description,$keywords);
entete($page);
navigation($page);
if (isset($_SESSION['username'])) {
    $login = $_SESSION['username'];
} else {
    $login = null;
}

$liste_util = json_decode(file_get_contents("data/utilisateurs.json"),true);

$roles_connecte = [];
if (isset($liste_util[$login]['roles'])) {
    $roles_connecte = $liste_util[$login]['roles'];
}

$est_admin = false;
if (in_array('Administrateur', $roles_connecte)) {
    $est_admin = true;
}
echo "<div class='container-fluid ml-5 mr-5' >";
echo "<h1> 📖 Annuaire de l'entreprise </h1> ";
echo "<br>";
echo "<form method='POST' action='gestion.php'>";
echo "<table class='table table-striped table-info'>";
echo "<tr><th>Photo</th><th>Nom</th><th>Prenom</th><th>Fonction</th><th>Bio</th><th>Actions</th></tr>";
echo "<h2>Ajouter un nouvel utilisateur : </h2><br>";
if ($est_admin == true) {
    echo "<button class='btn btn-success' type='submit' name='ajouter' value='ajouter'>Ajouter un utilisateur</button>";
    echo"<br><br>";
}

// Parcours de chaque utilisateur dans le tableau JSON
foreach ($liste_util as $identifiant => $user) {  // $identifiant = clé (ex: jean.roland), $user = tableau des infos
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $role = implode(", ", $user['roles']); // Le rôles est un tableau, on le transforme en chaîne
    $bio = $user['bio']; 
    $photo = pp_search($nom,$prenom);
    if (!file_exists($photo)){
        $photo = "./images/default.jpg";
    }
    //ligne du tableau
    echo "<tr>";
    echo "<td><img src='".$photo."' alt='Photo de $prenom $nom' width='80' height='80'></td>";
    echo "<td>$nom</td>";
    echo "<td>$prenom</td>";
    echo "<td>$role</td>";
    echo "<td>$bio</td>";
    echo "<td>";
    if ($est_admin == true) {
        echo "<button class='btn btn-warning' type='submit' name='modification' value='".$identifiant."'>Modifier</button> ";
        echo "<button class='btn btn-danger' type='submit' name='suppression' value='".$identifiant."'>Supprimer</button> ";
    }

    // Si l'utilisateur est normal
    else {
     echo "-";
    }
    echo "</td>";
    echo "</tr>";
    
}
echo "</table>";
echo "</form>";

pieddepage();
?>
