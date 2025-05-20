<?php
$page = "annuaire.php";
$description = "Page annuaire de l'entreprise";
$keywords = "nom, prénom, fonction, photo, bio";
include("./scripts/functions.php");
parametres($page,$description,$keywords);
entete($page);
navigation($page);
$liste_util = json_decode(file_get_contents("data/utilisateurs.json"),true);
echo "<h1 class='text-center'> Annuaire de l'entreprise </h1> ";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Photo</th><th>Nom</th><th>Prénom</th><th>Fonction</th><th>Bio</th></tr>";
// Parcours de chaque utilisateur dans le tableau JSON
foreach ($liste_util as $identifiant => $user) {  // $identifiant = clé (ex: jean.roland), $user = tableau des infos
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $role = implode(", ", $user['roles']); // Le rôles est un tableau, on le transforme en chaîne
    $bio = $user['bio']; 
    $photo = "./images/images_utilisateur/image_defaut.png"; // image par défaut pour tous pour l'instant
    echo "<tr>";
    echo "<td><img src='./images/images_utilisateur/image_defaut.png' alt='Photo de $prenom $nom' width='80' height='80'></td>";
    echo "<td>$nom</td>";
    echo "<td>$prenom</td>";
    echo "<td>$role</td>";
    echo "<td>$bio</td>";
    echo "</tr>";
}

echo "</table>";


pieddepage();
?>
