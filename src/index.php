<?php
session_start();

require_once(__DIR__.'/controlleur/usagers.php');
require_once(__DIR__.'/controlleur/medecins.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
	if ($_GET['action'] === 'usagers') {
    ControlleurUsager::liste();
	} elseif ($_GET['action'] === 'ajoutUsager'){
    ControlleurUsager::ajout();
  } elseif ($_GET['action'] === 'addUsager'){
    ControlleurUsager::insert($_POST);
  } elseif ($_GET['action'] === 'detailUsager'){
    if(isset($_GET['id']) && ControlleurUsager::isUsager($_GET['id'])) {
      ControlleurUsager::detail($_GET['id']);
    }
    else {
      throw new ErrorException('Aucun ID spécifié');
    }
  } elseif ($_GET['action'] === 'modifUsager'){
    if(isset($_GET['id']) && ControlleurUsager::isUsager($_GET['id'])) {
      ControlleurUsager::modif($_GET['id']);
    }
    else {
      echo "Préciser l'id de l'usager";
    }
  } elseif ($_GET['action'] === 'updateUsager'){
    ControlleurUsager::update($_POST);
  }elseif ($_GET['action'] === 'deleteUsager'){
    if(isset($_GET['id']) && ControlleurUsager::isUsager($_GET['id'])) {
      ControlleurUsager::delete($_GET['id']);
    }
    else {
      echo "Préciser l'id de l'usager";
    }
  } elseif ($_GET['action'] === 'medecins'){
    ControlleurMedecin::liste();
  } elseif ($_GET['action'] === 'ajoutMedecin'){
    ControlleurMedecin::ajout();
  } elseif ($_GET['action'] === 'addMedecin'){
    ControlleurMedecin::insert($_POST);
  } elseif ($_GET['action'] === 'detailMedecin'){
    if(isset($_GET['id']) && ControlleurMedecin::isMedecin($_GET['id'])) {
      ControlleurMedecin::detail($_GET['id']);
    }
    else {
      throw new ErrorException('Aucun ID spécifié');
    }
  } elseif ($_GET['action'] === 'modifMedecin'){
    if(isset($_GET['id']) && ControlleurMedecin::isMedecin($_GET['id'])) {
      ControlleurMedecin::modif($_GET['id']);
    }
    else {
      echo "Préciser l'id de l'Medecin";
    }
  } elseif ($_GET['action'] === 'updateMedecin'){
    ControlleurMedecin::update($_POST);
  }elseif ($_GET['action'] === 'deleteMedecin'){
    if(isset($_GET['id']) && ControlleurMedecin::isMedecin($_GET['id'])) {
      ControlleurMedecin::delete($_GET['id']);
    }
    else {
      echo "Préciser l'id de l'Medecin";
    }
  }else {
    echo "Erreur 404 : la page que vous recherchez n'existe pas.";
	}
} else {
  require(__DIR__.'/vue/accueil.php');
}