<?php
$page = "gestion_fournisseur.php";
$description = "Page de gestion des partenaires";
$keywords = "fournisseurs, partenaires, plomberie, logo";

include("./scripts/functions.php");

$data = json_decode(file_get_contents("./data/fournisseurs.json"), true);
$fichier_fournisseurs = "./data/fournisseurs.json";
$dossier_logo = "./images/logo/";

parametres($page, $description, $keywords);
entete($page);
navigation($page);

// --- Création ou modification ---
if (isset($_POST["nom"])) {
    $new_id = strtolower(str_replace(" ", "_", $_POST["nom"]));
    $logo_name = "";

    // Gestion de l'upload si un fichier est fourni
    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["logo"]["tmp_name"];
        $original_name = basename($_FILES["logo"]["name"]);
        $extension = pathinfo($original_name, PATHINFO_EXTENSION);

        // Sécurité : autoriser que les images
        $extensions_valides = ['jpg', 'jpeg', 'png'];
        if (in_array(strtolower($extension), $extensions_valides)) {
            $logo_name = $new_id . '.' . $extension;
            move_uploaded_file($tmp_name, $dossier_logo . $logo_name);
        } else {
            alert("Extension de fichier non autorisée.");
            $logo_name = "default_logo.jpg";
        }
    } else if (isset($_POST["id"]) && isset($data[$_POST["id"]])) {
        // Cas modification sans nouveau logo : on garde l'ancien
        $logo_name = $data[$_POST["id"]]["logo"];
    } else {
        $logo_name = "default_logo.jpg";
    }

    // Suppression de l'ancien fournisseur si c'est une modif et ID a changé
    if (isset($_POST["id"]) && $_POST["id"] !== $new_id) {
        unset($data[$_POST["id"]]);
    }

    // Mise à jour ou ajout
    $data[$new_id] = [
        "nom" => $_POST["nom"],
        "description" => $_POST["description"],
        "logo" => $logo_name
    ];

    if (file_put_contents($fichier_fournisseurs, json_encode($data))) {
        echo '<div class="alert alert-success container mt-4">Fournisseur enregistré avec succès !</div>';
        header("Location: annuaire_fournisseurs.php");
    } else {
        alert("<strong>Erreur !</strong> Impossible d'enregistrer le fournisseur.");
    }
}

// --- Formulaire de modification ---
elseif (isset($_POST["modifier"])) {
    $id = $_POST["modifier"];
    $fournisseur = $data[$id];

    echo '<div class="container mt-4">
            <h2>Modification du fournisseur</h2>
            <form method="POST" enctype="multipart/form-data" action="#">
                <input type="hidden" name="id" value="'.htmlspecialchars($id).'">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="'.htmlspecialchars($fournisseur['nom']).'" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" required>'.htmlspecialchars($fournisseur['description']).'</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Changer le logo (optionnel)</label>
                    <input type="file" class="form-control" name="logo" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Valider la modification</button>
            </form>
        </div>';
}

// --- Suppression ---
elseif (isset($_POST["supprimer"])) {
    $id = $_POST["supprimer"];
    if (isset($data[$id])) {
        unset($data[$id]);
        file_put_contents($fichier_fournisseurs, json_encode($data));
        echo '<div class="alert alert-success container mt-4">Fournisseur supprimé avec succès.</div>';
        header("Location: annuaire_fournisseurs.php");
        exit;
    } else {
        alert("<strong>Erreur !</strong> Le fournisseur n'existe pas.");
    }
}

// --- Formulaire d'ajout ---
elseif (isset($_POST["ajouter"])) {
    echo '<div class="container mt-4">
            <h2>Ajouter un nouveau fournisseur</h2>
            <form method="POST" enctype="multipart/form-data" action="#">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    <input type="file" class="form-control" name="logo" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-success">Créer le fournisseur</button>
            </form>
        </div>';
}

// --- Liste des fournisseurs ---
else {
    echo '<div class="container mt-4">
            <h1>Gestion des fournisseurs partenaires</h1>
            <form method="POST" action="#">
                <button type="submit" name="ajouter" class="btn btn-success mb-3">Ajouter un fournisseur</button>
                <table class="table table-striped">
                    <thead><tr><th>Logo</th><th>Nom</th><th>Description</th><th>Actions</th></tr></thead> ';
    foreach ($data as $id => $fournisseur) {
        $logo = $dossier_logo . $fournisseur['logo'];
        if (!file_exists($logo)) {
            $logo = $dossier_logo . 'default_logo.jpg';
        }
        echo '<tr>
                <td><img src="'.$logo.'" alt="Logo '.$fournisseur['nom'].'" width="80"></td>
                <td>'.htmlspecialchars($fournisseur['nom']).'</td>
                <td>'.htmlspecialchars($fournisseur['description']).'</td>
                <td>
                    <button class="btn btn-warning" type="submit" name="modifier" value="'.$id.'">Modifier</button>
                    <button class="btn btn-danger" type="submit" name="supprimer" value="'.$id.'">Supprimer</button>
                </td>
              </tr>';
    }
    echo '     </table>
            </form>
        </div>';
}

pieddepage();
?>
