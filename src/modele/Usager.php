<?php


/**
 * Summary of Usager
 */
class Usager {
    
    private String $numero_securite;
    private String $code_postal;
    private String $ville;
    private String $adresse;
    private Personne $personne;
	private ?Medecin $medecinReferent;


    public function __construct(Personne $personne, ?Medecin $medecinReferent, String $numero_securite, String $code_postal, String $ville, String $adresse){
        if (empty($personne) || empty($numero_securite) || empty($code_postal) || empty($ville) || empty($adresse)){
            throw new ErrorException("Champ invalide");
        } else {
			$this->medecinReferent=$medecinReferent;
            $this->numero_securite=$numero_securite;
            $this->code_postal=$code_postal;
            $this->ville=$ville;
            $this->adresse = $adresse;
            $this->personne = $personne;
        }
        
    }

	/**
	 * @return string
	 */
	public function getNumero_securite(): string {
		return $this->numero_securite;
	}
	
	/**
	 * @param string $numero_securite 
	 * @return self
	 */
	public function setNumero_securite(string $numero_securite): self {
		$this->numero_securite = $numero_securite;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCode_postal(): string {
		return $this->code_postal;
	}
	
	/**
	 * @param string $code_postal 
	 * @return self
	 */
	public function setCode_postal(string $code_postal): self {
		$this->code_postal = $code_postal;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVille(): string {
		return $this->ville;
	}
	
	/**
	 * @param string $ville 
	 * @return self
	 */
	public function setVille(string $ville): self {
		$this->ville = $ville;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAdresse(): string {
		return $this->adresse;
	}
	
	/**
	 * @param string $adresse 
	 * @return self
	 */
	public function setAdresse(string $adresse): self {
		$this->adresse = $adresse;
		return $this;
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

	/**
	 * @return ?Medecin
	 */
	public function getMedecinReferant(): ?Medecin {
		return $this->medecinReferent;
	}

  /**
	 * @param ?Medecin $medecin 
	 * @return self
	 */
	public function setMedecinReferant(?Medecin $medecin): self {
		$this->medecinReferent = $medecin;
		return $this;
	}
}

?>