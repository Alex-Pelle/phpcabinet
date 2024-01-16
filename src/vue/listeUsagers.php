<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usagers</title>
</head>
<body>
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