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
    $daoPersonne = new DaoPersonne(Connexion::getInstance());
    $mf = $daoPersonne->getFemmeBefore25();
    $ef = $daoPersonne->getFemmeBetween25And50();
    $pf = $daoPersonne->getFemmeAfter50();
    $mh = $daoPersonne->getHommeBefore25();
    $eh = $daoPersonne->getHommeBetween25And50();
    $ph = $daoPersonne->getHommeAfter50();

    $stats = $daoPersonne->getStatistiquesMedecins();
    $liste = array();
    foreach($stats as $medecin) {

    }
    require(__DIR__.'/../vue/statistiques.php');
  }
}