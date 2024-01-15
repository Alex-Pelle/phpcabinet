<?php


class Personne {
    private int $idPersonne;
    private String $nom;
    private String $prenom;
    private Civilite $civilite;

    public function __construct(String $nom, String $prenom, Civilite $civilite) {
        if (!empty($nom)||!empty($prenom)||!empty($civilite)) {
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->civilite=$civilite;
        } else {
            throw new ErrorException("Champ vide");
        }
    }
    

	

	/**
	 * @return int
	 */
	public function getIdPersonne(): int {
		return $this->idPersonne;
	}
	
	/**
	 * @param int $idPersonne 
	 * @return self
	 */
	public function setIdPersonne(int $idPersonne): self {
		$this->idPersonne = $idPersonne;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getNom(): string {
		return $this->nom;
	}
	
	/**
	 * @param string $nom 
	 * @return self
	 */
	public function setNom(string $nom): self {
		$this->nom = $nom;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPrenom(): string {
		return $this->prenom;
	}
	
	/**
	 * @param string $prenom 
	 * @return self
	 */
	public function setPrenom(string $prenom): self {
		$this->prenom = $prenom;
		return $this;
	}

	/**
	 * @return Civilite
	 */
	public function getCivilite(): Civilite {
		return $this->civilite;
	}
	
	/**
	 * @param Civilite $civilite 
	 * @return self
	 */
	public function setCivilite(Civilite $civilite): self {
		$this->civilite = $civilite;
		return $this;
	}
}

?>