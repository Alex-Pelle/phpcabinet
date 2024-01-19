<?php $titre = 'Détails Dr. '.$nom;
$css = 'detail';
require_once(__DIR__.'//../common/head.php'); ?>
</head>
<body>
  <?php
    require(__DIR__.'/..//../common/header.php');
  ?>
  <h1 id="titre">Détails du médecin <?=$prenom.' '.$nom?></h1>
  <div id="contenu">
    <div id="champs">
        <h2>Identité du médecin:</h2>
        <p>Prénom: <?= $prenom?></p>
        <p>Nom: <?= $nom?></p>
        <p>Civilité: <?= $civilite?></p>
    </div>
    <div class="boutons">
      <a href="/index.php?action=modifMedecin&id=<?=$id?>" class="btn btn-primary">Modifier</a>
      <a href="/index.php?action=deleteMedecin&id=<?=$id?>" class="btn btn-danger">Supprimer</a>
      <a href="/index.php?action=medecins" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>