<?php

$page = "Mon profil";
$description = "Modifier mon profil";
$keywords  = "profil utilisateur";

include("./scripts/functions.php");

if (!isset($_SESSION['nom'])) {
    header('Location: login.php');
    exit;
}

$filename = './data/employes.json';
$photoDir = './data/photos/';
$userid   = $_SESSION['nom'];

$employes = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

if (!isset($employes[$userid])) {
    die("Utilisateur non trouvé.");
}

$user = $employes[$userid];

// Sauvegarde du profil
if (isset($_POST['save'])) {
    $user['nom']       = trim($_POST['nom']);
    $user['prenom']    = trim($_POST['prenom']);
    $user['telephone'] = trim($_POST['telephone']);
    $user['email']     = trim($_POST['email']);
    $user['bio']       = trim($_POST['bio']);

    // Gestion de la photo
    if (!empty($_FILES['photo']['name'])) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (in_array($_FILES['photo']['type'], $allowedTypes)) {
            $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $photoName = $userid . '.' . $extension;
            $destination = $photoDir . $photoName;

            if (!file_exists($photoDir)) {
                mkdir($photoDir, 0777, true);
            }

            move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
            $user['photo'] = $photoName;
        }
    }

    $employes[$userid] = $user;
    file_put_contents($filename, json_encode($employes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

parametres($page, $description, $keywords);
entete($page);
navigation($page);
?>

<div class="container mt-4">
  <h1 class="mb-4">👤 Mon Profil</h1>
  <div class="alert alert-info">Modifiez vos informations personnelles.</div>

  <div class="row">
    <div class="col-md-4 text-center">
      <div class="card">
        <div class="card-header bg-secondary text-white">Photo de profil</div>
        <div class="card-body">
          <?php
          $photoPath = $photoDir . ($user['photo'] ?? '');
          if (!empty($user['photo']) && file_exists($photoPath)): ?>
            <img src="<?= $photoPath ?>" alt="Photo de profil" class="img-fluid rounded-circle mb-2" style="max-height: 200px;">
          <?php else: ?>
            <img src="https://via.placeholder.com/200x200?text=Profil" alt="Aucune photo" class="img-fluid rounded-circle mb-2">
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Nom</label>
          <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($user['nom']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Prénom</label>
          <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($user['prenom']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Téléphone</label>
          <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($user['telephone']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Bio</label>
          <textarea name="bio" class="form-control" rows="4"><?= htmlspecialchars($user['bio']) ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Photo de profil</label>
          <input type="file" name="photo" accept="image/*" class="form-control">
        </div>
        <button type="submit" name="save" class="btn btn-success">Enregistrer</button>
        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-secondary ms-2">Annuler</a>
      </form>
    </div>
  </div>
</div>

<?php pieddepage(); ?>
