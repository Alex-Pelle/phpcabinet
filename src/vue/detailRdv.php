<?php $titre = 'Détails '.$dateHeure;
require_once(__DIR__.'/head.php'); ?>
</head>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1>Détails de ce rendez-vous</h1>
    <div class="container">
      <a href="/index.php?action=detailUsager&id=<?= $idUsager?>">
        <h2>Usager: </h2>
        <p><?= $civilite?> <?= $prenomUsager?> <?= $nomUsager?></p>
        <p>Numéro de sécurité sociale: <?= $securite?></p>
        <p></p>
      </a>
    </div>
    <div class="container">
      <a href="/index.php?action=detailMedecin&id=<?= $idMedecin?>">
        <h2>Médecin:</h2>
        <p>Prénom: <?= $prenomMedecinr?></p>
        <p>Nom: <?= $nomMedecin?></p>
      </a>
    </div>
    <div class="container">
      <h2>Date:</h2>
      <p>Date: <?= $date?></p>
      <p>Heure: <?= $heure?></p>
      <p>Durée: <?= $duree?></p>
    </div>
    <?php if (isset($medecin)) {
      echo '<div class="container">
      <h2>Médecin référent</h2>
      <p>Dr. '.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</p>
      </div>';
    }?>
    <a href="/index.php?action=modifUsager&id=<?=$id?>" class="btn btn-primary">Modifier</button>
    <a href="/index.php?action=deleteUsager&id=<?=$id?>" class="btn btn-danger">Supprimer</button>
    <a href="/index.php?action=usagers" class="btn btn-seconday">Retour</a>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>