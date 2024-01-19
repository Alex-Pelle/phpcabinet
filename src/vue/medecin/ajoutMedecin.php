<?php $titre = 'Nouveau Médecin';
$css = 'form';
require_once(__DIR__.'//../common/head.php'); ?>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
    <h1 id="titre">Ajouter un nouveau médecin</h1>
      <form action="/index.php?action=addMedecin" method="post">
        <input-field>
        <legend>Identité du médecin:</legend>
            <label for="prenom">Prénom : <input required type="text" name="prenom" id="prenom"></label>
            <label for="nom">Nom : <input required type="text" name="nom" id="nom"></label>
        </input-field>
        <input-field>
          <legend>Civilité du médecin: </legend>
          <label class="radio-label" for="civiliteM">
            <input type="radio" name="civilite" id="civiliteM" value="H"> M
          </label>
          <label class="radio-label" for="civiliteMme">
            <input type="radio" name="civilite" id="civiliteMme" value="F"> Mme
          </label>
        </input-field>
        <div class="boutons">
          <input class="btn btn-primary" type="submit" value="Enregistrer">
          <a href="/index.php?action=medecins" class="btn btn-secondary">Annuler</a>
        </div>
      </form>
    </div>
  </div>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>