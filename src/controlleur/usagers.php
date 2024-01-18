<?php
require_once(__DIR__.'/../dao/Connexion.php');
require_once(__DIR__.'/../dao/DaoPersonne.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Personne.php');

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
  static function detail($id) {
    $dao = new DAOPersonne(Connexion::getInstance());
    $usager = $dao->getById($id);
    $nom = $usager->getPersonne()->getNom();
    $prenom = $usager->getPersonne()->getPrenom();
    $civilite = $usager->getPersonne()->getCivilite() == Civilite::H ? 'Homme' : 'Femme';
    $securite = $usager->getNumero_securite();
    $date_naissance = $usager->getDateNaissance()->format('d/m/Y');
    $lieu_naissance = $usager->getLieuDeNaissance();
    $adresse = $usager->getAdresse();
    $cp = $usager->getCode_postal();
    $ville = $usager->getVille();
    $medecin = $usager->getMedecinReferant();
    $medecins = $dao->getAllMedecins();
    require(__DIR__.'/../vue/detailUsager.php');
  }
  static function modif($id) {
    $dao = new DAOPersonne(Connexion::getInstance());
    $usager = $dao->getById($id);
    $nom = $usager->getPersonne()->getNom();
    $prenom = $usager->getPersonne()->getPrenom();
    $isHomme = $usager->getPersonne()->getCivilite() == Civilite::H;
    $securite = $usager->getNumero_securite();
    $date_naissance = $usager->getDateNaissance()->format('Y-m-d');
    $lieu_naissance = $usager->getLieuDeNaissance();
    $adresse = $usager->getAdresse();
    $cp = $usager->getCode_postal();
    $ville = $usager->getVille();
    $medecin = $usager->getMedecinReferant();
    $medecins = $dao->getAllMedecins();
    require(__DIR__.'/../vue/modifUsager.php');
  }

  public static function insert($input) {
    $dao = new DaoPersonne(Connexion::getInstance());
    if (!isset($input['nom']) || !isset($input['prenom']) || !isset($input['civilite']) || !isset($input['numero_securite']) || !isset($input['code_postal']) || !isset($input['ville']) || !isset($input['adresse']) || !isset($input['date_naissance']) || !isset($input['lieu_naissance']) ) {
      $_SESSION['notification_message'] = 'Vous devez remplir les champs obligatoires';
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=ajoutUsager',true);
    }
    if (new DateTime($input['date_naissance']) < new DateTime()) {
      $_SESSION['notification_message'] = 'La date de naissance doit être valide (passée) !';
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=ajoutUsager',true);
    } 
    try {
      $usager = new Usager(
        new Personne($input['nom'], $input['prenom'], Civilite::valueOf($input['civilite'])), 
        ($input['medecin_referent'] != '') ? $dao->getById($input['medecin_referent']): null, 
        $input['numero_securite'], 
        $input['code_postal'], 
        $input['ville'], 
        $input['adresse'],
        new DateTime($input['date_naissance']),
        $input['lieu_naissance']);
    }
    catch (Exception $e) {
      $_SESSION['notification_message'] = $e->getMessage();
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=ajoutRdv',true);
      return;
    }
    $dao->insert($usager);
    $_SESSION['notification_message'] = 'Usager '.$input['prenom'].' '.$input['nom'].' créé avec succès!';
    $_SESSION['notification_color'] = 'green';
    header('Location: /index.php?action=usagers',true);
  }
  public static function update($input) {
    $dao = new DaoPersonne(Connexion::getInstance());
    if (empty($input['nom']) || empty($input['prenom']) || empty($input['civilite']) || empty($input['numero_securite']) || empty($input['code_postal']) || empty($input['ville']) || empty($input['adresse']) || empty($input['date_naissance']) || empty($input['lieu_naissance']) ) {
      $_SESSION['notification_message'] = 'Vous devez remplir les champs obligatoires';
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=modifUsager&id='.$input['id'],true);
    }
    try {
      $usager = new Usager(
        new Personne($input['nom'], $input['prenom'], Civilite::valueOf($input['civilite'])), 
        ($input['medecin_referent'] != '') ? $dao->getById($input['medecin_referent']): null, 
        $input['numero_securite'], 
        $input['code_postal'], 
        $input['ville'], 
        $input['adresse'],
        new DateTime($input['date_naissance']),
        $input['lieu_naissance']);
      $usager->getPersonne()->setIdPersonne($input['id']);
    }
    catch (Exception $e) {
      $_SESSION['notification_message'] = $e->getMessage();
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=ajoutRdv',true);
      return;
    }
    $dao->update($usager);
    $_SESSION['notification_message'] = 'Usager '.$input['prenom'].' '.$input['nom'].' modifié avec succès!';
    $_SESSION['notification_color'] = 'green';
    header('Location: /index.php?action=usagers',true);
  }
  public static function delete($id) {
    $dao = new DaoPersonne(Connexion::getInstance());
    $dao->delete(intval($id));
    $_SESSION['notification_message'] = 'Usager supprimé avec succès!';
    header('Location: /index.php?action=usagers',true);
  }
}