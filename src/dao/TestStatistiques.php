<?php 
require_once(__DIR__.'/Dao.php');
require_once(__DIR__.'/Connexion.php');
require_once(__DIR__.'/DaoPersonne.php');
require_once(__DIR__.'/../modele/Fonction.php');
require_once(__DIR__.'/../modele/Personne.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Civilite.php');
$daoPersonne = new DaoPersonne(Connexion::getInstance());
/*
$hbf25 = $daoPersonne->getHommeBefore25();
$hbt25nd50 = $daoPersonne->getHommeBetween25And50();
$haft50 = $daoPersonne->getHommeAfter50();

$fbf25 = $daoPersonne->getFemmeBefore25();
$fbt25nd50 = $daoPersonne->getFemmeBetween25And50();
$faft50 = $daoPersonne->getFemmeAfter50();

echo "$hbf25<br>";
echo "$hbt25nd50<br>";
echo "$haft50<br>";

echo "$fbf25<br>";
echo "$fbt25nd50<br>";
echo "$faft50<br>";
*/

$array = $daoPersonne->getStatistiquesMedecins();
foreach ($array as $cle => $valeur) {
    $nom = $valeur['nomPersonne'];
    $prenom = $valeur['prenomPersonne'];
    $duree = $valeur['totalDureeRendezVous'];
    echo "$nom "."$prenom : "."$duree H <br>";
}
?>