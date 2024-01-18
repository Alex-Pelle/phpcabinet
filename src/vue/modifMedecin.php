<?php $titre = 'Modification '.$prenom.' '.$nom;
$css = 'form';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1 id="titre">Modification du médecin <?= $prenom.' '.$nom?></h1>
    <div class="container">
      <form action="/index.php?action=updateMedecin" method="post">
        <input hidden type="text" name="id" value="<?= $id?>">
        <input-field>
        <legend>Identité du médecin:</legend>
          <div class="form-group">
            <label for="prenom">Prénom : <input required type="text" name="prenom" id="prenom" value="<?= $prenom?>"></label>
          </div>
          <div class="form-group">
            <label for="nom">Nom : <input required type="text" name="nom" id="nom" value="<?= $nom?>"></label>
          </div>
          </input-field>
        <input-field class="form-group">
          <legend>Civilité du médecin: </legend>
          <label class="radio-label" for="civiliteM">
            <input type="radio" name="civilite" id="civiliteM" value="M" <?= $isHomme? 'checked="checked"':''?>> M
          </label>
          <label class="radio-label"   for="civiliteMme">
            <input type="radio" name="civilite" id="civiliteMme" value="Mme" <?= $isHomme? '':'checked="checked"'?>> Mme 
          </label>
        </input-field>
        <div class="boutons">
          <input class="btn btn-primary" type="submit" value="Enregistrer">
          <a href="/index.php?action=detailMedecin&id=<?= $id?>" class="btn btn-secondary">Annuler</a>
        </div>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>