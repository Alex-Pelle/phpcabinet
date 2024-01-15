<?php
require_once(__DIR__.'/../dao/Connexion.php');
require_once(__DIR__.'/../dao/DaoPersonne.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Personne.php');
require_once(__DIR__.'/usagers.php');

class ControlleurUsager {
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
}