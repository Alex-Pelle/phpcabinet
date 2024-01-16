<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index.php">PHPCabinet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/index.php?action=usagers">Usagers</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/index.php?action=medecins">Médecins</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/index.php?action=rdvs">Rendez-vous</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php
if(isset($_SESSION['notification_message'])) {
 echo '<p class="notification">'.$_SESSION['notification_message'].'</p>';
}
$_SESSION['notification_message'] = null;
?>