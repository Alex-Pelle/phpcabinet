<?php
if (isset($_POST['id'])) {
  require('../vue/detailMedecin.php');
}
else {
  require('../vue/listeMedecin.php');
}
    //Lecture du medecin dont on a l'id
?>