<?php 
require('DaoPersonne.php');
require('../modele/Fonction.php');
require('../modele/Personne.php');
require('../modele/Usager.php');
require('../modele/Medecin.php');
require('../modele/Civilite.php');
$daoPersonne = new DaoPersonne(Connexion::getInstance());

/*
$medecin1 = new Medecin(new Personne("nomMedecin1","prenomMedecin2",Civilite::H),Fonction::M);
$medecin2 = new Medecin(new Personne("nomMedecin2","prenomMedecin2",Civilite::F),Fonction::M);
$daoPersonne->insert($medecin1);
$daoPersonne->insert($medecin2);

$usager1 = new Usager(new Personne("nomUsager1","prenomUsager2",Civilite::H),Fonction::U,$daoPersonne->getById(48),"xxxxxxxxxxx","82000","ville","adresse");
$usager2 = new Usager(new Personne("nomUsager2","prenomUsager2",Civilite::F),Fonction::U,null,"xxxxxxxxxxx","23455","livve","adresse");
$daoPersonne->insert($usager1);
$daoPersonne->insert($usager2);
*/
/*
// Test des get ALL
$array = $daoPersonne->getAll();
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getNom();
    echo "$cle : $s<br>";
}

$array = $daoPersonne->getAllMedecins();
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getNom();
    echo "$cle : $s<br>";
}

$array = $daoPersonne->getAllUsagers();
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getNom();
    echo "$cle : $s<br>";
}
*/
//test update 
/*
$usage3 = $daoPersonne->getById(3);
$usage3->getPersonne()->setPrenom("AAAAAAAAAAAAAAAA");


$daoPersonne->update($usage3);


$array = $daoPersonne->getAll();
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getPrenom();
    echo "$cle : $s<br>";
}
*/

$usage4 = $daoPersonne->getById(48);
$daoPersonne->delete($usage4->getPersonne()->getIdPersonne());
$array = $daoPersonne->getAll();
foreach ($array as $cle => $valeur) {
    $s = $valeur->getPersonne()->getPrenom();
    echo "$cle : $s<br>";
}


?>