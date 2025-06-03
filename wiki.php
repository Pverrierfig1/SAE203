<?php
$page = "wiki.php";
$description = "Page Wiki";
$keywords = "default";

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);

?>

<div class="text-center">
	<h1>Page Wiki</h1>
	<p>Dans cette page se trouve toutes les ressources et techniques utilisées pour concevoir le site</p>
	<br>
	<p> Ce portail web est composé de deux parties principales : </p>
	<li>Un site vitrine développé avec WordPress, présentant l'entreprise, ses activités et ses partenaires.</li>
	<li>Un intranet développé en PHP, HTML et Bootstrap, permettant aux salariés de collaborer et de partager des ressources</li>
</div>
<div class="card" style="width: 48rem;">
  <div class="card-body">
    <h5 class="card-title">Portail de connexion:</h5>
    <p class="card-text">
    	<ul>
    		<li> Connexion avec identifiant et mot de passe. </li>
			<li> Affectation des utilisateurs à différents groupes</li>
				<ul>
					<li><code>admin</code> : gestion complète du site ajout d'utilisateurs modification de leur profil ...</li>
					<li><code>direction</code> : </li>
					<li><code>manager</code> : </li>
					<li><code>salarié</code> : </li>
				</ul>
    	</ul>
    </p>
  </div>
</div>

<div class="card" style="width: 48rem;">
  <div class="card-body">
    <h5 class="card-title">Gestionnaire de fichiers:</h5>
    <p class="card-text">
    	<ul>
    		<li>Gestion de fichiers .txt et .csv ...  </li>
			<li> Possibilité d’ajouter, supprimer, et télécharger des fichiers selon les droits par groupe.</li>
    	</ul>
    </p>
  </div>
</div>

<div class="card" style="width: 48rem;">
  <div class="card-body">
    <h5 class="card-title">Annuaire de l'Entreprise:</h5>
    <p class="card-text">
    	<ul>
    		<li>Liste des collaborateurs avec :  </li>
			<ul>
				<li> Nom, prénom</li>
				<li>Fonction</li>
				<li>Photo</li>
				<li>Courte biographie</li>
			</ul>
			<li>Fonctionnalités : ajout, modification, suppression d’un profil (selon droits)</li>
    	</ul>
    </p>
  </div>
</div>

<div class="card" style="width: 48rem;">
  <div class="card-body">
    <h5 class="card-title">Annuaire des Partenaires:</h5>
    <p class="card-text">
    	<ul>
    		<li>Géré depuis l’intranet, mais affiché aussi sur le site vitrine. </li>
			<li>Infos visibles : nom du partenaire, logo miniature, description</li>	
    	</ul>
    </p>
  </div>
</div>

<div class="card" style="width: 48rem;">
  <div class="card-body">
    <h5 class="card-title">Annuaire Clients :</h5>
    <p class="card-text">
    	<ul>
    		<li>Informations disponibles :</li>
			<li>Nom, téléphone, mail, adresse</li>	
			<li> Possibilité de télécharger une fiche client au format PDF ou texte.</li>
    	</ul>
    </p>
  </div>
</div>

<div class="card" style="width: 48rem;">
  <div class="card-body">
    <h5 class="card-title">identifiant de test</h5>
    <p class="card-text">
    	<ul>
    	<li>Administrateur du site, Identifiant :<code>admin.admin</code> Mot de passe : <code>bonjour</code> </li>
		</ul>
	</p>
  </div>
</div>';
<?php
pieddepage();
?>