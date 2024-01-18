<?php
require_once(__DIR__.'/Dao.php');
require_once(__DIR__.'/Connexion.php');
require_once(__DIR__.'/../modele/Fonction.php');
require_once(__DIR__.'/../modele/Personne.php');
require_once(__DIR__.'/../modele/Usager.php');
require_once(__DIR__.'/../modele/Medecin.php');
require_once(__DIR__.'/../modele/Civilite.php');



class DaoPersonne implements Dao {

    private Connexion $connexion;

    public function __construct(Connexion $c) {
        $this->connexion=$c;
    }
    

function getAll() {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query('SELECT * FROM Personne');
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    $retour = array();
    foreach ($tableauSortie as $cle => $sortie) {
        $personne = null;
        if ($sortie['fonction']==Fonction::M->name) {
            $personne = new Medecin(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])));
            $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
        } elseif ($sortie['fonction']==Fonction::U->name) {
            $idMedecin=null;
            if ($sortie['idMedecin']!=null) {
                $idMedecin = $this->getById($sortie['idMedecin']);  
            } 
            $personne = new Usager(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),$idMedecin,$sortie['numero_securite'],$sortie['code_postal'],$sortie['ville'],$sortie['Adresse'],new DateTime($sortie['date_naissance']),$sortie['lieu_de_naissance']);
            $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
        }
        array_push($retour,$personne);
    }
    return $retour;
}

function getAllUsagers() {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query('SELECT * FROM Personne WHERE fonction != "M"');
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    $retour = array();
    foreach ($tableauSortie as $cle => $sortie) {
        $personne = null;
        $idMedecin=null;
        if ($sortie['idMedecin']!=null) {
          $idMedecin = $this->getById($sortie['idMedecin']);  
        } 
        $personne = new Usager(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),$idMedecin,$sortie['numero_securite'],$sortie['code_postal'],$sortie['ville'],$sortie['Adresse'],new DateTime($sortie['date_naissance']),$sortie['lieu_de_naissance']);
        $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
        array_push($retour,$personne);
    }
    return $retour;
}

function getAllMedecins() {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query('SELECT * FROM Personne WHERE fonction != "U"');
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    $retour = array();
    foreach ($tableauSortie as $cle => $sortie) {
        $personne = new Medecin(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])));
        $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
        array_push($retour,$personne);
    }
    return $retour;
}

function getById($cle) {
    $pdo = $this->connexion->getPDO();
    $getById = $pdo->query("SELECT * FROM Personne WHERE idPersonne = $cle");
    $sortie = $getById->fetch(PDO::FETCH_ASSOC);
    $personne = null;
    if ($sortie != false) {
      if ($sortie['fonction']==Fonction::M->name) {
          $personne = new Medecin(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])));
          $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
      }
      if ($sortie['fonction']==Fonction::U->name) {
          $idMedecin=null;
          if ($sortie['idMedecin']!=null) {
            $idMedecin = $this->getById($sortie['idMedecin']);  
          } 
          $personne = new Usager(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),$idMedecin,$sortie['numero_securite'],$sortie['code_postal'],$sortie['ville'],$sortie['Adresse'],new DateTime($sortie['date_naissance']),$sortie['lieu_de_naissance']);
          $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
      }
    }
    return $personne;
}


