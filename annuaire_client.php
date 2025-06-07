<?php
$page = "Annuaire des clients";
<<<<<<< HEAD
$description = "Annuaire client";
$keywords  = "default";

include("./scripts/functions.php");

$filename = './data/client.csv';
$rows     = [];

if (($handle = fopen($filename, 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ';')) !== false) {
        $rows[] = $data;
    }
    fclose($handle);
=======
$description = "Annuaire des clients";
$keywords  = "annuaire_client";

include("./scripts/functions.php");

$colonnes = [];

if (($fichier = fopen('./data/client.csv', 'r')) !== false) {
    while (($contenu = fgetcsv($fichier, 1000, ';')) !== false) {
        $colonnes[] = $contenu;
    }
    fclose($fichier);
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
}

if (isset($_GET['download'])) {
    $index = (int) $_GET['download'];

<<<<<<< HEAD
    if (!empty($rows[$index]) && count($rows[$index]) >= 4) {
        list($nom, $tel, $email, $adresse) = $rows[$index];

        $safeNom = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nom);

        header('Content-Type: text/plain; charset=utf-8');
        header('Content-Disposition: attachment; filename="fiche_client_' . $safeNom . '.txt"');
=======
    if (!empty($colonnes[$index]) && count($colonnes[$index]) >= 4) {
        list($nom, $tel, $email, $adresse) = $colonnes[$index];

        $nomnettoye = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nom);  /*'preg_replace' permet de nettoyer les caractères dans la chaine, on retrouve différentes option
                                                                    "^" permet de siginifier tout les caractères qui ne sont pas dans cette liste seront supprimé, on 
                                                                    retrouve ensuite les caractères de la liste non supprimer. Le second paramètre indique que les caractères supprimer seront remplacer par des underscore*/

        header('Content-Type: text/plain; charset=utf-8'); #permet de télécharger le fichier en .txt et non .html (indique au navigateur)
        header('Content-Disposition: attachment; filename="fiche_client_' . $nomnettoye . '.txt"'); #permet au navigateur de télécharger le fichier avec le nom en deuxième paramiètres
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154

        echo "FICHE CLIENT - $nom\n";
        echo "\n";
        echo "Nom       : $nom\n";
        echo "Téléphone : $tel\n";
        echo "E-mail    : $email\n";
        echo "Adresse   : $adresse\n";

<<<<<<< HEAD
        exit;
=======
        exit; /*permet d'interrompre l'exécution du reste de la page après le 
              téléchargement du fichier, cela ajouterais le contenu du fichier htlm au fichier client*/
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
    }
}

parametres($page, $description, $keywords);
entete($page);
navigation($page);
?>

<!-- JavaScript spécifique à cette page -->
<script src="./scripts/JavaScript.js" async></script>

<div class="container mt-4">
  <h1 class="mb-4">📖 Annuaire des clients</h1>
  <div class="alert alert-info">
    Vous pouvez consulter ou modifier les informations sur les clients.
  </div>

<?php


if (isset($_POST['save'])) {
    $index = (int) $_POST['index'];

    $newData = [
<<<<<<< HEAD
        trim($_POST['nom']),
=======
        trim($_POST['nom']),  #'trim' permet de supprimer les espaces en début et en fin de la chaine de caractères
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
        trim($_POST['telephone']),
        trim($_POST['email']),
        trim($_POST['adresse'])
    ];

<<<<<<< HEAD
    $rows[$index] = $newData;

    if (($fp = fopen($filename, 'w')) !== false) {
        foreach ($rows as $row) {
            fputcsv($fp, $row, ';');
        }
        fclose($fp);
    }

    header('Location: ' . $_SERVER['PHP_SELF'] . '#client' . $index);
    exit;
=======
    $colonnes[$index] = $newData;

    if (($fichier2 = fopen('./data/client.csv', 'w')) !== false) {
        foreach ($colonnes as $row) {
            fputcsv($fichier2, $row, ';');
        }
        fclose($fichier2);
    }

    header('Location: ' . $_SERVER['PHP_SELF'] . '#client' . $index); #$_SERVER['PHP_SELF'] permet de revenir à la page sans les modification, donc annuler
    exit; #comme précédemment, permet de na pas exécuter le reste du code pour évité des conflics
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
}
?>

