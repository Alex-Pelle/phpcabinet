<?php
require_once(__DIR__.'/../dao/Connexion.php');
require_once(__DIR__.'/../dao/DaoPersonne.php');
require_once(__DIR__.'/../dao/DaoRDV.php');
require_once(__DIR__.'/../modele/Rendez-vous.php');
require_once(__DIR__.'/../modele/Duree.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Personne.php');

class ControlleurStatistiques {
  static function generate() {
    $dao = new DaoPersonne(Connexion::getInstance());
    $mf = $dao->getFemmeBefore25();
    $ef = $dao->getFemmeBetween25And50();
    $pf = $dao->getFemmeAfter50();
    $mh = $dao->getHommeBefore25();
    $eh = $dao->getHommeBetween25And50();
    $ph = $dao->getHommeAfter50();
    require(__DIR__.'/../vue/statistiques.php');
  }
}