function insert($item) {
    $pdo = $this->connexion->getPDO();
    $insert = $pdo->prepare('INSERT INTO 
        Personne(fonction,nomPersonne,prenomPersonne,civilite,Adresse,code_postal,ville,numero_securite,idMedecin,date_naissance,lieu_de_naissance) 
            VALUES
            (:fonction,:nomPersonne,:prenomPersonne,:civilite,:Adresse,:code_postal,:ville,:numero_securite,:idMedecin,:date_naissance,:lieu_de_naissance)'
    );

    if($item instanceof Medecin) {
        $insert->execute(array(
            'fonction' => Fonction::M->name,
            'nomPersonne' => $item->getPersonne()->getNom(),
            'prenomPersonne' => $item->getPersonne()->getPrenom(),
            'civilite' => $item->getPersonne()->getCivilite()->name,
            'Adresse' => NULL,
            'code_postal' => NULL,
            'ville' => NULL,
            'numero_securite' => NULL,
            'idMedecin' => NULL,
            'date_naissance' => NULL,
            'lieu_de_naissance' => NULL
        ));
    }

    if($item instanceof Usager) {
        $idMedecin=null;
        if ($item->getMedecinReferant()!=null) {
          $idMedecin = $item->getMedecinReferant()->getPersonne()->getIdPersonne();  
        } 
        $insert->execute(array(
            'fonction' => Fonction::U->name,
            'nomPersonne' => $item->getPersonne()->getNom(),
            'prenomPersonne' => $item->getPersonne()->getPrenom(),
            'civilite' => $item->getPersonne()->getCivilite()->name,
            'Adresse' => $item->getAdresse(),
            'code_postal' => $item->getCode_postal(),
            'ville' => $item->getVille(),
            'numero_securite' => $item->getNumero_securite(),
            'idMedecin' => $idMedecin,
            'date_naissance' => $item->getDateNaissance()->format("Y-m-d"),
            'lieu_de_naissance' => $item->getLieuDeNaissance()
        ));

    }
}

function update($item) {
    $pdo = $this->connexion->getPDO();
    $update = $pdo->prepare('UPDATE Personne SET
        nomPersonne = :nomPersonne ,
        prenomPersonne = :prenomPersonne ,
        civilite = :civilite ,
        Adresse = :adresse ,
        code_postal = :code_postal ,
        ville = :ville ,
        numero_securite = :numero_securite,
        idMedecin = :idMedecin,
        date_naissance = :date_naissance,
        lieu_de_naissance = :lieu_de_naissance
        WHERE idPersonne = :idPersonne '
    );
    if($item instanceof Medecin) {
        $update->execute(array(
            'idPersonne' => $item->getPersonne()->getIdPersonne(),
            'nomPersonne' => $item->getPersonne()->getNom(),
            'prenomPersonne' => $item->getPersonne()->getPrenom(),
            'civilite' => $item->getPersonne()->getCivilite()->name,
            'adresse' => null,
            'code_postal' => null,
            'ville' => null,
            'numero_securite' => null,
            'idMedecin' => null,
            'date_naissance' => null,
            'lieu_de_naissance' => null
        ));
    }
    if($item instanceof Usager) {
        $idMedecin=$item->getMedecinReferant();
        if (isset($idMedecin)) {
            $idMedecin = $item->getMedecinReferant()->getPersonne()->getIdPersonne();
        }
        $update->execute(array(
            'idPersonne' => $item->getPersonne()->getIdPersonne(),
            'nomPersonne' => $item->getPersonne()->getNom(),
            'prenomPersonne' => $item->getPersonne()->getPrenom(),
            'civilite' => $item->getPersonne()->getCivilite()->name,
            'adresse' => $item->getAdresse(),
            'code_postal' => $item->getCode_postal(),
            'ville' => $item->getVille(),
            'numero_securite' => $item->getNumero_securite(),
            'idMedecin' => $idMedecin,
            'date_naissance' => $item->getDateNaissance()->format("Y-m-d"),
            'lieu_de_naissance' => $item->getLieuDeNaissance()
        ));
    }
}
function delete($item) {
    $this->delMedecinReference($item);
    $this->delRDVByPersonne($item);
    $this->deletePersonne($item);
}

function getAllUsagerByMedecin($cle) {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT * FROM Personne WHERE idMedecin = $cle");
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    $retour = array();
    foreach ($tableauSortie as $cle => $sortie) {
        $personne = new Usager(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),$this->getById($sortie['idMedecin']),$sortie['numero_securite'],$sortie['code_postal'],$sortie['ville'],$sortie['Adresse'],new DateTime($sortie['date_naissance']),$sortie['lieu_de_naissance']);
        $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
        array_push($retour,$personne);
    }
    return $retour;
}

