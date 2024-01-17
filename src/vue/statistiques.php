<?php $titre = 'Statistiques';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <h1 id="titre">Statistiques</h1>
  <table>
    <thead>
      <tr>
        <th>Tranche d'âge</th>
        <th>Femme</th>
        <th>Homme</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Moins de 25 ans</th>
        <td><?= $mf?></td>
        <td><?= $mh?></td>
      </tr>
      <tr>
        <th>Entre 25 et 50 ans</th>
        <td><?= $ef?></td>
        <td><?= $eh?></td>
      </tr>
      <tr>
        <th>Plus de 50 ans</th>
        <td><?= $pf?></td>
        <td><?= $ph?></td>
      </tr>
    </tbody>
  </table>
  <?php
    require('footer.html');
  ?>
</body>
</html>