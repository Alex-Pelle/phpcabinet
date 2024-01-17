<?php $titre = 'Modification '.$nom;
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <div class="container">
    <h1>Modification de l'usager <?=$nom?></h1>
    <div class="container">
      <form action="/index.php?action=updateUsager" method="post">
        <input hidden type="text" name="id" value="<?= $id?>">
        <input-field>
        <legend>Identité de l'usager:</legend>
          <div class="form-group">
            <label for="prenom">Prénom : <input type="text" name="prenom" id="prenom" value="<?= $prenom?>"></label>
          </div>
          <div class="form-group">
            <label for="nom">Nom : <input type="text" name="nom" id="nom" value="<?= $nom?>"></label>
          </div>
          <div class="form-group">
            <label for="numero_securite">Numéro de sécurité sociale : <input type="text" name="numero_securite" id="numero_securite" value="<?= $securite?>"  ></label>
          </div>
          <div class="form-group">
            <label for="date_naissance">Date de naissance : <input type="date" name="date_naissance" id="date_naissance" value="<?= $date_naissance?>" ></label>
          </div>
          <div class="form-group">
            <label for="lieu_naissance">Lieu de naissance : <input type="text" name="lieu_naissance" id="lieu_naissance" value="<?= $lieu_naissance?>" ></label>
          </div>
        </input-field>
        <input-field class="form-group">
          <legend>Civilité de l'usager: </legend>
            <input type="radio" name="civilite" id="civiliteM" value="M" <?= $isHomme? 'checked="checked"':''?>>
          <label for="civiliteM">
            M
          </label>
            <input type="radio" name="civilite" id="civiliteMme" value="Mme" <?= $isHomme? '':'checked="checked"'?>>
          <label for="civiliteMme">
            Mme
          </label>
        </input-field>
        <input-field>
        <legend>Adresse</legend>
        <div class="form-group">
          <label for="adresse">Adresse <input type="text" name="adresse" id="adresse" value="<?= $adresse?>"></label>
        </div>
        <div class="form-group">
          <label for="code_postal">Code postal <input type="text" name="code_postal" id="code_postal" value="<?= $cp?>"></label>
        </div>
        <div class="form-group">
          <label for="ville">Ville <input type="text" name="ville" id="ville" value="<?= $ville?>"></label>
        </div>
        </input-field>
        <input-field>
        <legend>Médecin référent (optionnel)</legend>
        <div class="form-group">
          <label for="medecin_referent">Médecin référent : </label>
          <select name="medecin_referent" id="medecin_referent">
            <?php
            if (isset($medecin)) {
              echo '<option value="'.$medecin->getPersonne()->getIdPersonne().'">Dr. '.$medecin->getPersonne()->getPrenom().' '.$medecin->getPersonne()->getNom().'</option>';
            } else {
              echo '<option value="">Pas de médecin référent</option>';
              
            }
            foreach($medecins as $medic) {
              if (!isset($medecin) || $medic->getPersonne()->getIdPersonne() != $medecin->getPersonne()->getIdPersonne()) {
                echo '<option value="'.$medic->getPersonne()->getIdPersonne().'">Dr. '.$medic->getPersonne()->getPrenom().' '.$medic->getPersonne()->getNom().'</option>';
              }
            }
            ?>
          </select>
        </div>
        </input-field>
        <input class="btn btn-primary" type="submit" value="Enregistrer">
        <a href="/index.php?action=detailUsager&id=<?= $id?>" class="btn btn-seconday">Annuler</a>
      </form>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>