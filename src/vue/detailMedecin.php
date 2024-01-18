<?php $titre = 'Détails Dr. '.$nom;
require_once(__DIR__.'/head.php'); ?>
</head>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1 id="titre">Détails du médecin <?=$prenom.' '.$nom?></h1>
    <div class="container">
      <h2>Identité du médecin:</h2>
      <p>Prénom: <?= $prenom?></p>
      <p>Nom: <?= $nom?></p>
      <p>Civilité: <?= $civilite?></p>
    </div>
    <a href="/index.php?action=modifMedecin&id=<?=$id?>" class="btn btn-primary">Modifier</button>
    <a href="/index.php?action=deleteMedecin&id=<?=$id?>" class="btn btn-danger">Supprimer</button>
    <a href="/index.php?action=medecins" class="btn btn-secondary">Retour à la liste</a>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>