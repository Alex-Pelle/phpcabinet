<?php $titre = 'Médecins';
$css = 'medecins';
require_once(__DIR__.'/../common/head.php'); ?>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
  <h1 id="titre">
    Liste des medecins du cabinet
  </h1>
  <a id="ajout" href="/index.php?action=ajoutMedecin"><p class="btn btn-primary">Ajouter</p></a>
  <div class="container">
      <ul id="liste" class="list-group">
        <?php
          foreach($medecins as $medecin) {
            $id = $medecin->getPersonne()->getIdPersonne();
          echo '<a class="medecin" href="/index.php?action=detailMedecin&id='.$id.'"><li id="'.$id.'">'.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</li></a>';
        }?>
      </ul>
    </div>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>