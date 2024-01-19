<?php $titre = 'Usagers';
$css = 'usagers';
require_once(__DIR__.'//../common/head.php'); ?>
<body>
  <?php
    require(__DIR__.'/../common/header.php');
  ?>
    <h1 id="titre">
      Liste des usagers du cabinet
    </h1>
    <a id="ajout" href="/index.php?action=ajoutUsager"><p class="btn btn-primary" >Ajouter</p></a>
    <ul id="liste">
      <?php
        foreach($usagers as $usager) {
          $id = $usager->getPersonne()->getIdPersonne();
          $civilite = $usager->getPersonne()->getCivilite()->name == 'H' ? 'M.' : 'Mme.';
        echo '<a class="usager '.$usager->getPersonne()->getCivilite()->name.'" href="/index.php?action=detailUsager&id='.$id.'"><li id="'.$id.'">'.$civilite.' '.$usager->getPersonne()->getPrenom().' '.$usager->getPersonne()->getNom().' <span>('.$usager->getNumero_securite().')</span></li></a>';
      }?>
    </ul>
  <?php
    require(__DIR__.'/../common/footer.html');
  ?>
</body>
</html>