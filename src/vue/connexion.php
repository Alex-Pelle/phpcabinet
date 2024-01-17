<?php $titre = 'Authentification';
require_once(__DIR__.'/head.php'); ?>
<body>
<?php
if(isset($_SESSION['notification_message'])) {
 echo '<p class="notification">'.$_SESSION['notification_message'].'</p>';
}
$_SESSION['notification_message'] = null;
?>
  <div id="main">
    <form action="index.php?action=login" method="post">
      <label for="login">Identifiant : <input type="text" name="login" id="login"></label>
      <label for="pwd">Mot de passe : <input type="password" name="pwd" id="pwd"></label>
      <input type="submit" value="S'authentifier">
    </form>
  </div>
</body>
</html>