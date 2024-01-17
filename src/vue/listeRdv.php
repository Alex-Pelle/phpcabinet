<?php $titre = 'Rendez-vous';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <h1 id="titre">
    Liste des rendez-vous du cabinet
  </h1>
  <ul id="liste">
    <?php 
    foreach($rdvs as $rdv) {
      echo '
      <li>
        <a href="/index.php?action=detailRdv&idMedecin='.$rdv->getMedecin()->getPersonne()->getIdPersonne().'&idUsager='.$rdv->getUsager()->getPersonne()->getIdPersonne().'&dateHeure='.$rdv->getDateHeureDebut()->format('Y-m-d h:i').'">
          <p>Le '.$rdv->getDateHeureDebut()->format('d/m/Y \à h:m').'</p>
          <p>Dr. '.$rdv->getMedecin()->getPersonne()->getNom().' avec '.$rdv->getUsager()->getPersonne()->getNom().'</p>
        </a>
      </li>';
    } ?>
  </ul>
  <a href="/index.php?action=ajoutRdv"><p>Ajouter</p></a>
  <?php
    require('footer.html');
  ?>
</body>
</html>