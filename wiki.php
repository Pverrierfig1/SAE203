<?php
$page = "Wiki";
$description = "Page Wiki";
$keywords = "default";

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);
?>

<div class="container">
    <div class="text-center mb-5">
        <h1 class="display-4 text-info mt-4"><u>Page Wiki</u></h1>
        <p class="lead">Cette page présente toutes les ressources et techniques utilisées pour concevoir le site.</p>
        <hr class="my-4">
        <p>
            Ce portail web est composé de deux parties principales :
            <br>
            <strong>1.</strong> Un site vitrine développé avec WordPress, présentant l'entreprise, ses activités et ses partenaires.
            <br>
            <strong>2.</strong> Un intranet développé en PHP, HTML et Bootstrap, permettant aux salariés de collaborer et de partager des ressources.
        </p>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Les différentes pages du site web</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Liste des pages :
                    <ul>
                        <li><code>Accueil</code> : l'accueil de l'intranet, <em>accueil.php</em></li>
                        <li><code>Annuaire des clients</code> : contient la liste des clients de l'entreprise, <em>annuaire_client.php</em></li>
                        <li><code>Annuaire des fournisseurs partenaires</code> : contient la liste des fournisseurs partenaires de l'entreprise, <em>annuaire_fournisseurs.php</em></li>
                        <li><code>Annuaire de l'entreprise</code> : contient la liste des employés de l'entreprise, <em>annuaire_entreprise.php</em></li>
                        <li><code>Connexion</code> : page de connexion des utilisateurs, <em>connexion.php</em></li>
                        <li><code>Déconnexion</code> : page de déconnexion des utilisateurs, <em>deconnexion.php</em></li>
                        <li><code>Gestion</code> : page de gestion générale du serveur et du site, <em>gestion.php</em></li>
                        <li><code>Gestion des fournisseurs</code> : page de gestion des fournisseurs, <em>gestion_fournisseurs.php</em></li>
                        <li>Gestionnaire de fichier
                            <ul>
                                <li><code>Visualisation</code> : page pour consulter et télécharger des fichiers déposés par les autres utilisateurs, <em>partage.php</em></li>
                                <li><code>Modification</code> : zone de dépôt des fichiers à partager, <em>depot.php</em></li>
                            </ul>
                        </li>
                        <li><code>profil</code> : profil de l'utilisateur, <em>profil.php</em></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Annuaire des clients</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Fonctionnalités :
                    <ul>
                        <li><code>Ajouter</code> : des nouveaux clients</li>
                        <li><code>Modifier</code> : les informations concernant un client</li>
                        <li><code>Supprimer</code> : un client</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Annuaire des fournisseurs partenaires</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Fonctionnalités :
                    <ul>
                        <li><code>Ajouter</code> : des nouveaux fournisseurs</li>
                        <li><code>Modifier</code> : les informations concernant un fournisseur</li>
                        <li><code>Supprimer</code> : un fournisseur</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Annuaire de l'entreprise</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Fonctionnalités :
                    <ul>
                        <li><code>Ajouter</code> : des nouveaux employés</li>
                        <li><code>Modifier</code> : les informations concernant un employé</li>
                        <li><code>Supprimer</code> : un employé</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Gestion</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Fonctionnalités :
                    <ul>
                        <li><code>Ajouter</code> : un nouvel employé</li>
                        <li><code>Accéder</code> à la page de l'annuaire de l'entreprise</li>
                        <li><code>Afficher</code> plusieurs statistiques concernant l'état du serveur ainsi que des informations sur l'entreprise</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Gestion des fournisseurs</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Fonctionnalités :
                    <ul>
                        <li><code>Ajouter</code> : des nouveaux fournisseurs</li>
                        <li><code>Modifier</code> : les informations concernant un fournisseur</li>
                        <li><code>Supprimer</code> : un fournisseur</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Gestionnaire des fichiers</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Fonctionnalités :
                    <ul>
                        <li><code>Visualisation</code> : permet de consulter, télécharger ou supprimer les fichiers déposés dans l'espace de partage</li>
                        <li><code>Modification</code> : permet d'ajouter un fichier dans l'espace de partage</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Profil</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Fonctionnalités :
                    <ul>
                        <li><code>Modification</code> : permet de consulter et modifier sa photo de profil (.png, .jpg, .jpeg), sa bio</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Portail de connexion</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Affectation des utilisateurs à différents groupes :
                    <ul>
                        <li><code>admin</code> : accès complet au site</li>
                        <li><code>direction</code> : accès aux annuaires et à l'espace partagé</li>
                        <li><code>manager</code> : accès aux annuaires</li>
                        <li><code>salarié</code> : uniquement accès à l'accueil de l'intranet</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary">Identifiants de test</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Administrateur : <code>admin.admin</code> | Mot de passe : <code>bonjour</code></li>
                <li class="list-group-item">Manager : <code>donald.truck</code> | Mot de passe : <code>bonjour</code></li>
                <li class="list-group-item">Direction : <code>jo.bidonne</code> | Mot de passe : <code>bonjour</code></li>
                <li class="list-group-item">Salarié : <code>jean.dujardin</code> | Mot de passe : <code>bonjour</code></li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-body bg-light">
            <h5 class="card-title text-primary"> Intranet</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Accès
                    <ul>
                        <li>Pour accéder à l'intranet depuis le WordPress on peut soit :
                            <ul class="list-group list-group-flush">
                                <li>utiliser le bouton sur le site vitrine</li>
                                <li>utiliser la redirection avec l'URL suivante : <em>/wordpress/intranet</em></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>


<?php
pieddepage();
?>
