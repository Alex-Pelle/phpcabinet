<?php

class RendezVous {
  /**
   * Patient de ce rdv
   * @var Usager
   */
  private $usager;
  /**
   * Médecin de ce rdv
   * @var Medecin
   */
  private $medecin;
  /**
   * Id du patient de ce rdv
   * @var DateTime
   */
  private $dateHeureDebut;
  /**
   * Durée du rdv
   * @var Duree
   */
  private $dureeEnMinutes;

  /**
   * Crée un RDV, la durée a une valeur par défault de 30 minutes
   * @param Usager $usager
   * @param Medecin $medecin
   * @param DateTime $dateHeureDebut
   * @param Duree $dureeEnMinutes
   * @throws \Exception
   */
  public function __construct(Usager $usager, Medecin $medecin, DateTime $dateHeureDebut, Duree $dureeEnMinutes = new Duree(30)) {
    if (empty($usager) || empty($medecin) || empty($dateHeureDebut)) {
      throw new Exception("Le RDV  doit avoir un usager, un médecin et une date-heure.");
    }
    $this->usager = $usager;
    $this->medecin = $medecin;
    $this->dateHeureDebut = $dateHeureDebut;
    $this->dureeEnMinutes = $dureeEnMinutes;
  }
	/**
	 * @return Usager
	 */
	public function getUsager() {
		return $this->usager;
	}
	
	/**
	 * @param Usager $usager 
	 * @return self
	 */
	public function setUsager(Usager $usager): self {
		$this->usager = $usager;
		return $this;
	}

	/**
	 * @return Medecin
	 */
	public function getMedecin() {
		return $this->medecin;
	}
	
	/**
	 * @param Medecin $medecin 
	 * @return self
	 */
	public function setMedecin(Medecin $medecin): self {
		$this->medecin = $medecin;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getDateHeureDebut() {
		return $this->dateHeureDebut;
	}

	
	/**
	 * @param DateTime $dateHeureDebut
	 * @return self
	 */
	public function setDateHeureDebut(DateTime $dateHeureDebut): self {
		$this->dateHeureDebut = $dateHeureDebut;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDureeEnMinutes() {
		return $this->dureeEnMinutes;
	}
	
	/**
	 * @param mixed $dureeEnMinutes 
	 * @return self
	 */
	public function setDureeEnMinutes(Duree $dureeEnMinutes): self {
		$this->dureeEnMinutes = $dureeEnMinutes;
		return $this;
	}
}
?>