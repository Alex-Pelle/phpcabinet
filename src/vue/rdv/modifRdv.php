<?php $titre = 'Détails '.$dateHeure;
$css = 'form';
require_once(__DIR__.'/../common/head.php'); ?>
</head>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
  <form action="/index.php?action=updateRdv" method="post">
    <div class="container">
      <h1 id="titre">Détails de ce rendez-vous</h1>
      <input-field>
        <legend>Médecin:</legend>
        <select name="idMedecin" id="idMedecin">
          <?php
          if (isset($medecin)) {
            echo '<option value="'.$medecin->getPersonne()->getIdPersonne().'">Dr. '.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</option>';
          } 
          echo '<option value="">Tous les médecins</option>';
          foreach($medecins as $medic) {
            if (!isset($medecin) || $medic->getPersonne()->getIdPersonne() != $medecin->getPersonne()->getIdPersonne()) {
              echo '<option value="'.$medic->getPersonne()->getIdPersonne().'">Dr. '.$medic->getPersonne()->getPrenom().' '.$medic->getPersonne()->getNom().'</option>';
            }
          }
          ?>
        </select>
      </input-field>
      <input-field>
        <legend>Usager:</legend>
        <select name="idUsager" id="idUsager">
          <?php
          if (isset($usager)) {
            echo '<option value="'.$usager->getPersonne()->getIdPersonne().'">'.$usager->getPersonne()->getPrenom().' '.$usager->getPersonne()->getNom().'</option>';
          } 
          echo '<option value="">Tous les usagers</option>';
          foreach($usagers as $user) {
            if (!isset($usager) || $user->getPersonne()->getIdPersonne() != $usager->getPersonne()->getIdPersonne()) {
              echo '<option value="'.$user->getPersonne()->getIdPersonne().'">'.$user->getPersonne()->getPrenom().' '.$user->getPersonne()->getNom().'</option>';
            }
          }
          ?>
        </select>
      </input-field>
      <input-field>
        <legend>Date</legend>
        <label for="date">Date : <input required type="date" name="date" id="date" value="<?= $dateFormatee?>" min="<?= (new DateTime())->format('Y-m-d')?>"></label>
        <label for="heure">Heure : <input required type="time" name="heure" id="heure" value="<?= $heure?>"></label>
        <label for="duree">Durée (en minutes): <input required type="number" name="duree" id="duree" value=<?= $duree?>></label>
      </input-field>
      <input hidden type="number" name="oldIdUsager" id="oldIdUsager" value="<?= $idUsager?>">
      <input hidden type="number" name="oldIdMedecin" id="oldIdMedecin" value="<?= $idMedecin?>">
      <input hidden type="oldDate" name="oldDate" value="<?= $dateFormatee?>">
      <input hidden type="time" name="oldHeure" id="oldHeure" value="<?= $heure?>">
      <div class="boutons">
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="/index.php?action=detailRdv&idMedecin=<?=$rdv->getMedecin()->getPersonne()->getIdPersonne().'&idUsager='.$rdv->getUsager()->getPersonne()->getIdPersonne().'&dateHeure='.$rdv->getDateHeureDebut()->format('Y-m-d H:i')?>"class="btn btn-secondary">Annuler</a>
      </div>
    </form>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>