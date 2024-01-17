<?php $titre = 'Médecins';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <h1 id="titre">
    Liste des medecins du cabinet
  </h1>
  <div class="container">
      <ul id="liste" class="list-group">
        <?php
          foreach($medecins as $medecin) {
            $id = $medecin->getPersonne()->getIdPersonne();
          echo '<a href="/index.php?action=detailMedecin&id='.$id.'"><li class="usager list-group-item list-group-item-action" id="'.$id.'">'.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</li></a>';
        }?>
      </ul>
    </div>
  <a href="/index.php?action=ajoutMedecin"><p>Ajouter</p></a>
  <?php
    require('footer.html');
  ?>
</body>
</html>