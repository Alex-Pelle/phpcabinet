<?php
require_once(__DIR__.'/../dao/Connexion.php');
require_once(__DIR__.'/../dao/DaoPersonne.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Personne.php');
require_once(__DIR__.'/usagers.php');

class ControlleurUsager {
  static function isUsager($id) {
    $dao = new DAOPersonne(Connexion::getInstance());
    $usager = $dao->getById($id);
    return $usager instanceof Usager;
  }
  static function liste() {
    $dao = new DAOPersonne(Connexion::getInstance());
    $usagers = $dao->getAllUsagers();
    require(__DIR__.'/../vue/listeUsagers.php');
  }
  static function ajout() {
    $dao = new DAOPersonne(Connexion::getInstance());
    $medecins = $dao->getAllMedecins();
    require(__DIR__.'/../vue/ajoutUsager.php');
  }
  static function modif($id) {
    $dao = new DAOPersonne(Connexion::getInstance());
    $usager = $dao->getById($id);
    $nom = $usager->getPersonne()->getNom();
    $prenom = $usager->getPersonne()->getPrenom();
    $isHomme = $usager->getPersonne()->getCivilite() == Civilite::H;
    $securite = $usager->getNumero_securite();
    $adresse = $usager->getAdresse();
    $cp = $usager->getCode_postal();
    $ville = $usager->getVille();
    $medecin = $usager->getMedecinReferant();
    $medecins = $dao->getAllMedecins();
    require(__DIR__.'/../vue/modifUsager.php');
  }

  public static function insert($input) {
    $dao = new DaoPersonne(COnnexion::getInstance());
    try {
      $usager = new Usager(
        new Personne($input['nom'], $input['prenom'], Civilite::valueOf($input['civilite'])), 
        ($input['medecin_referent'] != '') ? $dao->getById($input['medecin_referent']): null, 
        $input['numero_securite'], 
        $input['code_postal'], 
        $input['ville'], 
        $input['adresse']);
    }
    catch (Exception $e) {
      throw new ErrorException('Bad values');
    }
    $dao->insert($usager);
    header('Location: /index.php?action=usagers',true);
  }
}