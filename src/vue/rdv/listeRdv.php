<?php $titre = 'Rendez-vous';
$css = 'rdvs';
require_once(__DIR__.'//../common/head.php'); ?>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
  <h1 id="titre">
    Liste des rendez-vous du cabinet
  </h1>
  <a id="ajout" class="btn btn-primary" href="/index.php?action=ajoutRdv"><p>Ajouter</p></a>
  <form action="/index.php?action=rdvs" method="post">
    <input-field>
      <legend>Filtrer</legend>
      <label for="medecin">Médecin: 
      <select name="medecin" id="medecin">
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
      </select></label>
      <label for="usager">Usager: 
      <select name="usager" id="usager">
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
      </select></label>
      <input class="btn btn-primary" type="submit" name="submit" value="Filtrer">
      <input class="btn btn-outline-primary" type="submit" name="submit" value="Réinitialiser">
    </input-field>
  </form>
  <ul id="liste">
    <?php 
    foreach($rdvs as $rdv) {
      $civilite = $rdv->getUsager()->getPersonne()->getCivilite()->name == 'H' ? 'M.' : 'Mme.';
      echo '
      <a href="/index.php?action=detailRdv&idMedecin='.$rdv->getMedecin()->getPersonne()->getIdPersonne().'&idUsager='.$rdv->getUsager()->getPersonne()->getIdPersonne().'&dateHeure='.$rdv->getDateHeureDebut()->format('Y-m-d H:i').'">
        <li>
          <p>Le <span class="bold">'.$rdv->getDateHeureDebut()->format('d/m/Y').'</span> <span class="no-wrap">à <span class="bold">'.$rdv->getDateHeureDebut()->format('H:i').'</span></span></p>
          <p>Dr. <span class="bold">'.$rdv->getMedecin()->getPersonne()->getNom().'</span> <span class="no-wrap">avec <span class="bold">'.$civilite.' '.$rdv->getUsager()->getPersonne()->getNom().'</span></span></p>
        </li>
      </a>';
    } ?>
  </ul>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>