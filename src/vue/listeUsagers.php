<?php $titre = 'Usagers';
$css = 'usagers';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
    <h1 id="titre">
      Liste des usagers du cabinet
    </h1>
    <a id="ajout" href="/index.php?action=ajoutUsager"><p class="btn btn-primary" >Ajouter</p></a>
    <ul id="liste">
      <?php
        foreach($usagers as $usager) {
          $id = $usager->getPersonne()->getIdPersonne();
        echo '<a class="usager '.$usager->getPersonne()->getCivilite()->name.'" href="/index.php?action=detailUsager&id='.$id.'"><li id="'.$id.'">'.$usager->getPersonne()->getPrenom().' '.$usager->getPersonne()->getNom().' <span>('.$usager->getNumero_securite().')</span></li></a>';
      }?>
    </ul>
  <?php
    require('footer.html');
  ?>
</body>
</html>