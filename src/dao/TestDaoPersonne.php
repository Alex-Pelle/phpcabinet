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

$medecin1 = new Medecin(new Personne("nomMedecin1","prenomMedecin2",Civilite::H));
$medecin2 = new Medecin(new Personne("nomMedecin2","prenomMedecin2",Civilite::F));
$daoPersonne->insert($medecin1);
$daoPersonne->insert($medecin2);

$usager1 = new Usager(new Personne("nomUsager1","prenomUsager2",Civilite::H),$daoPersonne->getById(110),"xxxxxxxxxxx","82000","ville","adresse",new DateTime("2021-10-10"),"lieux");
$usager2 = new Usager(new Personne("nomUsager2","prenomUsager2",Civilite::F),null,"xxxxxxxxxxx","23455","livve","adresse",new DateTime("2021-10-10"),"lieux");
$daoPersonne->insert($usager1);
$daoPersonne->insert($usager2);

// Test des get ALL
echo 'get personnes<br>';
$array = $daoPersonne->getAll();
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getNom();
    echo "$cle : $s<br>";
}

$array = $daoPersonne->getAllMedecins();
echo 'get medecins<br>';
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getNom();
    echo "$cle : $s<br>";
}

$array = $daoPersonne->getAllUsagers();
echo 'get usagers<br>';
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getNom();
    echo "$cle : $s<br>";
}

//test update 

$usage3 = $daoPersonne->getById(109);
$m = $usage3->getMedecinReferant();
if (isset($m)){
  echo'dump';
  var_dump($usage3->getMedecinReferant());
}
$usage3->setMedecinReferant($daoPersonne->getById(110));

$daoPersonne->update($usage3);
$array = $daoPersonne->getAll();
echo 'update<br>';
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getPrenom();
    echo "$cle : $s<br>";
}


/*
$usage4 = $daoPersonne->getById(111);
$usage4->getPersonne()->setIdPersonne(113);
echo 'delete<br>';
$daoPersonne->delete($usage4->getPersonne()->getIdPersonne());
$array = $daoPersonne->getAll();
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getPrenom();
    echo "$cle : $s<br>";
}
*/

$daoPersonne->delete(141);
?>