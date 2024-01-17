<?php $titre = 'Détails '.$nom;
require_once(__DIR__.'/head.php'); ?>
</head>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1 id="titre">Détails de l'usager <?=$nom?></h1>
    <div class="container">
      <h2>Identité de l'usager:</h2>
      <p>Prénom: <?= $prenom?></p>
      <p>Nom: <?= $nom?></p>
      <p>Numéro de sécurité sociale: <?= $securite?></p>
      <p>Civilité: <?= $civilite?></p>
      <p>Date de naissance: <?= $date_naissance?></p>
      <p>Lieu de naissance: <?= $lieu_naissance?></p>
    </div>
    <div class="container">
      <h2>Adresse</h2>
      <p>Adresse: <?= $adresse?></p>
      <p>Code postal: <?= $cp?></p>
      <p>Ville: <?= $ville?></p>
    </div>
    <?php if (isset($medecin)) {
      echo '<div class="container">
      <h2>Médecin référent</h2>
      <p>Dr. '.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</p>
      </div>';
    }?>
    <a href="/index.php?action=modifUsager&id=<?=$id?>" class="btn btn-primary">Modifier</button>
    <a href="/index.php?action=deleteUsager&id=<?=$id?>" class="btn btn-danger">Supprimer</button>
    <a href="/index.php?action=usagers" class="btn btn-seconday">Retour à la liste</a>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>