<?php $titre = 'Nouvel Usager';
$css = 'form';
require_once(__DIR__.'//../common/head.php'); ?>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
    <h1 id="titre">Ajouter un nouvel usager</h1>
      <form action="/index.php?action=addUsager" method="post">
        <input-field>
        <legend>Identité de l'usager:</legend>
            <label for="prenom">Prénom : <input required type="text" name="prenom" id="prenom"></label>
            <label for="nom">Nom : <input required type="text" name="nom" id="nom"></label>
            <label for="numero_securite">Numéro de sécurité sociale : <input required type="text" pattern="[0-9]{13}" name="numero_securite" id="numero_securite"></label>
            <label for="date_naissance">Date de naissance : <input required type="date" name="date_naissance" id="date_naissance" max="<?= (new DateTime())->format('Y-m-d')?>"></label>
            <label for="lieu_naissance">Lieu de naissance : <input required type="text" name="lieu_naissance" id="lieu_naissance"></label>
        </input-field>
        <input-field>
          <legend>Civilité de l'usager: </legend>
          <label class="radio-label" for="civiliteM">
            <input type="radio" name="civilite" id="civiliteM" value="H"> M
          </label>
          <label class="radio-label" for="civiliteMme">
            <input type="radio" name="civilite" id="civiliteMme" value="F"> Mme
          </label>
        </input-field>
        <input-field>
        <legend>Adresse</legend>
          <label for="adresse">Adresse <input required type="text" name="adresse" id="adresse"></label>
          <label for="code_postal">Code postal <input required type="text" pattern="[0-9]{5}" name="code_postal" id="code_postal"></label>
          <label for="ville">Ville <input required type="text" name="ville" id="ville"></label>
        </input-field>
        <input-field>
        <legend>Médecin référent (optionnel)</legend>
          <label for="medecin_referent">Médecin référent : 
          <select name="medecin_referent" id="medecin_referent">
            <option value="">Pas de médecin référent</option>
            <?php
            foreach($medecins as $medecin) {
              echo '<option value="'.$medecin->getPersonne()->getIdPersonne().'">Dr. '.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</option>';
            }
            ?>
          </select></label>
        </input-field>
        <div class="boutons">
          <input class="btn btn-primary" type="submit" value="Enregistrer">
          <a href="index.php?action=usagers" class="btn btn-secondary">Annuler</a>
        </div>
      </form>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>