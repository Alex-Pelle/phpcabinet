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
    $getById = $pdo->query("SELECT * FROM rendez_vous WHERE idPersonne = $cle");
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
            'date_rendez_vous' => $item->getDateDebut(),
            'heure_rendez_vous' => $item->getHeureDebut(),
            'duree_minute' => $item->getDureeEnMinutes()
        ));
    }
}

function update($item) {
    if($item instanceof RendezVous) {
        $pdo = $this->connexion->getPDO();
        $update = $pdo->prepare('UPDATE Personne SET 
            duree_minute = :duree_minute
            WHERE idUsager = :idUsager AND 
            idMedecin = : idMedecin AND 
            date_rendez_vous = :date_rednez_vous AND 
            heure_rendez_vous = :heure_rendez_vous 
        ');

   
        $update->execute(array(
            'idUsager' => $item->getUsager()->getPersonne()->getIdPersonne(),
            'idMedecin' => $item->getMedecin()->getPersonne()->getIdPersonne(),
            'date_rendez_vous' => $item->getDateDebut(),
            'heure_rendez_vous' => $item->getHeureDebut(),
            'duree_minute' => $item->getDureeEnMinutes()
        ));


        $update->execute();
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
        idMedecin = : idMedecin AND 
        date_rendez_vous = :date_rednez_vous AND 
        heure_rendez_vous = :heure_rendez_vous 
    ');

        $delete->execute(array(
        'idUsager' => $idUsager,
        'idMedecin' => $idMedecin,
        'date_rendez_vous' => $dateRDV,
        'heure_rendez_vous' => $heureRDV,
    ));
    
}

}

?>