<?php
require_once(__DIR__.'/DaoPersonne.php');
class DaoRDV implements Dao {

  private Connexion $connexion;

  public function __construct(Connexion $c) {
      $this->connexion=$c;
  }

  private function lignesEnObjects($resultats) {
    $daoPersonne = new DaoPersonne($this->connexion);
    $tableauSortie = array();
    foreach ($resultats as $i => $resultat) {
      $usager = $daoPersonne->getById($resultat['idUsager']);
      $medecin = $daoPersonne->getById($resultat['idMedecin']);
      $dateheure = new DateTime($resultat['date_rendez_vous'].' '.$resultat['heure_rendez_vous']);
      $duree = new Duree(intval($resultat['duree_minute']));
      array_push($tableauSortie, new RendezVous($usager,$medecin,$dateheure,$duree));
    }
    return $tableauSortie;
  }
  function getAll() {
      $pdo = $this->connexion->getPDO();
      $getAll = $pdo->query('SELECT * FROM rendez_vous ORDER BY date_rendez_vous DESC');
      $resultats = $getAll->fetchAll(PDO::FETCH_ASSOC);
      return $this->lignesEnObjects($resultats);
  }
  /**
   * Le paramètre à passer est un tableau contenant dans l'orde : 
   * idUsager (INTEGER)
   * idMedecin (INTEGER)
   * dateRDV (STRING) (le format à respecter est format("Y-m-d") à partir d'un objet DateTime)
   * heureRDV (STRING) (le format à respecter est format("H:i:s") à partir d'un objet DateTime)
   */
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
      $daoPersonne = new DaoPersonne($this->connexion);
      $usager = $daoPersonne->getById($sortie['idUsager']);
      $medecin = $daoPersonne->getById($sortie['idMedecin']);
      $dateheure = new DateTime($sortie['date_rendez_vous'].' '.$sortie['heure_rendez_vous']);
      $duree = new Duree(intval($sortie['duree_minute']));
      return new RendezVous($usager,$medecin,$dateheure,$duree);
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

  /**
   * Le paramètre à passer est un tableau contenant dans l'orde : 
   * idUsager (INTEGER)
   * idMedecin (INTEGER)
   * dateRDV (STRING) (le format à respecter est format("Y-m-d") à partir d'un objet DateTime)
   * heureRDV (STRING) (le format à respecter est format("H:i:s") à partir d'un objet DateTime)
   */
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
      $getAll = $pdo->query("SELECT * FROM rendez_vous WHERE idUsager = $idPersonne ORDER BY date_rendez_vous DESC");
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
      $getAll = $pdo->query("SELECT * FROM rendez_vous WHERE idMedecin = $idPersonne ORDER BY date_rendez_vous DESC");
      $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
      $retour = array();
      $daoPersonne = new DaoPersonne($this->connexion);
      foreach ($tableauSortie as $cle => $sortie) {
          $usager = $daoPersonne->getById($sortie['idUsager']);
          $medecin = $daoPersonne->getById($sortie['idMedecin']);
          $dateHeure = new DateTime($sortie['date_rendez_vous'].' '.$sortie['heure_rendez_vous']);
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

  function getRDVByUsagerAndMedecin($idusager,$idmedecin) {
    $pdo = $this->connexion->getPDO();
    $getAll = $pdo->query("SELECT * FROM rendez_vous WHERE idMedecin = $idmedecin AND idUsager = $idusager ORDER BY date_rendez_vous DESC");
    $tableauSortie = $getAll->fetchAll(PDO::FETCH_ASSOC);
    $retour = array();
    $daoPersonne = new DaoPersonne($this->connexion);
    foreach ($tableauSortie as $cle => $sortie) {
        $usager = $daoPersonne->getById($sortie['idUsager']);
        $medecin = $daoPersonne->getById($sortie['idMedecin']);
        $dateHeure = new DateTime($sortie['date_rendez_vous'].' '.$sortie['heure_rendez_vous']);
        $duree = new Duree($sortie['duree_minute']); 
        $rdv = new RendezVous($usager,$medecin,$dateHeure);
        $rdv->setDureeEnMinutes($duree);
        array_push($retour,$rdv);
    }
    return $retour;
  }
}