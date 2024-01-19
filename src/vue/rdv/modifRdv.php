<?php $titre = 'Détails '.$dateHeure;
$css = 'form';
require_once(__DIR__.'//../common/head.php'); ?>
</head>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
  <form action="/index.php?action=updateRdv" method="post">
    <div class="container">
      <h1 id="titre">Détails de ce rendez-vous</h1>
      <div class="container">
        <h2>Usager: </h2>
        <p><?= $civilite?> <?= $prenomUsager?> <?= $nomUsager?></p>
        <p>Numéro de sécurité sociale: <?= $securite?></p>
      </div>
      <div class="container">
        <h2>Médecin:</h2>
        <p>Prénom: <?= $prenomMedecin?></p>
        <p>Nom: <?= $nomMedecin?></p>
      </div>
      <div class="container">
        <h2>Date:</h2>
        <p>Date: <?= $date?></p>
        <p>Heure: <?= $heure?></p>
        <label style="padding-left:0" for="duree">Durée (en minutes): <input required type="number" name="duree" id="duree" value="<?= $duree?>"></label>
      </div>
      <input hidden type="number" name="idUsager" id="idUsager" value="<?= $idUsager?>">
      <input hidden type="number" name="idMedecin" id="idMedecin" value="<?= $idMedecin?>">
      <label hidden for="date">Date : <input type="date" name="date" value="<?= $dateFormatee?>"></label>
      <input hidden type="time" name="heure" id="heure" value="<?= $heure?>">
      <div class="boutons">
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="/index.php?action=detailRdv&idMedecin=<?=$rdv->getMedecin()->getPersonne()->getIdPersonne().'&idUsager='.$rdv->getUsager()->getPersonne()->getIdPersonne().'&dateHeure='.$rdv->getDateHeureDebut()->format('Y-m-d H:i')?>"class="btn btn-secondary">Annuler</a>
      </div>
    </form>
  </div>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>