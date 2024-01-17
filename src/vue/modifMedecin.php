<?php $titre = 'Modification '.$nom;
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1 id="titre">Modification de l'medecin <?=$nom?></h1>
    <div class="container">
      <form action="/index.php?action=updateMedecin" method="post">
        <input hidden type="text" name="id" value="<?= $id?>">
        <input-field>
        <legend>Identité de l'medecin:</legend>
          <div class="form-group">
            <label for="prenom">Prénom : <input type="text" name="prenom" id="prenom" value="<?= $prenom?>"></label>
          </div>
          <div class="form-group">
            <label for="nom">Nom : <input type="text" name="nom" id="nom" value="<?= $nom?>"></label>
          </div>
          </input-field>
        <input-field class="form-group">
          <legend>Civilité de l'medecin: </legend>
            <input type="radio" name="civilite" id="civiliteM" value="M" <?= $isHomme? 'checked="checked"':''?>>
          <label for="civiliteM">
            M
          </label>
            <input type="radio" name="civilite" id="civiliteMme" value="Mme" <?= $isHomme? '':'checked="checked"'?>>
          <label for="civiliteMme">
            Mme
          </label>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="/index.php?action=detailMedecin&id=<?= $id?>" class="btn btn-secondary">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>