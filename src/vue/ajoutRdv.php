<?php $titre = 'Nouveau rendez-vous';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1>Enregistrer un rendez-vous</h1>
    <div class="container">
      <form action="/index.php?action=addRdv" method="post">
        <input-field>
        <legend>Usager :</legend>
          <select name="usager" id="usager">
            <option value="">Veuillez choisir l'usager</option>
            <?php
              foreach ($usagers as $usager) {
                echo '<option value="'.$usager->getPersonne()->getIdPersonne().'">'.$usager->getPersonne()->getPrenom().' '.$usager->getPersonne()->getNom().'</option>';
              }
            ?>
          </select>
        </input-field>
        <input-field>
        <legend>Medecin :</legend>
          <select name="medecin" id="medecin">
            <option value="">Veuillez choisir le médecin</option>
            <?php
              foreach ($medecins as $medecin) {
                echo '<option value="'.$medecin->getPersonne()->getIdPersonne().'">'.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</option>';
              }
            ?>
          </select>
        </input-field>
        <input-field>
          <div class="form-group">
            <label for="date">Date : <input type="date" name="date" id="date"></label>
          </div>
          <div class="form-group">
            <label for="heure">Heure : <input type="time" name="heure" id="heure"></label>
          </div>
          <div class="form-group">
            <label for="duree">Durée (en minutes): <input type="number" name="duree" id="duree" value="30"></label>
          </div>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="/index.php?action=rdvs" class="btn btn-seconday">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>