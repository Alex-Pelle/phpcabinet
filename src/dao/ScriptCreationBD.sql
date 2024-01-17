
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
INSERT INTO Personne (fonction, nomPersonne, prenomPersonne, civilite, Adresse, code_postal, ville, numero_securite, idMedecin, date_naissance, lieu_de_naissance)
VALUES
    ('U', 'Martin', 'Alice', 'F', '123 Rue de la Liberté', '75001', 'Paris', '285751234567891', null,'1985-01-01','Paris'),
    ('M', 'Dupont', 'Pierre', 'H', null, null, null, null, null, null, null),
    ('U', 'Lefevre', 'Sophie', 'F', '789 Rue du Château', '69003', 'Lyon', '285755551234562', null, '1985-01-01','Lyon'),
    ('M', 'Dufresne', 'Paul', 'H', null, null, null, null, null, null, null),
    ('U', 'Lambert', 'Julie', 'F', '234 Boulevard de l\'Océan', '33000', 'Bordeaux', '285753219876543', null,'1985-01-01','Bordeaux'),
    ('M', 'Roux', 'Thomas', 'H', null, null, null, null, null, null, null),
    ('U', 'Girard', 'Lucie', 'F', '890 Avenue des Tulipes', '59000', 'Lille', '285757890123454', null, '1985-01-01','Lille'),
    ('M', 'Morel', 'Antoine', 'H', null, null, null, null, null, null, null),
    ('U', 'Roy', 'Camille', 'F', '456 Rue de la Mer', '76000', 'Rouen', '285751357924685', null, '1985-01-01','Rouen'),
    ('M', 'Lemoine', 'Victor', 'H', null, null, null, null, null, null, null),
    ('U', 'Bertrand', 'Isabelle', 'F', '101 Avenue des Palmiers', '06000', 'Nice', '285755432109876', null,'1985-01-01','Nice'),
    ('M', 'Deschamps', 'Nicolas', 'H', null, null, null, null, null, null, null),
    ('U', 'Fournier', 'Céline', 'F', '567 Avenue du Soleil', '34000', 'Montpellier', '285753210987657', null,'1985-01-01','Montpellier'),
    ('M', 'Mallet', 'Alexandre', 'H', null, null, null, null, null, null, null),
    ('U', 'Dubreuil', 'Marie', 'F', '123 Avenue du Champagne', '51000', 'Reims', '285754321098768', null,'1985-01-01','Reims');