<?php
session_start();
$_SESSION['logged'] = isset($_SESSION['logged']) && $_SESSION['logged'];
require_once(__DIR__.'/controlleur/usagers.php');
require_once(__DIR__.'/controlleur/medecins.php');
require_once(__DIR__.'/controlleur/rdv.php');
require_once(__DIR__.'/controlleur/statistiques.php');
require_once(__DIR__.'/controlleur/login.php');

if (isset($_GET['action']) && $_GET['action'] === 'login') {
  ControlleurLogin::login($_POST);
}
elseif (!$_SESSION['logged']) {
  ControlleurLogin::afficher();
}
elseif (isset($_GET['action']) && $_GET['action'] !== '') {
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
    if(isset($_GET['id'])) {
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
      echo "Préciser l'id du Medecin";
    }
  }elseif ($_GET['action'] === 'rdvs'){
    ControlleurRdv::liste();
  } elseif ($_GET['action'] === 'ajoutRdv'){
    ControlleurRdv::ajout();
  } elseif ($_GET['action'] === 'addRdv'){
    ControlleurRdv::insert($_POST);
  } elseif ($_GET['action'] === 'detailRdv'){
    if(isset($_GET['idUsager']) && isset($_GET['idMedecin']) && isset($_GET['dateHeure'])) {
      ControlleurRdv::detail($_GET['idUsager'],$_GET['idMedecin'],$_GET['dateHeure']);
    }
    else {
      throw new ErrorException('Aucun ID spécifié');
    }
  } elseif ($_GET['action'] === 'modifRdv'){
    if(isset($_GET['idUsager']) && isset($_GET['idMedecin']) && isset($_GET['dateHeure'])) {
      ControlleurRdv::modif($_GET['idUsager'],$_GET['idMedecin'],$_GET['dateHeure']);
    }
    else {
      echo "Préciser l'id de l'Rdv";
    }
  } elseif ($_GET['action'] === 'updateRdv'){
    ControlleurRdv::update($_POST);
  }elseif ($_GET['action'] === 'deleteRdv'){
    if(isset($_GET['idUsager']) && isset($_GET['idMedecin']) && isset($_GET['dateHeure'])) {
      ControlleurRdv::delete($_GET['idUsager'],$_GET['idMedecin'],$_GET['dateHeure']);
    }
    else {
      echo "Préciser l'id de l'Rdv";
    }
  } elseif ($_GET['action'] === 'statistiques') {
    ControlleurStatistiques::generate();
  } else {
    header('Location: https://www.youtube.com/watch?v=KSOJtKzWLYY');
	}
} else {
  require(__DIR__.'/vue/accueil.php');
}