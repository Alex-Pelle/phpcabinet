<?php

class Medecin {
    private Personne $personne;
    public function __construct(Personne $personne) {
        if (!empty($personne)) {
            $this->personne = $personne;
        } else {
            throw new ErrorException("Champ invalide");
        }
        
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