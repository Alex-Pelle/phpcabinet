<?php

class Medecin {
    private Personne $personne;
	private Fonction $fonction;
    public function __construct(Personne $personne, Fonction $fonction) {
        if (!empty($personne) && !empty($fonction)) {
            $this->personne = $personne;
			$this->fonction = $fonction;
        } else {
            throw new ErrorException("Champ invalide");
        }
        
    }

  
	/**
	 * @return Fonction
	 */
	public function getFonction(): Fonction {
		return $this->fonction;
	}

	/**
	 * @return Personne
	 */
	public function getPersonne(): Personne {
		return $this->personne;
	}
	
	/**
	 * @param Personne $personne 
	 * @return self
	 */
	public function setPersonne(Personne $personne): self {
		$this->personne = $personne;
		return $this;
	}
}

?>