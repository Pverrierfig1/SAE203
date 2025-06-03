<?php
$page = "wiki.php";
$description = "Page Wiki";
$keywords = "default";

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);
?>

<div class="container">
    <div class="text-center mb-5">
        <h1 class="display-4 text-primary">Page Wiki</h1>
        <p class="lead">Cette page présente toutes les ressources et techniques utilisées pour concevoir le site.</p>
        <hr class="my-4">
        <p >
            Ce portail web est composé de deux parties principales :
            <br>
            <strong>1.</strong> Un site vitrine développé avec WordPress, présentant l'entreprise, ses activités et ses partenaires.
            <br>
            <strong>2.</strong> Un intranet développé en PHP, HTML et Bootstrap, permettant aux salariés de collaborer et de partager des ressources.
        </p>
    </div>

    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Portail de connexion</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Connexion avec identifiant et mot de passe.</li>
                <li class="list-group-item">Affectation des utilisateurs à différents groupes :
                    <ul>
                        <li><code>admin</code> : gestion complète du site (ajout d'utilisateurs, modification de profils...)</li>
                        <li><code>direction</code> : accès aux rapports et à la supervision</li>
                        <li><code>manager</code> : gestion d'équipe</li>
                        <li><code>salarié</code> : accès aux outils de travail</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Gestionnaire de fichiers</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Gestion de fichiers .txt et .csv</li>
                <li class="list-group-item">Ajout, suppression, et téléchargement selon les droits du groupe</li>
            </ul>
        </div>
    </div>

    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary">Annuaire de l'entreprise</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Liste des collaborateurs :
                    <ul>
                        <li>Nom, prénom</li>
                        <li>Fonction</li>
                        <li>Photo</li>
                        <li>Biographie courte</li>
                    </ul>
                </li>
                <li class="list-group-item">Ajout, modification et suppression de profil (selon droits)</li>
            </ul>
        </div>
    </div>

    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Annuaire des Partenaires</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Géré depuis l’intranet, mais affiché aussi sur le site vitrine.</li>
                <li class="list-group-item">Informations visibles : nom, logo miniature, description</li>
            </ul>
        </div>
    </div>

    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Annuaire Clients</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Nom, téléphone, mail, adresse</li>
                <li class="list-group-item">Téléchargement de fiche client (PDF ou texte)</li>
            </ul>
        </div>
    </div>

    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary">Identifiants de test</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Administrateur : <code>admin.admin</code> | Mot de passe : <code>bonjour</code></li>
            </ul>
        </div>
    </div>
</div>

<?php
pieddepage();
?>
