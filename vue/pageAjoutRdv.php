<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
  <title>Nouveau rendez-vous</title>
</head>
<body>
  <?php
    require('header.html');
  ?>
  <div class="container">
    <h1>Enregistrer un rendez-vous</h1>
    <div class="container">
      <form action="AjouterMedecin.php" method="post">
        <input-field>
        <legend>Usager :</legend>
          <select name="usager" id="usager">
            <option value="">Veuillez choisir l'usager</option>
            <?php
            //TODO liste des usagers sous forme de <option value="ID">PRENOM NOM</option>
            ?>
          </select>
        </input-field>
        <input-field>
        <legend>Medecin :</legend>
          <select name="medecin" id="medecin">
            <option value="">Veuillez choisir le médecin</option>
            <?php
            //TODO liste des usagers sous forme de <option value="ID">PRENOM NOM</option>
            ?>
          </select>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="index.php" class="btn btn-seconday">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>