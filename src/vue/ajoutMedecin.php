<?php $titre = 'Nouveau Médecin';
$css = 'form';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
    <h1 id="titre">Ajouter un nouveau médecin</h1>
      <form action="/index.php?action=addMedecin" method="post">
        <input-field>
        <legend>Identité du médecin:</legend>
            <label for="prenom">Prénom : <input type="text" name="prenom" id="prenom"></label>
            <label for="nom">Nom : <input type="text" name="nom" id="nom"></label>
        </input-field>
        <input-field>
          <legend>Civilité du médecin: </legend>
          <label class="radio-label" for="civiliteM">
            M <input type="radio" name="civilite" id="civiliteM" value="H">
          </label>
          <label class="radio-label" for="civiliteMme">
            Mme  <input type="radio" name="civilite" id="civiliteMme" value="F">
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