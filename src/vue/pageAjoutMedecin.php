<?php $titre = 'Nouveau Médecin';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.html');
  ?>
  <div class="container">
    <h1>Ajouter un nouveau médecin</h1>
    <div class="container">
      <form action="AjouterMedecin.php" method="post">
        <input-field>
        <legend>Identité du médecin:</legend>
          <div class="form-group">
            <label for="nom">Nom : <input type="text" name="nom" id="nom"></label>
          </div>
          <div class="form-group">
            <label for="prenom">Prénom : <input type="text" name="prenom" id="prenom"></label>
          </div>
        </input-field>
        <input-field class="form-group">
          <legend>Civilité du médecin: </legend>
            <input type="radio" name="civilite" id="civiliteM" value="M">
          <label for="civiliteM">
            M
          </label>
            <input type="radio" name="civilite" id="civiliteMme" value="Mme">
          <label for="civiliteMme">
            Mme
          </label>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="../controlleur/medecins.php" class="btn btn-seconday">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>