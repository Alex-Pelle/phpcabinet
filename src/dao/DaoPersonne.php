<?php
require_once(__DIR__.'/Dao.php');
require_once(__DIR__.'/Connexion.php');
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
            $personne = new Medecin(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),Fonction::M);
            $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
        } elseif ($sortie['fonction']==Fonction::U->name) {
            $idMedecin=null;
            if ($sortie['idMedecin']!=null) {
                $idMedecin = $this->getById($sortie['idMedecin']);  
            } 
            $personne = new Usager(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),Fonction::U,$idMedecin,$sortie['numero_securite'],$sortie['code_postal'],$sortie['ville'],$sortie['Adresse']);
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
        $personne = new Usager(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),Fonction::U,$idMedecin,$sortie['numero_securite'],$sortie['code_postal'],$sortie['ville'],$sortie['Adresse']);
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
        $personne = new Medecin(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),Fonction::M);
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
    if ($sortie['fonction']==Fonction::M->name) {
        $personne = new Medecin(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),Fonction::M);
        $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
    }
    if ($sortie['fonction']==Fonction::U->name) {
        $idMedecin=null;
        if ($sortie['idMedecin']!=null) {
          $idMedecin = $this->getById($sortie['idMedecin']);  
        } 
        $personne = new Usager(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),Fonction::U,$idMedecin,$sortie['numero_securite'],$sortie['code_postal'],$sortie['ville'],$sortie['Adresse']);
        $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
    }
    return $personne;
}


function insert($item) {
    $pdo = $this->connexion->getPDO();
    $insert = $pdo->prepare('INSERT INTO 
        Personne(fonction,nomPersonne,prenomPersonne,civilite,Adresse,code_postal,ville,numero_securite,idMedecin) 
            VALUES
            (:fonction,:nomPersonne,:prenomPersonne,:civilite,:Adresse,:code_postal,:ville,:numero_securite,:idMedecin)'
    );

    if($item instanceof Medecin) {
        $insert->execute(array(
            'fonction' => $item->getFonction()->name,
            'nomPersonne' => $item->getPersonne()->getNom(),
            'prenomPersonne' => $item->getPersonne()->getPrenom(),
            'civilite' => $item->getPersonne()->getCivilite()->name,
            'Adresse' => NULL,
            'code_postal' => NULL,
            'ville' => NULL,
            'numero_securite' => NULL,
            'idMedecin' => NULL
        ));
    }

    if($item instanceof Usager) {
        $idMedecin=null;
        if ($item->getMedecinReferant()!=null) {
          $idMedecin = $item->getMedecinReferant()->getPersonne()->getIdPersonne();  
        } 
        $insert->execute(array(
            'fonction' => $item->getFonction()->name,
            'nomPersonne' => $item->getPersonne()->getNom(),
            'prenomPersonne' => $item->getPersonne()->getPrenom(),
            'civilite' => $item->getPersonne()->getCivilite()->name,
            'Adresse' => $item->getAdresse(),
            'code_postal' => $item->getCode_postal(),
            'ville' => $item->getVille(),
            'numero_securite' => $item->getNumero_securite(),
            'idMedecin' => $idMedecin
        ));

    }
}

function update($item) {
    $pdo = $this->connexion->getPDO();
    $update = $pdo->prepare('UPDATE Personne SET
        nomPersonne = :nomPersonne ,
        prenomPersonne = :prenomPersonne ,
        civilite =  :civilite ,
        Adresse = :adresse ,
        code_postal = :code_postal ,
        ville = :ville ,
        numero_securite = :numero_securite,
        idMedecin = :idMedecin
        WHERE idPersonne = :idPersonne '
    );
    $personne = $item->getPersonne();
    $nom = $personne->getNom();
    $prenom = $item->getPersonne()->getPrenom();
    $civilite = $item->getPersonne()->getCivilite()->name;
    $id = $item->getPersonne()->getIdPersonne();
    $update->bindParam(':idPersonne',$id , PDO::PARAM_INT);
    $update->bindParam(':nomPersonne',$nom , PDO::PARAM_STR);
    $update->bindParam(':prenomPersonne',$prenom ,PDO::PARAM_STR);
    $update->bindParam(':civilite',$civilite,PDO::PARAM_STR);

    if($item instanceof Medecin) {
        $null=NULL;
        $update->bindParam(':adresse',$null , PDO::PARAM_STR);
        $update->bindParam(':code_postal',$null ,PDO::PARAM_STR);
        $update->bindParam(':ville',$null,PDO::PARAM_STR);
        $update->bindParam(':numero_securite',$null , PDO::PARAM_STR);
        $update->bindParam(':idMedecin',$null ,PDO::PARAM_INT);
    }

    if($item instanceof Usager) {
        $idMedecin=null;
        try{
            $idMedecin = $item
            ->getMedecinReferant()
            ->getPersonne()
            ->getIdPersonne();
        } catch (Exception $e) {echo $e->getMessage();}finally {
            $adresse = $item->getAdresse();
            $code_postal = $item->getCode_postal();
            $ville = $item->getVille();
            $numero_securite = $item->getNumero_securite();
            $update->bindParam(':adresse',$adresse , PDO::PARAM_STR);
            $update->bindParam(':code_postal',$code_postal ,PDO::PARAM_STR);
            $update->bindParam(':ville',$ville,PDO::PARAM_STR);
            $update->bindParam(':numero_securite',$numero_securite , PDO::PARAM_STR);
            $update->bindParam(':idMedecin',$idMedecin ,PDO::PARAM_INT);
        }
        
    }

    $update->execute();
}
function delete($cle) {
    if($this->getById($cle) instanceof Medecin) {
        $array = $this->getAllUsagerByMedecin($cle);
        foreach ($array as $cle => $valeur) {
            $valeur->getMedecinReferant()->getPersonne()->setIdPersonne(null);
            $this->update($valeur);
        }
    }
    $pdo = $this->connexion->getPDO();
    $delete = $pdo->prepare('DELETE FROM Personne WHERE idPersonne = :idPersonne');
    $delete->bindParam(':idPersonne',$cle,PDO::PARAM_INT);
    $delete->execute();
}

function getAllUsagerByMedecin($cle) {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT * FROM Personne WHERE idMedecin = $cle");
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    $retour = array();
    foreach ($tableauSortie as $cle => $sortie) {
        $personne = new Usager(new Personne($sortie['nomPersonne'],$sortie['prenomPersonne'],Civilite::valueOf($sortie['civilite'])),Fonction::U,$this->getById($sortie['idMedecin']),$sortie['numero_securite'],$sortie['code_postal'],$sortie['ville'],$sortie['Adresse']);
        $personne->getPersonne()->setIdPersonne($sortie['idPersonne']);
        array_push($retour,$personne);
    }
    return $retour;
}

}

?>