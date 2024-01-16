<?php

class DaoRDV implements Dao {

    private Connexion $connexion;

    public function __construct(Connexion $c) {
        $this->connexion=$c;
    }

function getAll() {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query('SELECT * FROM rendez_vous');
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    return $tableauSortie;
}

function getById($cle) {
    $idUsager = $cle[0];
    $idMedecin = $cle[1];
    $dateRDV = $cle[2];
    $heureRDV = $cle[3];

    $pdo = $this->connexion->getPDO();
    $getById = $pdo->prepare("SELECT * FROM rendez_vous 
    WHERE idUsager = :idUsager AND 
    idMedecin = :idMedecin AND 
    date_rendez_vous = :date_rendez_vous AND 
    heure_rendez_vous = :heure_rendez_vous ");

    $getById->execute(array(
        'idUsager' => $idUsager,
        'idMedecin' => $idMedecin,
        'date_rendez_vous' => $dateRDV,
        'heure_rendez_vous' => $heureRDV
    ));

    $sortie = $getById->fetch(PDO::FETCH_ASSOC);
    return $sortie;
}

function insert($item) {
    $pdo = $this->connexion->getPDO();
    $insert = $pdo->prepare('INSERT INTO 
        rendez_vous(idUsager , idMedecin, date_rendez_vous , heure_rendez_vous, duree_minute) 
            VALUES
            (:idUsager , :idMedecin, :date_rendez_vous , :heure_rendez_vous, :duree_minute)'
    );

    if($item instanceof RendezVous) {
        $insert->execute(array(
            'idUsager' => $item->getUsager()->getPersonne()->getIdPersonne(),
            'idMedecin' => $item->getMedecin()->getPersonne()->getIdPersonne(),
            'date_rendez_vous' => $item->getDateHeureDebut()->format("Y-m-d"),
            'heure_rendez_vous' => $item->getDateHeureDebut()->format("H:i:s"),
            'duree_minute' => $item->getDureeEnMinutes()->getNbMinutes()
        ));
    }
}

function update($item) {
    if($item instanceof RendezVous) {
        $pdo = $this->connexion->getPDO();
        $update = $pdo->prepare('UPDATE rendez_vous SET 
            duree_minute = :duree_minute
            WHERE idUsager = :idUsager AND 
            idMedecin = :idMedecin AND 
            date_rendez_vous = :date_rendez_vous AND 
            heure_rendez_vous = :heure_rendez_vous 
        ');
        $update->execute(array(
            'idUsager' => $item->getUsager()->getPersonne()->getIdPersonne(),
            'idMedecin' => $item->getMedecin()->getPersonne()->getIdPersonne(),
            'date_rendez_vous' => $item->getDateHeureDebut()->format("Y-m-d"),
            'heure_rendez_vous' => $item->getDateHeureDebut()->format("H:i:s"),
            'duree_minute' => $item->getDureeEnMinutes()->getNbMinutes()
        ));
    }
}
function delete($cle) {

    $idUsager = $cle[0];
    $idMedecin = $cle[1];
    $dateRDV = $cle[2];
    $heureRDV = $cle[3];

    $pdo = $this->connexion->getPDO();
    $delete = $pdo->prepare ('DELETE FROM rendez_vous 
        WHERE idUsager = :idUsager AND 
        idMedecin = :idMedecin AND 
        date_rendez_vous = :date_rendez_vous AND 
        heure_rendez_vous = :heure_rendez_vous 
    ');

        $delete->execute(array(
        'idUsager' => $idUsager,
        'idMedecin' => $idMedecin,
        'date_rendez_vous' => $dateRDV,
        'heure_rendez_vous' => $heureRDV,
    ));
    
}

function getRendezVousByUsager($idPersonne) {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT * FROM rendez_vous WHERE idUsager = $idPersonne");
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    $retour = array();
    $daoPersonne = new DaoPersonne($this->connexion);
    foreach ($tableauSortie as $cle => $sortie) {
        $usager = $daoPersonne->getById($sortie['idUsager']);
        $medecin = $daoPersonne->getById($sortie['idMedecin']);
        $dateHeure = new DateTime($sortie['date_rendez_vous'].$sortie['heure_rendez_vous']);
        $duree = new Duree($sortie['duree_minute']); 
        $rdv = new RendezVous($usager,$medecin,$dateHeure);
        $rdv->setDureeEnMinutes($duree);
        array_push($retour,$rdv);
    }
    return $retour;
}

function getRendezVousByMedecin($idPersonne) {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT * FROM rendez_vous WHERE idMedecin = $idPersonne");
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    $retour = array();
    $daoPersonne = new DaoPersonne($this->connexion);
    foreach ($tableauSortie as $cle => $sortie) {
        $usager = $daoPersonne->getById($sortie['idUsager']);
        $medecin = $daoPersonne->getById($sortie['idMedecin']);
        $dateHeure = new DateTime($sortie['date_rendez_vous'].$sortie['heure_rendez_vous']);
        $duree = new Duree($sortie['duree_minute']); 
        $rdv = new RendezVous($usager,$medecin,$dateHeure);
        $rdv->setDureeEnMinutes($duree);
        array_push($retour,$rdv);
    }
    return $retour;
}

function getRendezVousByPersonne($idPersonne) {
    $daoPersonne = new DaoPersonne($this->connexion);
    if($daoPersonne->getById($idPersonne) instanceof Medecin) {
        return $this->getRendezVousByMedecin($idPersonne);
    } else if ($daoPersonne->getById($idPersonne) instanceof Usager) {
        return $this->getRendezVousByUsager($idPersonne);
    } else {
        return null;
    }
}
}

?>