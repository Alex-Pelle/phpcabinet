<?php $titre = 'Nouveau rendez-vous';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1>Enregistrer un rendez-vous</h1>
    <div class="container">
      <form action="AjouterMedecin.php" method="post">
        <input-field>
        <legend>Usager :</legend>
          <select name="usager" id="usager">
            <option value="">Veuillez choisir l'usager</option>
            <?php
            //TODO liste des usagers sous forme de <option value="ID">PRENOM NOM</option>
            ?>
          </select>
        </input-field>
        <input-field>
        <legend>Medecin :</legend>
          <select name="medecin" id="medecin">
            <option value="">Veuillez choisir le médecin</option>
            <?php
            //TODO liste des usagers sous forme de <option value="ID">PRENOM NOM</option>
            ?>
          </select>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="../index.php" class="btn btn-seconday">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>