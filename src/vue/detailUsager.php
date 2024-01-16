<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Détails <?= $nom?></title>
</head>
<body>
  <?php
    require('header.html');
  ?>
  <div class="container">
    <h1>Détails de l'usager <?=$nom?></h1>
    <div class="container">
      <h2>Identité de l'usager:</h2>
      <p>Nom: <?= $nom?></p>
      <p>Prénom: <?= $prenom?></p>
      <p>Numéro de sécurité sociale: <?= $securite?></p>
      <p>Civilité: <?= $civilite?></p>
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
    <a href="/index.php?action=usagers" class="btn btn-seconday">Retour</a>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>