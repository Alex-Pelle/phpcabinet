<header>
  <nav class="">
    <a class="" href="/index.php">PHPCabinet</a>
    <ul class="">
      <li class="">
        <a class="" href="/index.php?action=usagers">Usagers</span></a>
      </li>
      <li class="">
        <a class="" href="/index.php?action=medecins">Médecins</a>
      </li>
      <li class="">
        <a class="" href="/index.php?action=rdvs">Rendez-vous</a>
      </li>
      <li class="">
        <a class="" href="/index.php?action=statistiques">Statistiques</a>
      </li>
      <li class="">
        <a class="" href="/index.php?action=logout">Déconnexion</a>
      </li>
    </ul>
  </nav>
</header>
<main>
<?php
if(isset($_SESSION['notification_message']) && isset($_SESSION['notification_color'])) {
 echo '<p id="notification" style="background-color:'.$_SESSION['notification_color'].';">'.$_SESSION['notification_message'].'</p>';
}
$_SESSION['notification_message'] = null;
?>