function getHommeBefore25() {
    return $this->getIndividuBefore25(Civilite::H);
}
function getHommeBetween25And50() {
    return $this->getIndividuBetween25And50(Civilite::H);
}
function getHommeAfter50() {
    return $this->getIndividuAfter50(Civilite::H);
}

function getFemmeBefore25() {
    return $this->getIndividuBefore25(Civilite::F);
}
function getFemmeBetween25And50() {
    return $this->getIndividuBetween25And50(Civilite::F);
}
function getFemmeAfter50() {
    return $this->getIndividuAfter50(Civilite::F);
}
function getStatistiquesMedecins() {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT
    P.nomPersonne AS NomMedecin,
    P.prenomPersonne AS PrenomMedecin,
    (
      SELECT SUM(R2.duree_minute)
      FROM rendez_vous R2
      WHERE R2.idMedecin = P.idPersonne
        AND R2.date_rendez_vous < CURDATE()
        AND (R2.date_rendez_vous < CURDATE() OR (R2.date_rendez_vous = CURDATE() AND R2.heure_rendez_vous < CURTIME()))
    ) AS SommeDuree
  FROM Personne P
  WHERE fonction='M'
  ORDER BY SommeDuree DESC");
$tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
return $tableauSortie;
}

private function getIndividuBefore25(Civilite $civilite) {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT COUNT(*) AS Total FROM Personne WHERE date_naissance > DATE_SUB(NOW(), INTERVAL 25 YEAR) AND civilite = '$civilite->name'");
    return $this->generateTableauSortie($getAll);
}

private function getIndividuBetween25And50(Civilite $civilite) {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT COUNT(*) AS Total FROM Personne WHERE date_naissance BETWEEN DATE_SUB(NOW(), INTERVAL 50 YEAR) AND DATE_SUB(NOW(), INTERVAL 25 YEAR) AND civilite = '$civilite->name'");
    return $this->generateTableauSortie($getAll);
}

private function getIndividuAfter50(Civilite $civilite) {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT COUNT(*) AS Total FROM Personne WHERE date_naissance < DATE_SUB(NOW(), INTERVAL 50 YEAR) AND civilite = '$civilite->name'");
    return $this->generateTableauSortie($getAll);
}

private function generateTableauSortie($getAll) {
    $tableauSortie = $getAll->fetch(PDO::FETCH_ASSOC);
    return $tableauSortie['Total'];
}

private function deletePersonne($cle) {
    $pdo = $this->connexion->getPDO();
    $delete = $pdo->prepare('DELETE FROM Personne WHERE idPersonne = :idPersonne');
    $delete->bindParam(':idPersonne',$cle,PDO::PARAM_INT);
    $delete->execute(array(
        'idPersonne' => $cle
    ));
}

private function delMedecinReference($item) {
    $personne = $this->getById($item);
    if($personne instanceof Medecin) {
        $array = $this->getAllUsagerByMedecin($personne->getPersonne()->getIdPersonne());
        foreach ($array as $cle => $valeur) {
            $valeur->setMedecinReferant(null);
            $this->update($valeur);
        }
    }
}

private function delRDVByPersonne($item) {
    $daoRDV = new DaoRDV($this->connexion);
    $array = $daoRDV->getRendezVousByPersonne($item);
    foreach ($array as $cle => $valeur) {
        $daoRDV->delete(array(
            $valeur->getUsager()->getPersonne()->getIdPersonne(),
            $valeur->getMedecin()->getPersonne()->getIdPersonne(),
            $valeur->getDateHeureDebut()->format("Y-m-d"),
            $valeur->getDateHeureDebut()->format("H:i:s")
        ));
    }
}
}

?>