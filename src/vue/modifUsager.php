<?php $titre = 'Modification '.$nom;
$css = 'form';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <h1 id="titre">Modification de l'usager <?=$nom?></h1>
  <form action="/index.php?action=updateUsager" method="post">
    <input hidden type="text" name="id" value="<?= $id?>">
    <input-field>
    <legend>Identité de l'usager:</legend>
      <label for="prenom">Prénom : <input required type="text" name="prenom" id="prenom" value="<?= $prenom?>"></label>
      <label for="nom">Nom : <input required type="text" name="nom" id="nom" value="<?= $nom?>"></label>
      <label for="numero_securite">Numéro de sécurité sociale : <input required type="text" pattern="[0-9]{13}"  name="numero_securite" id="numero_securite" value="<?= $securite?>"  ></label>
      <label for="date_naissance">Date de naissance : <input required type="date" name="date_naissance" id="date_naissance" max="<?= (new DateTime())->format('Y-m-d')?>" value="<?= $date_naissance?>"></label>
      <label for="lieu_naissance">Lieu de naissance : <input required type="text" name="lieu_naissance" id="lieu_naissance" value="<?= $lieu_naissance?>" ></label>
    <input-field>
      <legend>Civilité de l'usager: </legend>
      <label class="radio-label" for="civiliteM">
        <input type="radio" name="civilite" id="civiliteM" value="M" <?= $isHomme? 'checked="checked"':''?>> M
      </label>
      <label class="radio-label"   for="civiliteMme">
        <input type="radio" name="civilite" id="civiliteMme" value="Mme" <?= $isHomme? '':'checked="checked"'?>> Mme 
      </label>
    </input-field>
    <input-field>
    <legend>Adresse</legend>
      <label for="adresse">Adresse <input required type="text" name="adresse" id="adresse" value="<?= $adresse?>"></label>
      <label for="code_postal">Code postal <input required type="text" pattern="[0-9]{5}"  name="code_postal" id="code_postal" value="<?= $cp?>"></label>
      <label for="ville">Ville <input required type="text" name="ville" id="ville" value="<?= $ville?>"></label>
    </input-field>
    <input-field>
    <legend>Médecin référent (optionnel)</legend>
      <label for="medecin_referent">Médecin référent :
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
      </label>
    </input-field>
    <div class="boutons">
      <input class="btn btn-primary" type="submit" value="Enregistrer">
      <a href="/index.php?action=detailUsager&id=<?= $id?>" class="btn btn-secondary">Annuler</a>
    </div>
  </form>
  <?php
    require('footer.html');
  ?>
</body>
</html>