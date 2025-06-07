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

// Création ou modification
if (isset($_POST["nom"])) {
    if (isset($_POST["id"])) {
        $new_id = $_POST["id"];
    } else {
        $new_id = strtolower(str_replace(" ", "_", $_POST["nom"]));
    }

    // Gestion du logo uploadé
    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["logo"]["tmp_name"];
        $nom_origin = basename($_FILES["logo"]["name"]);
        $extension = pathinfo($nom_origin, PATHINFO_EXTENSION);

        $extensions_valides = ['jpg', 'jpeg', 'png'];
        if (in_array(strtolower($extension), $extensions_valides)) {
            $n_logo = $new_id . '.' . $extension;
            move_uploaded_file($tmp_name, $dossier_logo . $n_logo);
        } else {
            echo "<div class='alert alert-danger'>Extension de fichier non autorisée.</div>";
            $n_logo = "default_logo.jpg";
        }
    } elseif (isset($_POST["id"]) && isset($data[$_POST["id"]])) {
        // On garde l'ancien logo s'il n'y a pas eu de changement
        $n_logo = $data[$_POST["id"]]["logo"];
    } else {
        $n_logo = "default_logo.jpg";
    }

    // Suppression de l'ancien fournisseur si ID changé
    if (!empty($_POST["id"]) && $_POST["id"] !== $new_id) {
    $old_id = $_POST["id"];
    $old_logo = "";

    if (isset($data[$old_id]["logo"])) {
        $old_logo = $data[$old_id]["logo"];
    }

    if ($old_logo !== "default_logo.jpg" && file_exists($dossier_logo . $old_logo)) {
        unlink($dossier_logo . $old_logo);
    }

    unset($data[$old_id]);
}

    // Enregistrement des données mises à jour
    $data[$new_id] = [
        "nom" => $_POST["nom"],
        "description" => $_POST["description"],
        "logo" => $n_logo
    ];

    file_put_contents($fichier_fournisseurs, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: annuaire_partenaire.php");
    exit;
}

// gestion de la suppression
elseif (isset($_POST["supprimer"])) {
    $id = $_POST["supprimer"];
    if (isset($data[$id])) {
        // Supprimer le logo du fournisseur sauf s'il est "default_logo.jpg"
        $logo = $data[$id]["logo"];
        if ($logo !== "default_logo.jpg" && file_exists($dossier_logo . $logo)) {
            unlink($dossier_logo . $logo);
        }

        unset($data[$id]);
        file_put_contents($fichier_fournisseurs, json_encode($data, JSON_PRETTY_PRINT));
    }
    header("Location: annuaire_partenaire.php");
    exit;
}

// Formulaire de modification 
elseif (isset($_POST["modifier"])) {
    $id = $_POST["modifier"];

    if (isset($data[$id])) {
        $fournisseur = $data[$id];

        echo '<div class="container mt-4">
                <h2>Modification du fournisseur</h2>
                <form method="POST" enctype="multipart/form-data" action="gestion_fournisseur.php">
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
                        <label class="form-label">Changer le logo</label>
                        <input type="file" class="form-control" name="logo" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Valider la modification</button>
                </form>
            </div>';
    } else {
        echo "<div class='alert alert-danger'>Fournisseur introuvable.</div>";
    }
}

// Formulaire d'ajout 
elseif (isset($_POST["ajouter"])) {
    echo '<div class="container mt-4">
            <h2>Ajouter un nouveau fournisseur</h2>
            <form method="POST" enctype="multipart/form-data" action="gestion_fournisseur.php">
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

pieddepage();
?>
