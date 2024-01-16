<?php $titre = 'Nouvel Usager';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.html');
  ?>
  <div class="container">
    <h1>Ajouter un nouvel usager</h1>
    <div class="container">
      <form action="/index.php?action=addUsager" method="post">
        <input-field>
        <legend>Identité de l'usager:</legend>
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
            <input type="radio" name="civilite" id="civiliteM" value="H">
          <label for="civiliteM">
            M
          </label>
            <input type="radio" name="civilite" id="civiliteMme" value="F">
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
            foreach($medecins as $medecin) {
              echo '<option value="'.$medecin->getPersonne()->getIdPersonne().'">Dr. '.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</option>';
            }
            ?>
          </select>
        </div>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="index.php?action=usagers" class="btn btn-seconday">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>