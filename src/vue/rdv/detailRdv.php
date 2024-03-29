<?php $titre = 'Détails '.$dateHeure;
$css ='detail';
require_once(__DIR__.'/../common/head.php'); ?>
</head>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
  <h1 id="titre">Détails de ce rendez-vous</h1>
  <div id="contenu">
    <div class="champs">
      <a href="/index.php?action=detailUsager&id=<?= $idUsager?>">
        <h2>Usager: </h2>
        <p><?= $civilite?> <?= $prenomUsager?> <?= $nomUsager?></p>
        <p>Numéro de sécurité sociale: <?= $securite?></p>
        <p></p>
      </a>
    </div>
    <div class="champs">
      <a href="/index.php?action=detailMedecin&id=<?= $idMedecin?>">
        <h2>Médecin:</h2>
        <p>Prénom: <?= $prenomMedecin?></p>
        <p>Nom: <?= $nomMedecin?></p>
      </a>
    </div>
    <div class="champs">
      <h2>Date:</h2>
      <p>Date: <?= $date?></p>
      <p>Heure: <?= $heure?></p>
      <p>Durée: <?= $duree?> minutes</p>
    </div>
    <div class="boutons">
      <a href="/index.php?action=modifRdv&idMedecin=<?=$rdv->getMedecin()->getPersonne()->getIdPersonne().'&idUsager='.$rdv->getUsager()->getPersonne()->getIdPersonne().'&dateHeure='.$rdv->getDateHeureDebut()->format('Y-m-d H:i')?>"class="btn btn-primary">Modifier</button>
      <a href="/index.php?action=deleteRdv&idMedecin=<?=$rdv->getMedecin()->getPersonne()->getIdPersonne().'&idUsager='.$rdv->getUsager()->getPersonne()->getIdPersonne().'&dateHeure='.$rdv->getDateHeureDebut()->format('Y-m-d H:i')?>"class="btn btn-danger">Supprimer</button>
      <a href="/index.php?action=rdvs" class="btn btn-secondary">Retour à la liste</a>
    </div>
  </div>
    <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>