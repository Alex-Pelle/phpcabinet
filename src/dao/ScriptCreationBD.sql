
/*TABLES*/
CREATE TABLE Personne (
  idPersonne int NOT NULL AUTO_INCREMENT,
  fonction CHAR(1) NOT NULL,
  nomPersonne VARCHAR(25) NOT NULL,
	prenomPersonne VARCHAR(25)NOT NULL,
  civilite CHAR(1)NOT NULL,
  Adresse VARCHAR(50) NULL,
  code_postal CHAR(5) NULL,
  ville VARCHAR(25) NULL,
  numero_securite CHAR(15) NULL,
  idMedecin INT NULL,
  date_naissance DATE NULL,
  lieu_de_naissance VARCHAR(50) NULL,
	PRIMARY KEY(idPersonne),
  FOREIGN KEY(idMedecin) REFERENCES Personne(idPersonne)
);
CREATE TABLE rendez_vous (
	idUsager INT NOT NULL,
  idMedecin INT NOT NULL,
  date_rendez_vous DATE NOT NULL,
  heure_rendez_vous TIME NOT NULL,
  duree_minute INT DEFAULT 30,
  PRIMARY KEY(idUsager,idMedecin,date_rendez_vous,heure_rendez_vous),
  FOREIGN KEY(idUsager) REFERENCES Personne(idPersonne),
  FOREIGN KEY(idMedecin) REFERENCES Personne(idPersonne)
);