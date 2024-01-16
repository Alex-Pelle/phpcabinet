<?php $titre = 'Usagers';
require_once(__DIR__.'/head.php'); ?>
<body class ="container">
  <?php
    require('header.html');
  ?>
  <h1>
    Liste des usagers du cabinet
  </h1>
  <ul id="liste">
    <?php
      foreach($usagers as $usager) {
        $id = $usager->getPersonne()->getIdPersonne();
      echo '<a href="/index.php?action=detailUsager&id='.$id.'"><li class="usager" id="'.$id.'">'.$usager->getPersonne()->getNom().'</li></a>';
    }?>
  </ul>
  <a href="/index.php?action=ajoutUsager"><p>Ajouter</p></a>
  <?php
    require('footer.html');
  ?>
</body>
</html>