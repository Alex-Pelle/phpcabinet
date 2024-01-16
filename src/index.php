<?php

require_once(__DIR__.'/controlleur/usagers.php');
require_once(__DIR__.'/controlleur/medecins.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
	if ($_GET['action'] === 'usagers') {
    ControlleurUsager::liste();
	} elseif ($_GET['action'] === 'ajoutUsager'){
    ControlleurUsager::ajout();
  } elseif ($_GET['action'] === 'addUsager'){
    ControlleurUsager::insert($_POST);
  } elseif ($_GET['action'] === 'modifUsager'){
    if(isset($_GET['id']) && ControlleurUsager::isUsager($_GET['id'])) {
      ControlleurUsager::modif($_GET['id']);
    }
    else {
      echo "Préciser l'id de l'usager";
    }
  } elseif ($_GET['action'] === 'medecins'){
    ControlleurMedecin::liste();
  } else {
    echo "Erreur 404 : la page que vous recherchez n'existe pas.";
	}
} else {
  require(__DIR__.'/vue/accueil.php');
}