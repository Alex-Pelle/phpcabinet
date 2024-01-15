<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Nouvel usager</title>
</head>
<body>
  <?php
    require(__DIR__.'/header.html');
  ?>
  <div class="container">
    <?php
    ?>
    <h1>Modification de cet usager</h1>
    <div class="container">
      <form action="AjouterUsager.php" method="post">
        <input-field>
        <legend>Identité de l'usager:</legend>
          <div class="form-group">
            <label for="estMedecin"> Cet usager est-il aussi un médecin de cette clinique : <input type="checkbox" name="estMedecin" id="estMedecin"></label>
          </div>        
          <div class="form-group">
            <label for="nom">Nom : <input type="text" name="nom" id="nom"></label>
          </div>
          <div class="form-group">
            <label for="prenom">Prénom : <input type="text" name="prenom" id="prenom"></label>
          </div>
          <div class="form-group">
            <label for="numero_securite">Numéro de sécurité sociale : <input type="text" name="numero_securite" id="numero_securite"></label>
          </div>
        </input-field>
        <input-field class="form-group">
          <legend>Civilité de l'usager: </legend>
            <input type="radio" name="civilite" id="civiliteM" value="M">
          <label for="civiliteM">
            M
          </label>
            <input type="radio" name="civilite" id="civiliteMme" value="Mme">
          <label for="civiliteMme">
            Mme
          </label>
        </input-field>
        <input-field>
        <legend>Adresse</legend>
        <div class="form-group">
          <label for="adresse">Adresse <input type="text" name="adresse" id="adresse"></label>
        </div>
        <div class="form-group">
          <label for="code_postal">Code postal <input type="text" name="code_postal" id="code_postal"></label>
        </div>
        <div class="form-group">
          <label for="ville">Ville <input type="text" name="ville" id="ville"></label>
        </div>
        </input-field>
        <input-field>
        <legend>Médecin référent (optionnel)</legend>
        <div class="form-group">
          <label for="medecin_referent">Médecin référent : </label>
          <select name="medecin_referent" id="medecin_referent">
            <option value="">Pas de médecin référent</option>
            <?php
            //TODO liste des médecins dans des champs options, value="Id", texte = Nom prénom du médecin SAUF lui-même si il est aussi médecin
            ?>
          </select>
        </div>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="../controlleur/usagers.php" class="btn btn-seconday">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require(__DIR__.'/footer.html');
  ?>
</body>
</html>