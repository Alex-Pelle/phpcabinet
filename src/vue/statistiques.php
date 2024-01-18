<?php $titre = 'Statistiques';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
  ?>
  <h1 id="titre">Statistiques</h1>
  <h2> Répartition des usagers</h2>
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
  <h2>Heures des médecins</h2>
  <?php
  echo '<table>
  <thead>
      <tr>
          <th>Médecin</th>
          <th>Durée totale (heures)</th>
      </tr>
  </thead>
  <tbody>';

  foreach ($liste as $medecin => $dureeTotale) {
  echo "<tr>
        <td>$medecin</td>
        <td>$dureeTotale</td>
      </tr>";
  }

  echo '</tbody></table>';
  ?>
  <?php
    require('footer.html');
  ?>
</body>
</html>