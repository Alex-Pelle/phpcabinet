<?php
require_once(__DIR__.'/../dao/Connexion.php');
require_once(__DIR__.'/../dao/DaoPersonne.php');
require_once(__DIR__.'/../dao/DaoRDV.php');
require_once(__DIR__.'/../modele/Rendez-vous.php');
require_once(__DIR__.'/../modele/Duree.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Personne.php');

class ControlleurRDV {
  static function liste() {
    $dao = new DAORDV(Connexion::getInstance());
    $rdvs = $dao->getAll();
    require(__DIR__.'/../vue/listeRdv.php');
  }
  static function ajout() {
    $dao = new DAOPersonne(Connexion::getInstance());
    $medecins = $dao->getAllMedecins();
    $usagers = $dao->getAllUsagers();
    require(__DIR__.'/../vue/ajoutRdv.php');
  }
  static function detail($idUsager, $idMedecin, $dateHeure) {
    $daoPersonne = new DAOPersonne(Connexion::getInstance());
    $daoRdv = new DAORDV(Connexion::getInstance());
    $usager = $daoPersonne->getById($idUsager);
    $nomUsager = $usager->getPersonne()->getNom();
    $prenomUsager = $usager->getPersonne()->getPrenom();
    $civilite = $usager->getPersonne()->getCivilite() == Civilite::H ? 'M.' : 'Mme.';
    $securite = $usager->getNumero_securite();
    $medecin = $daoPersonne->getById($idMedecin);
    $nomMedecin = $medecin->getPersonne()->getNom();
    $prenomMedecin = $medecin->getPersonne()->getPrenom();
    $date = (new DateTime($dateHeure))->format('d/m/Y');
    $heure = (new DateTime($dateHeure))->format('h:i');
    var_dump(substr($dateHeure,0,10));
    var_dump($heure.':00');
    $rdv = $daoRdv->getById(array($idUsager,$idMedecin,substr($dateHeure,0,10),$heure.':00'));
    $duree = $rdv->getDureeEnMinutes();
    require(__DIR__.'/../vue/detailRdv.php');
  }
  static function modif($id) {
    $dao = new DAOPersonne(Connexion::getInstance());
    $usager = $dao->getById($id);
    $nom = $usager->getPersonne()->getNom();
    $prenom = $usager->getPersonne()->getPrenom();
    $isHomme = $usager->getPersonne()->getCivilite() == Civilite::H;
    $securite = $usager->getNumero_securite();
    $date_naissance = $usager->getDate_naissance();
    $lieu_naissance = $usager->getLieu_naissance();
    $adresse = $usager->getAdresse();
    $cp = $usager->getCode_postal();
    $ville = $usager->getVille();
    $medecin = $usager->getMedecinReferant();
    $medecins = $dao->getAllMedecins();
    require(__DIR__.'/../vue/modifUsager.php');
  }

  public static function insert($input) {
    $daoPersonne = new DaoPersonne(Connexion::getInstance());
    $daoRdv = new DaoRDV(Connexion::getInstance());
    try {
      $usager = $daoPersonne->getById($input['usager']);
      $medecin = $daoPersonne->getById($input['medecin']);
      $dateTime = new DateTime($input['date'].' '.$input['heure']);
      if ($dateTime < new DateTime()) {$
        $_SESSION['notification_message'] = 'Choissiez une date valide (future) !';
        header('Location: /index.php?action=ajoutRdv',true);
        return;
      }
      $duree = new Duree(intval($input['duree']));
      $rdv = new RendezVous($usager, $medecin, $dateTime,$duree);
    }
    catch (Exception $e) {
      throw new ErrorException('Bad values');
    }
    $daoRdv->insert($rdv);
    $_SESSION['notification_message'] = 'Rendez-vous prévu avec succès!';
    header('Location: /index.php?action=rdvs',true);
  }
  public static function update($input) {
    $dao = new DaoPersonne(Connexion::getInstance());
    try {
      $usager = new Usager(
        new Personne($input['nom'], $input['prenom'], Civilite::valueOf($input['civilite'])), 
        ($input['medecin_referent'] != '') ? $dao->getById($input['medecin_referent']): null, 
        $input['numero_securite'], 
        $input['code_postal'], 
        $input['ville'], 
        $input['adresse']);
      $usager->getPersonne()->setIdPersonne($input['id']);
    }
    catch (Exception $e) {
      throw new ErrorException('Bad values');
    }
    $dao->update($usager);
    $_SESSION['notification_message'] = 'Usager '.$input['nom'].' modifié avec succès!';
    header('Location: /index.php?action=usagers',true);
  }
  public static function delete($id) {
    $dao = new DaoPersonne(Connexion::getInstance());
    $dao->delete($id);
    $_SESSION['notification_message'] = 'Usager supprimé avec succès!';
    header('Location: /index.php?action=usagers',true);
  }
}