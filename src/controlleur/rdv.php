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
    $daoPersonne = new DaoPersonne(COnnexion::getInstance());
    if ((empty($_POST['usager']) && empty($_POST['medecin'])) || $_POST['submit'] =='Réinitialiser') {
      $rdvs = $dao->getAll();
    }
    elseif (!empty($_POST['usager']) && empty($_POST['medecin'])) {
      $usager = $daoPersonne->getById($_POST['usager']);
      $rdvs = $dao->getRendezVousByPersonne($_POST['usager']);
    }
    elseif (empty($_POST['usager']) && !empty($_POST['medecin'])) {
      $medecin = $daoPersonne->getById($_POST['medecin']);
      $rdvs = $dao->getRendezVousByPersonne($_POST['medecin']);
    }
    elseif (!empty($_POST['usager']) && !empty($_POST['medecin'])) {
      $usager = $daoPersonne->getById($_POST['usager']);
      $medecin = $daoPersonne->getById($_POST['medecin']);
      $rdvs = $dao->getRDVByUsagerAndMedecin($_POST['usager'],$_POST['medecin']);
    }
    $medecins = $daoPersonne->getAllMedecins();
    $usagers = $daoPersonne->getAllUsagers();
    require(__DIR__.'/../vue/rdv/listeRdv.php');
  }
  static function ajout() {
    $dao = new DAOPersonne(Connexion::getInstance());
    $medecins = $dao->getAllMedecins();
    $usagers = $dao->getAllUsagers();
    require(__DIR__.'/../vue/rdv/ajoutRdv.php');
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
    $heure = (new DateTime($dateHeure))->format('H:i');
    $rdv = $daoRdv->getById(array($idUsager,$idMedecin,substr($dateHeure,0,10),$heure.':00'));
    $duree = $rdv->getDureeEnMinutes()->getNbMinutes();
    require(__DIR__.'/../vue/rdv/detailRdv.php');
  }
  static function modif($idUsager, $idMedecin, $dateHeure) {
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
    $dateFormatee = (new DateTime($dateHeure))->format('Y-m-d');
    $heure = (new DateTime($dateHeure))->format('H:i');
    $rdv = $daoRdv->getById(array($idUsager,$idMedecin,substr($dateHeure,0,10),$heure.':00'));
    $duree = $rdv->getDureeEnMinutes()->getNbMinutes();
    require(__DIR__.'/../vue/rdv/modifRdv.php');
  }

  public static function insert($input) {
    $daoPersonne = new DaoPersonne(Connexion::getInstance());
    $daoRdv = new DaoRDV(Connexion::getInstance());
    try {
      $usager = $daoPersonne->getById($input['usager']);
      $medecin = $daoPersonne->getById($input['medecin']);
      $dateTime = new DateTime($input['date'].' '.$input['heure']);
      if ($dateTime < new DateTime()) {
        $_SESSION['notification_message'] = 'Choissiez une date valide (future) !';
        $_SESSION['notification_color'] = 'red';
        header('Location: /index.php?action=ajoutRdv',true);
        return;
      }
      $duree = new Duree(intval($input['duree']));
      $rdv = new RendezVous($usager, $medecin, $dateTime,$duree);
    }
    catch (Exception $e) {
      $_SESSION['notification_message'] = $e->getMessage();
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=ajoutRdv',true);
      return;
    }
    try {
      $daoRdv->insert($rdv);
    }
    catch (Exception $e) {
      $_SESSION['notification_message'] = substr($e->getMessage(),40);
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=ajoutRdv',true);
      return;
    }
    $_SESSION['notification_message'] = 'Rendez-vous prévu avec succès!';
    $_SESSION['notification_color'] = 'green';
    header('Location: /index.php?action=rdvs',true);
  }
  public static function update($input) {
    $daoPersonne = new DaoPersonne(Connexion::getInstance());
    $daoRdv = new DaoRDV(Connexion::getInstance());
    try {
      $usager = $daoPersonne->getById($input['idUsager']);
      $medecin = $daoPersonne->getById($input['idMedecin']);
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
      $_SESSION['notification_message'] = $e->getMessage();
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=ajoutRdv',true);
      return;
    }
    try {
      $daoRdv->update($rdv);
    } catch(Exception $e) {
      $_SESSION['notification_message'] = substr($e->getMessage(),40);
      $_SESSION['notification_color'] = 'red';
      header('Location: /index.php?action=ajoutRdv',true);
    }
    $_SESSION['notification_message'] = 'Rendez-vous modifié avec succès!';
    $_SESSION['notification_color'] = 'green';
    header('Location: /index.php?action=detailRdv&idMedecin='.$input['idMedecin'].'&idUsager='.$input['idUsager'].'&dateHeure='.$dateTime->format('Y-m-d H:i'),true);
  }
  static function delete($idUsager, $idMedecin, $dateHeure) {
    $dao = new DaoRDV(Connexion::getInstance());
    $dao->delete(array($idUsager,$idMedecin,substr($dateHeure,0,10),substr($dateHeure,10).':00'));
    $_SESSION['notification_message'] = 'Rdv supprimé avec succès!';
    header('Location: /index.php?action=rdvs',true);
  }
}