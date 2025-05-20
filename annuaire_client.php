<?php
$page = "Annuaire des clients";
$description = "Annuaire client";
$keywords = "default";

include("./scripts/functions.php");

parametres($page,$description,$keywords);

entete($page);

navigation($page);

?>
<script src="./scripts/JavaScript.js" async></script> <!--A mettre dans le header pour cette page svp-->

<div class="container mt-4">
  <h1 class="mb-4">📖 Annuaire des clients</h1>

  <div class="alert alert-info">
    Vous pouvez consulter ou modifier les informations sur les clients.
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered bg-white text-center">
      <thead class="table-info">
        <tr>
          <th>Nom du client</th>
          <th>Numéro de téléphone</th>
          <th>Adresse E-Mail</th>
          <th>Adresse postale</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $filename = './data/client.csv';
        if (($handle = fopen($filename, 'r')) !== false) {
            fgetcsv($handle, 1000, ';'); // Ignore la première ligne (les en-têtes)

            while (($ligne = fgetcsv($handle, 1000, ';')) !== false) {
                if (count($ligne) >= 4) {
                    echo '<tr>';
                    foreach ($ligne as $champ) {
                        echo '<td>' . htmlspecialchars($champ) . '</td>';
                    }
                    echo '</tr>';
                }
            }
            fclose($handle);
        } else {
        echo '<tr><td colspan="4">Erreur : impossible d\'ouvrir le fichier.</td></tr>';
        }

      ?>
      </tbody>
    </table>
  </div>

</div>

<?php


pieddepage();
?>