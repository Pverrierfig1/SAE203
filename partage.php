<?php
$page = "Page de partage";
$description = "Page de partage, visualisation, suppression et téléchargement de fichier";
$keywords = "suppresion_visualisation_téléchargement";

include("./scripts/functions.php");

parametres($page,$description,$keywords);

entete($page);

navigation($page);

?>

<div class="container mt-4">
  <h1 class="mb-4">📁 Espace de partage</h1>

  <div class="alert alert-info">
    Vous pouvez consulter ou télécharger les fichiers déposés par les autres.
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered bg-white text-center">
      <thead class="table-info">
        <tr>
          <th>Nom du fichier</th>
          <th>Propriétaire</th>
          <th>Taille</th>
          <th>Date de dépôt</th>
          <th>Partagé avec</th>
          <th>Actions</th>
          <th>Commentaires</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if (isset($_POST['bouton_suppression'])){suppression($_POST['bouton_suppression']);} // si le bouton "bouton_suppression" est pressé alors l'appelle de la fonctione suppression avec l'argument $chemin sera effectué
      $data = json_decode(file_get_contents("./data/utilisateurs.json"),true);
      $uploads = json_decode(file_get_contents("./data/uploads.json"),true);

      foreach($uploads as $user=>$fichiers) {
      	foreach($fichiers as $fichier=>$vals){
      		$chemin = "./data/users/".$user."/".$fichier;
							echo('
							<tr>
							  <td>'.$fichier.'</td>
							  <td>'.$data[$user]["nom"].' '.$data[$user]["prenom"].'</td>
							  <td>'.round(filesize($chemin)/1024/1024, 2).' Mo</td>
							  <td>'.date ("d/m/Y H:i", filemtime($chemin)).'</td>
							  <td>'.implode(', ', $vals["roles"]).'</td>
							  <td>
							    <button class="btn btn-sm btn-outline-secondary me-2 voir" data-bs-toggle="modal" data-bs-target="#visualiseur" data-file="'.$chemin.'">👁️ Consulter</button>
							    
							    <a href="'.$chemin.'" class="btn btn-sm btn-primary me-2" download>📥 Télécharger</a>
							    
							    <form action="./depot.php" method="POST">
							      <input type="hidden" name="nomfichier" value="'.$fichier.'">
							      <button type="submit" class="btn btn-sm btn-warning me-2 modifier mt-3">✏️ Modifier</button>
							      <button type="submit" name="bouton_suppression" class="btn btn-sm me-2 btn-danger mt-3">🗑️ Supprimer</button>
							    </form>
							  </td>
							  <td>'.$vals['commentaires'].'</td>
							</tr>
							');// l'attribute data-bs-target est pour boostrap afin qu'il affiche en model la frame avec l'id de l'attribute. L'attribute data-file est pour le js afin qu'il affiche dans l'iframe le doc.
      	} // implode retire les characteres donnée
      }

      ?>
      </tbody>
    </table>
  </div>


	<div class="modal fade" id="visualiseur">
	  <div class="modal-dialog modal-xl">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h4 class="modal-title text-center w-100">Visualiseur de fichiers</h4> <!--On doit mettre la class w-100 pour élagrire la bande reservé au titre sinon le text-center ne fera pas le rendu voulu-->
	        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
	      </div>

	      <div class="modal-body">
	          <iframe id="vue" class="container" height="600"></iframe>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
	      </div>

	    </div>
	  </div>
	</div>

</div>

<?php


pieddepage();
?>