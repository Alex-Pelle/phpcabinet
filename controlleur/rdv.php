<?php
if (isset($_POST['id'])) {
  require('../vue/detailRdv.php');
}
else {
  require('../vue/listeRdv.php');
}
    //Lecture du medecin dont on a l'id
?>