<?php $titre = 'Usagers';
require_once(__DIR__.'/head.php'); ?>
<body class ="container">
  <?php
    require('header.html');
  ?>
  <div class="container">
    <h1>
      Liste des usagers du cabinet
    </h1>
    <div class="container">
      <ul id="liste" class="list-group">
        <?php
          foreach($usagers as $usager) {
            $id = $usager->getPersonne()->getIdPersonne();
          echo '<a href="/index.php?action=detailUsager&id='.$id.'"><li class="usager list-group-item list-group-item-action" id="'.$id.'">'.$usager->getPersonne()->getPrenom().' '.$usager->getPersonne()->getNom().' ('.$usager->getNumero_securite().')</li></a>';
        }?>
      </ul>
    </div>
    <div class="container">
      <a href="/index.php?action=ajoutUsager"><p class="btn btn-primary" >Ajouter</p></a>
    </div>
  </div>
  <?php
    require('footer.html');
  ?>
</body>
</html>