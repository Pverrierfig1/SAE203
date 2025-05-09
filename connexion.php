<?php
session_start();

echo'  <div class="card-header text-center">
            <h4>Connexion</h4>
          </div>
          <div class="card-body">
            <form action="login.php" method="POST">
              <!-- Champ Nom utilisateur -->
              <div class="mb-3">
                <label for="user" class="form-label">Nom d\'utilisateur :</label>
                <input type="text" class="form-control" id="user" name="user" required>
              </div>
              
              <!-- Champ Mot de passe -->
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              
              <!-- Bouton de connexion -->
              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Se connecter</button>
              </div>
            </form>';

?>
