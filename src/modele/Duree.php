<?php

class Duree {
  /**
   * Summary of nbMinutes
   * @var int
   */
  private int $nbMinutes;
  /**
   * Construit une durée à partir de son nombre de minutes
   * @param int $nbMinutes
   */
  public function __construct(int $nbMinutes) {
    $this->nbMinutes = $nbMinutes;
  }
  /**
   * Renvoie les minutes de la durée (entre 0 et 59)
   * @return int
   */
  private function getMinutes(): int {
    return $this->nbMinutes%60;
  }
  /**
   * Renvoie les heures de la durée 
   * @return int
   */
  public function getHeures(): int {
    return floor($this->nbMinutes/60);
  }

	/**
   * Renvoie le nombre de minutes contenues dans la durée
	 * @return int
	 */
	public function getNbMinutes(): int {
		return $this->nbMinutes;
	}
}

?>