<div class="table-responsive">
  <table class="table table-striped table-bordered bg-white text-center align-middle">
    <thead class="table-info">
      <tr>
        <th>Nom du client</th>
        <th>Numéro de téléphone</th>
        <th>Adresse E‑Mail</th>
        <th>Adresse postale</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
<<<<<<< HEAD
    <?php foreach ($rows as $index => $ligne): if ($index === 0) continue; // ignore l'entête
          if (count($ligne) < 4) continue; ?>
        <tr id="client-<?= $index ?>">
=======
    <?php foreach ($colonnes as $index => $ligne): if ($index === 0) continue; #ignore l'entête du csv
          if (count($ligne) < 4) continue; ?> <!-- ignore les lignes incomplètes -->
        <tr id="client-<?= $index ?>"> <!-- Création du tableau qui prends les informations du fichier csv -->
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
            <td>
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?download=<?= $index ?>" class="text-decoration-none">
                <?= htmlspecialchars($ligne[0]) ?>
            </a>
            </td>

<<<<<<< HEAD
          <td><?= htmlspecialchars($ligne[1]) ?></td>
          <td><?= htmlspecialchars($ligne[2]) ?></td>
          <td><?= htmlspecialchars($ligne[3]) ?></td>
          <td>
            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>#edit-form" class="m-0">
=======
          <td><?= htmlspecialchars($ligne[1]) ?></td> <!-- htmlspecialchars empêche l'injection html -->
          <td><?= htmlspecialchars($ligne[2]) ?></td>
          <td><?= htmlspecialchars($ligne[3]) ?></td>
          <td>
            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>#edit-form" class="m-0"> <!-- colonne du bouton modifier -->
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
              <input type="hidden" name="edit" value="<?= $index ?>">
              <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
            </form>



          </td>
        </tr>
<<<<<<< HEAD
    <?php endforeach; ?>
=======
    <?php endforeach; ?>  <!-- fin de la boucle foreach -->
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
    </tbody>
  </table>
</div>

<?php

if (isset($_POST['edit'])) {
<<<<<<< HEAD
    $editIndex = (int) $_POST['edit'];

    if (!empty($rows[$editIndex])) {
        $line = $rows[$editIndex];
?>
  <div class="card mt-4" id="edit-form">
=======
    $modifIndex = (int) $_POST['edit']; #vérifier que le bouton modifier est cliqué et ajoute un index à la ligne (et donc au client)

    if (!empty($colonnes[$modifIndex])) { #vérifie que l'index pointe vers une ligne existante et stocke les données du client
        $line = $colonnes[$modifIndex];
?>
  <div class="card mt-4" id="edit-form">  <!-- formulaire d'édition du client -->
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
    <div class="card-header bg-warning text-white">
      Modifier le client : <?= htmlspecialchars($line[0]) ?>
    </div>
    <div class="card-body">
      <form method="post">
<<<<<<< HEAD
        <input type="hidden" name="index" value="<?= $editIndex ?>">
        <div class="mb-3">
          <label class="form-label">Nom</label>
          <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($line[0]) ?>" required>
=======
        <input type="hidden" name="index" value="<?= $modifIndex ?>">
        <div class="mb-3">
          <label class="form-label">Nom</label>
          <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($line[0]) ?>" required>  <!-- 'required' le champs doit être remplit obligatoirement -->
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
        </div>
        <div class="mb-3">
          <label class="form-label">Téléphone</label>
          <input type="text" class="form-control" name="telephone" value="<?= htmlspecialchars($line[1]) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">E‑mail</label>
          <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($line[2]) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Adresse</label>
          <input type="text" class="form-control" name="adresse" value="<?= htmlspecialchars($line[3]) ?>" required>
        </div>
        <button type="submit" name="save" class="btn btn-success">Enregistrer</button>
        <a href="<?= $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary ms-2">Annuler</a>


      </form>
    </div>
  </div>
<?php
<<<<<<< HEAD
    }
=======
    } #fermeture des ifs
>>>>>>> 0a19149e01dc54b5ea917a2b2b3350028fb48154
}
?>
</div>

<?php pieddepage(); ?>