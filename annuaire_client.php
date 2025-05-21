<?php
$page = "Annuaire des clients";
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
}

if (isset($_GET['download'])) {
    $index = (int) $_GET['download'];

    if (!empty($rows[$index]) && count($rows[$index]) >= 4) {
        list($nom, $tel, $email, $adresse) = $rows[$index];

        $safeNom = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nom);

        header('Content-Type: text/plain; charset=utf-8');
        header('Content-Disposition: attachment; filename="fiche_client_' . $safeNom . '.txt"');

        echo "FICHE CLIENT - $nom\n";
        echo "\n";
        echo "Nom       : $nom\n";
        echo "Téléphone : $tel\n";
        echo "E-mail    : $email\n";
        echo "Adresse   : $adresse\n";

        exit;
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
        trim($_POST['nom']),
        trim($_POST['telephone']),
        trim($_POST['email']),
        trim($_POST['adresse'])
    ];

    $rows[$index] = $newData;

    if (($fp = fopen($filename, 'w')) !== false) {
        foreach ($rows as $row) {
            fputcsv($fp, $row, ';');
        }
        fclose($fp);
    }

    header('Location: ' . $_SERVER['PHP_SELF'] . '#client' . $index);
    exit;
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
    <?php foreach ($rows as $index => $ligne): if ($index === 0) continue; // ignore l'entête
          if (count($ligne) < 4) continue; ?>
        <tr id="client-<?= $index ?>">
            <td>
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?download=<?= $index ?>" class="text-decoration-none">
                <?= htmlspecialchars($ligne[0]) ?>
            </a>
            </td>

          <td><?= htmlspecialchars($ligne[1]) ?></td>
          <td><?= htmlspecialchars($ligne[2]) ?></td>
          <td><?= htmlspecialchars($ligne[3]) ?></td>
          <td>
            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>#edit-form" class="m-0">
              <input type="hidden" name="edit" value="<?= $index ?>">
              <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
            </form>



          </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php

if (isset($_POST['edit'])) {
    $editIndex = (int) $_POST['edit'];

    if (!empty($rows[$editIndex])) {
        $line = $rows[$editIndex];
?>
  <div class="card mt-4" id="edit-form">
    <div class="card-header bg-warning text-white">
      Modifier le client : <?= htmlspecialchars($line[0]) ?>
    </div>
    <div class="card-body">
      <form method="post">
        <input type="hidden" name="index" value="<?= $editIndex ?>">
        <div class="mb-3">
          <label class="form-label">Nom</label>
          <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($line[0]) ?>" required>
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
    }
}
?>
</div>

<?php pieddepage(); ?>