<?php $titre = 'Authentification';
$css = 'connexion';
require_once(__DIR__.'/common/head.php'); ?>
<body>
<?php
if(isset($_SESSION['notification_message']) && isset($_SESSION['notification_color'])) {
 echo '<p id="notification" style="position:fixed; width:100vw; background-color:'.$_SESSION['notification_color'].';">'.$_SESSION['notification_message'].'</p>';
}
$_SESSION['notification_message'] = null;
?>
  <main>
    <form action="index.php?action=login" method="post">
      <h1>Authentification</h1>
      <label for="login">Identifiant : <input type="text" name="login" id="login"></label>
      <label for="pwd">Mot de passe : <input type="password" name="pwd" id="pwd"></label>
      <input class="btn btn-outline-primary" type="submit" value="S'authentifier">
    </form>
</main>
</body>
</html>