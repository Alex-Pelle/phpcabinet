<?php 
require_once(__DIR__.'/Dao.php');
require_once(__DIR__.'/Connexion.php');
require_once(__DIR__.'/DaoPersonne.php');
require_once(__DIR__.'/DaoRDV.php');
require_once(__DIR__.'/../modele/Fonction.php');
require_once(__DIR__.'/../modele/Personne.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Civilite.php');
require_once(__DIR__.'/../modele/Rendez-Vous.php');
require_once(__DIR__.'/../modele/Duree.php');
$daoPersonne = new DaoPersonne(Connexion::getInstance());
$daoRDV = new DaoRDV(Connexion::getInstance());


$usager = $daoPersonne->getById(10);
$medecin = $daoPersonne->getById(2);
$dateheure = new DateTime("2024-01-16 11:00:00");
$rdv1 = new RendezVous($usager,$medecin,$dateheure);

$usager2 = $daoPersonne->getById(9);
$medecin2 = $daoPersonne->getById(1);
$dateheure2 = new DateTime("2024-01-16 10:00:00");
$rdv2 = new RendezVous($usager2,$medecin2,$dateheure2);
//test d'insersion 

$usager3 = $daoPersonne->getById(20);
$medecin3 = $daoPersonne->getById(3);
$dateheure3 = new DateTime("2024-01-17 11:00:00");
$rdv3 = new RendezVous($usager3,$medecin3,$dateheure3);

$usager2 = $daoPersonne->getById(9);
$medecin2 = $daoPersonne->getById(1);
$dateheure4 = new DateTime("2024-01-16 10:40:00");
$rdv4 = new RendezVous($usager2,$medecin2,$dateheure4);
/*
$daoRDV->insert($rdv1);
$daoRDV->insert($rdv2);
$daoRDV->insert($rdv3);
$daoRDV->insert($rdv4);
*/
$rdv2->setDureeEnMinutes(new Duree(50));
$daoRDV->update($rdv2);
//$rdv1->setDureeEnMinutes(new Duree(10));
//$daoRDV->update($rdv3);
/*

//test update
/*
$rdv2->setDureeEnMinutes(new Duree(60));
$d = $rdv2->getDureeEnMinutes()->getNbMinutes();
echo "$d";
$daoRDV->update($rdv2);
*/

//test delete
/*
$daoRDV->delete(array(
    $rdv2->getUsager()->getPersonne()->getIdPersonne(),
    $rdv2->getMedecin()->getPersonne()->getIdPersonne(),
    $rdv2->getDateHeureDebut()->format("Y-m-d"),
    $rdv2->getDateHeureDebut()->format("H:i:s")
));


//test getById

$rdv4 = $daoRDV->getById(array(
    $rdv2->getUsager()->getPersonne()->getIdPersonne(),
    $rdv2->getMedecin()->getPersonne()->getIdPersonne(),
    $rdv2->getDateHeureDebut()->format("Y-m-d"),
    $rdv2->getDateHeureDebut()->format("H:i:s")
));
$x = $rdv2->getDureeEnMinutes()->getNbMinutes();


$array = $daoRDV->getAll();
foreach ($array as $cle => $valeur) {
    $s = $valeur['duree_minute'];
    echo "$cle : $s<br>";
}

$array = $daoRDV->getRendezVousByPersonne(54);
foreach ($array as $cle => $valeur) {
    $s = $valeur->getDureeEnMinutes()->getNbMinutes();
    echo "$cle : $s<br>";
}
*/

?>