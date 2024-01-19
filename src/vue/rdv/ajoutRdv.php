<?php $titre = 'Nouveau rendez-vous';
$css = 'form';
require_once(__DIR__.'/../common/head.php'); ?>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
    <h1 id="titre">Enregistrer un rendez-vous</h1>
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
            <label for="date">Date : <input required type="date" name="date" id="date" min="<?= (new DateTime())->format('Y-m-d')?>"></label>
            <label for="heure">Heure : <input required type="time" name="heure" id="heure"></label>
            <label for="duree">Durée (en minutes): <input required type="number" name="duree" id="duree" value="30"></label>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="/index.php?action=rdvs" class="btn btn-secondary">Annuler</a>
      </form>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>