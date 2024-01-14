<?php
if (isset($_POST['id'])) {
  require('../vue/detailUsager.php');
}
else {
  require('../vue/listeUsagers.php');
}
    //Lecture du medecin dont on a l'id
?>