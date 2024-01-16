<?php $titre = 'Nouveau Médecin';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1>Ajouter un nouveau médecin</h1>
    <div class="container">
      <form action="/index.php?action=addMedecin" method="post">
        <input-field>
        <legend>Identité du médecin:</legend>
          <div class="form-group">
            <label for="prenom">Prénom : <input type="text" name="prenom" id="prenom"></label>
          </div>
          <div class="form-group">
            <label for="nom">Nom : <input type="text" name="nom" id="nom"></label>
          </div>
        </input-field>
        <input-field class="form-group">
          <legend>Civilité du médecin: </legend>
            <input type="radio" name="civilite" id="civiliteM" value="H">
          <label for="civiliteM">
            M
          </label>
            <input type="radio" name="civilite" id="civiliteMme" value="F">
          <label for="civiliteMme">
            Mme
          </label>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="/index.php?action=medecins" class="btn btn-seconday">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>