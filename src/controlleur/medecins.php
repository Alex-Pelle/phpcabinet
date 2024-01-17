<?php
require_once(__DIR__.'/../dao/Connexion.php');
require_once(__DIR__.'/../dao/DaoPersonne.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Personne.php');

class ControlleurMedecin {static function isMedecin($id) {
  $dao = new DAOPersonne(Connexion::getInstance());
  $medecin = $dao->getById($id);
  return $medecin instanceof Medecin;
}
static function liste() {
  $dao = new DAOPersonne(Connexion::getInstance());
  $medecins = $dao->getAllMedecins();
  require(__DIR__.'/../vue/listeMedecins.php');
}
static function ajout() {
  $dao = new DAOPersonne(Connexion::getInstance());
  $medecins = $dao->getAllMedecins();
  require(__DIR__.'/../vue/ajoutMedecin.php');
}
static function detail($id) {
  $dao = new DAOPersonne(Connexion::getInstance());
  $medecin = $dao->getById($id);
  $nom = $medecin->getPersonne()->getNom();
  $prenom = $medecin->getPersonne()->getPrenom();
  $civilite = $medecin->getPersonne()->getCivilite() == Civilite::H ? 'Homme' : 'Femme';
  require(__DIR__.'/../vue/detailMedecin.php');
}
static function modif($id) {
  $dao = new DAOPersonne(Connexion::getInstance());
  $medecin = $dao->getById($id);
  $nom = $medecin->getPersonne()->getNom();
  $prenom = $medecin->getPersonne()->getPrenom();
  $isHomme = $medecin->getPersonne()->getCivilite() == Civilite::H;
  require(__DIR__.'/../vue/modifMedecin.php');
}

public static function insert($input) {
  $dao = new DaoPersonne(Connexion::getInstance());
  try {
    $medecin = new Medecin(
      new Personne($input['nom'], $input['prenom'], Civilite::valueOf($input['civilite'])));
  }
  catch (Exception $e) {
    $_SESSION['notification_message'] = $e->getMessage();
    $_SESSION['notification_color'] = 'red';
    header('Location: /index.php?action=ajoutRdv',true);
    return;
  }
  $dao->insert($medecin);
  $_SESSION['notification_message'] = 'Médecin '.$input['nom'].' créé avec succès!';
  header('Location: /index.php?action=medecins',true);
}
public static function update($input) {
  $dao = new DaoPersonne(Connexion::getInstance());
  try {
    $medecin = new Medecin(
      new Personne($input['nom'], $input['prenom'], Civilite::valueOf($input['civilite'])));

  }
  catch (Exception $e) {
    $_SESSION['notification_message'] = $e->getMessage();
    $_SESSION['notification_color'] = 'red';
    header('Location: /index.php?action=ajoutRdv',true);
    return;
  }
  $dao->update($medecin);
  $_SESSION['notification_message'] = 'Médecin '.$input['nom'].' modifié avec succès!';
  header('Location: /index.php?action=medecins',true);
}
public static function delete($id) {
  $dao = new DaoPersonne(Connexion::getInstance());
  $dao->delete($id);
  $_SESSION['notification_message'] = 'Médecin supprimé avec succès!';
  header('Location: /index.php?action=medecins',true);
}
}