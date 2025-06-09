<?php
$page = "Gestion des utilisateurs";
$description = "Page de gestion";
$keywords = "gestion";

$roles = ["Administrateur", "Manager", "Direction", "Salarié"];

function deleteFolder($folder) {
    foreach (scandir($folder) as $child) {
        if ($child != "." && $child != "..") {
            $path = $folder . "/" . $child;
            if (is_dir($path)) {  // Corrected this line
                deleteFolder($path);
            } else {
                unlink($path);
            }
        }
    }
    rmdir($folder);
}

include("./scripts/functions.php");

$data = json_decode(file_get_contents("./data/utilisateurs.json"), true);

parametres($page, $description, $keywords);
entete($page);
navigation($page);

if (!isset($_SESSION['username']) or !in_array("Administrateur", $_SESSION['roles'])){
  header('Location: ./accueil.php');          // vérification si l'utilisateurs peut accéder a la page, si non il est rediriger sur l'accueil
}

if (isset($_POST["name"])) { // Traitement de l'inscription d'un utilisateur

    $username = strtolower($_POST["prenom"]) . "." . strtolower($_POST["name"]); // clé = prenom.nom
    if (!isset($data[$username])) {
        $data[$username] = [
            "nom" => $_POST["name"],
            "prenom" => $_POST["prenom"],
            "telephone" => $_POST["tel"],
            "roles" => $_POST["roles"],
            "email" => $_POST["email"],
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
            "bio" => ""
        ];

        $result = file_put_contents("./data/utilisateurs.json", json_encode($data));
        if ($result === false) {
            alert("<strong>Erreur !</strong> L'utilisateur n'a pas été enregistré...");
        } else {
            echo '
            <div class="alert alert-success mt-5 container">
                <strong>Utilisateur créé !</strong>
            </div>';
        }
    } else {
        alert("<strong>Erreur !</strong> Email invalide.");
    }

} elseif (isset($_POST["ajouter"])) { // Affichage du formulaire d'ajout

    echo '
    <div class="container">
        <h1 class="mt-4">Création d\'un utilisateur</h1>
        <form method="POST" action="#">
            <a href="./gestion.php" class="btn btn-info">Tableau de bord</a>
            <button type="submit" class="btn btn-info" name="ajouter">Ajout d\'employé</button>
            <a href="./annuaire_entreprise.php" class="btn btn-info">Gérer les employés</a>
        </form>
        <form action="#" method="POST">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Nom de l\'utilisateur</label>
                <input type="text" class="form-control" id="name" placeholder="Entrez un nom" name="name" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Entrez le prénom de l\'utilisateur</label>
                <input type="text" class="form-control" id="prenom" placeholder="Entrez un prénom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Entrez le numéro de téléphone de l\'utilisateur</label>
                <input type="tel" class="form-control" id="tel" placeholder="Entrez un numéro de téléphone" name="tel" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Entrez l\'e-mail de l\'utilisateur</label>
                <input type="email" class="form-control" id="email" placeholder="Entrez un e-mail" name="email" required>
            </div>';

    foreach ($roles as $role) {
        $checked = ($role == "Salarié") ? "checked" : "";
        echo '
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="' . $role . '" name="roles[]" value="' . $role . '" ' . $checked . '>
                <label class="form-check-label" for="' . $role . '">' . $role . '</label>
            </div>';
    }

    echo '
            <div class="mb-3 mt-3">
                <label for="password" class="form-label">Entrez le mot de passe de l\'utilisateur</label>
                <input type="password" class="form-control" id="password" placeholder="Entrez un mot de passe" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Création</button>
        </form>
    </div>';

} elseif (isset($_POST["modification"])) { // Modification de l'utilisateur
    $username = $_POST["modification"];

    if (!isset($data[$username])) {
        alert("<strong>Erreur !</strong> L'utilisateur n'existe pas...");
    } else {
        $user = $data[$username];

        echo '
        <div class="container">
            <h1 class="mt-4">Modification de l\'utilisateur ' . htmlspecialchars($user["prenom"]) . ' ' . htmlspecialchars($user["nom"]) . '</h1>
            <form method="POST" action="#">
                <input type="hidden" name="username" value="' . htmlspecialchars($username) . '">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" value="' . htmlspecialchars($user["nom"]) . '" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" value="' . htmlspecialchars($user["prenom"]) . '" disabled>
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="' . htmlspecialchars($user["telephone"]) . '" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="' . htmlspecialchars($user["email"]) . '" required>
                </div>';

        foreach ($roles as $role) {
            $checked = in_array($role, $user["roles"]) ? "checked" : "";
            echo '
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="' . $role . '" name="roles[]" value="' . $role . '" ' . $checked . '>
                    <label class="form-check-label" for="' . $role . '">' . $role . '</label>
                </div>';
        }

        echo '
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" name="valider_modification">Modifier</button>
                    <a href="./gestion.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>';
    }

} elseif (isset($_POST["suppression"])) { // Suppression utilisateur

    $prenom = $data[$_POST["suppression"]]["prenom"];
    $nom = $data[$_POST["suppression"]]["nom"];
    $photo = pp_search($prenom, $nom);

    unset($data[$_POST["suppression"]]);
    file_put_contents("./data/utilisateurs.json", json_encode($data));

    if (is_dir("./data/users/" . $_POST["suppression"])) {
        deleteFolder("./data/users/" . $_POST["suppression"]);
    }
    if (file_exists($photo)) {
        unlink($photo);
    }

    $uploads = json_decode(file_get_contents("./data/uploads.json"), true);
    if (isset($uploads[$_POST["suppression"]])) {
        unset($uploads[$_POST["suppression"]]);
        file_put_contents("./data/uploads.json", json_encode($uploads));
    }

    echo '
    <div class="alert alert-success mt-5 container">
        <p>L\'utilisateur <strong>' . htmlspecialchars($prenom) . ' ' . htmlspecialchars($nom) . '</strong> a été supprimé</p>
    </div>';

} elseif (isset($_POST["valider_modification"])) {
    $username = $_POST["username"];
    $data[$username]["telephone"] = $_POST["tel"];
    $data[$username]["email"] = $_POST["email"];
    $data[$username]["roles"] = $_POST["roles"];

    $result = file_put_contents("./data/utilisateurs.json", json_encode($data));
    if ($result === false) {
        alert("<strong>Erreur !</strong> Les modifications n'ont pas été enregistrées.");
    } else {
        echo '
        <div class="alert alert-success mt-5 container">
            <strong>Utilisateur modifié avec succès !</strong>
        </div>';
    }

} else {
    $file = file("./data/client.csv", FILE_SKIP_EMPTY_LINES);

    echo '
    <div class="container-fluid row">
        <div class="btn-group-vertical col-1">
            <form method="POST" action="#">
                <a href="./gestion.php" class="btn btn-info">Tableau de bord</a>
                <button type="submit" class="btn btn-info mt-2" name="ajouter">Ajout d\'employé</button>
                <a href="./annuaire_entreprise.php" class="btn btn-info mt-2">Gérer les employés</a>
            </form>
        </div>
        <div class="row col text-center">
            <h2 class="mt-4">Tableau de bord</h2>
            <hr class="mt-4 mb-5">
            <div class="col card bg-primary p-4 me-4">
                <h3>Nombres d\'employés</h3>
                <p>' . count($data) . '</p>
            </div>
            <div class="col card bg-warning p-4 me-4">
                <h3>Nombre de clients</h3>
                <p>' . (count($file) - 1) . '</p>
            </div>
            <div class="col card bg-success p-4 me-4">
                <h3>Stockage utilisé par le partage</h3>
                <p>' . round(stockage("./data/users") / 1024 / 1024, 2) . ' Mo</p>
            </div>
        </div>
        <div class="div text-center mt-5 row">
            <div class="col card bg-secondary p-4 ms-4 me-4">
                <h3>RAM utilisé par le serveur</h3>
                <p>' . round(memory_get_usage() / 1024 / 1024, 2) . ' Mo</p>
            </div>
            <div class="col card bg-dark p-4 text-white me-4">
                <h3>Espace disponible</h3>
                <p>' . round(disk_free_space("./") / disk_total_space("./") * 100, 2) . '%</p>
            </div>
            <div class="col card bg-info p-4 me-4">
                <h3>Espace disponible (en Go)</h3>
                <p>' . round(disk_free_space("./") / 1024 / 1024 / 1024) . ' Go</p>
            </div>
        </div>
    </div>
    <div class="container card bg-light p-5 mt-5 text-center">
        <h2><u>Bienvenue sur le tableau de bord</u></h2>
        <p>Gérez facilement le contenu, les utilisateurs et les paramètres du site grâce à cet espace centralisé.
            Suivez les statistiques, effectuez des mises à jour et assurez le bon fonctionnement de la plateforme en toute simplicité.</p>
    </div>';
}

pieddepage();
?>