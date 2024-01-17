
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
    ('M', 'Dupont', 'Isabelle', 'F', null, null, null, null, null, null, null),
    ('M', 'Dufresne', 'Sophie', 'F', null, null, null, null, null, null, null),
    ('M', 'Roux', 'Céline', 'F', null, null, null, null, null, null, null),
    ('M', 'Morel', 'Marie', 'F', null, null, null, null, null, null, null),
    ('M', 'Lemoine', 'Victor', 'H', null, null, null, null, null, null, null),
    ('M', 'Deschamps', 'Nicolas', 'H', null, null, null, null, null, null, null),
    ('M', 'Mallet', 'Alexandre', 'H', null, null, null, null, null, null, null),
    ('M', 'Laquet', 'Quentin', 'H', null, null, null, null, null, null, null);


    INSERT INTO Personne (fonction, nomPersonne, prenomPersonne, civilite, adresse, ville , code_postal, numero_securite, idMedecin, date_naissance, lieu_de_naissance)
VALUES
    ('U','Léa', 'Dubois', 'F' ,'123 Rue de la Liberté', 'Paris', '75000', '2147532469183', 136, '2014-03-25', 'Nîmes'),
    ('U','Gabriel', 'Martin', 'H', '456 Avenue des Roses', 'Marseille', '13000', '1871311372548', 137, '1987-09-12', 'Saint-Denis'),
    ('U','Manon', 'Leroux', 'F', '789 Boulevard du Soleil', 'Lyon', '69000', '2565642431902', 138, '1956-07-08', 'Toulon'),
    ('U','Lucas', 'Lefevre', 'H', '101 Rue de Avenir', 'Toulouse', '31000', '1803193788150', 139, '1980-02-15', 'Saint-Nazaire'),
    ('U','Emma', 'Bernard', 'F', '202 Rue de Espoir', 'Nice', '06000', '2656343157240', 140, '1965-11-30', 'Le Havre'),
    ('U','Louis', 'Robert', 'H', '303 Avenue de la Paix', 'Nantes', '44000', '2130448232898', 141, '2003-06-20', 'Besançon'),
    ('U','Chloé', 'Dupont', 'F', '404 Chemin de la Tranquillité', 'Strasbourg', '67000', '2787108759554', 142, '1978-05-10', 'Mulhouse'),
    ('U','Nathan', 'Moreau', 'H', '505 Allée de la Victoire', 'Montpellier', '34000', '2953413985592', 143, '1995-08-22', 'Aix-en-Provence'),
    ('U','Jade', 'Simon', 'F', '606 Rue du Bonheur', 'Bordeaux', '33000', '2823328235761', 136, '1982-04-18', 'Villeurbanne'),
    ('U','Hugo', 'Laurent', 'H', '707 Avenue de la Sagesse', 'Lille', '59000', '2605933079273', 137, '1960-10-05', 'Brest'),
    ('U','Zoé', 'Girard', 'F', '808 Boulevard de la Joie', 'Rennes', '35000', '2923578279449', 138, '1992-12-10', 'Champigny-sur-Marne'),
    ('U','Jules', 'Thomas', 'H', '909 Chemin de la Nature', 'Reims', '51100', '2737126829782', 139, '1973-01-28', 'Tours'),
    ('U','Camille', 'Lemoine', 'F', '111 Rue de la Libération', 'Le Havre', '76600', '2899283411642', 140, '1989-07-15', 'Pau'),
    ('U','Mathis', 'Leroy', 'H', '222 Avenue des Champs', 'Cergy', '95000', '2727672850340', 141, '1972-11-25', 'Metz'),
    ('U','Louise', 'Roux', 'F', '333 Boulevard des Lumières', 'Saint-Étienne', '42000', '2505691804575', 142, '2005-09-01', 'Cergy'),
    ('U','Adam', 'Lefort', 'H', '444 Allée des Étoiles', 'Toulon', '83000', '2686810507641', 143, '1968-04-14', 'Amiens'),
    ('U','Clara', 'Michel', 'F', '555 Chemin des Montagnes', 'Grenoble', '38000', '2804599879229', null, '2008-10-08', 'La Rochelle'),
    ('U','Théo', 'Giraud', 'H', '666 Rue de la Vie', 'Dijon', '21000', '2999984537457', null, '1945-06-22', 'Courbevoie'),
    ('U','Lola', 'Gauthier', 'F', '777 Avenue des Oiseaux', 'Angers', '49000', '2845096096633', null, '1999-03-17', 'Limoges'),
    ('U','Inès', 'Petit', 'F', '888 Boulevard de la Plage', 'Nîmes', '30000', '2906916475822', null, '1984-08-19', 'Le Mans'),
    ('U','Raphaël', 'Faure', 'H', '999 Allée des Fleurs', 'Villeurbanne', '69100', '2700282106306', null, '1990-12-30', 'Grenoble'),
    ('U','Lilou', 'Mercier', 'F', '121 Rue des Nuages', 'Le Mans', '72000', '2129261874425', null, '1970-02-20', 'Clermont-Ferrand'),
    ('U','Ethan', 'Roche', 'H', '232 Avenue du Vent', 'Aix-en-Provence', '13090', '2876334829230', null, '2001-01-03', 'Nanterre'),
    ('U','Rose', 'Caron', 'F', '343 Boulevard de la Rivière', 'Brest', '29200', '2529273176741', null, '1986-05-15', 'Reims'),
    ('U','Noah', 'Leroux', 'H', '454 Chemin des Vallées', 'Levallois-Perret', '92300', '2977494214974', 136, '1952-11-28', 'Lorient'),
    ('U','Anaïs', 'Brun', 'F', '565 Rue des Forêts', 'Caen', '14000', '2636024562113', 137, '1997-09-12', 'Perpignan'),
    ('U','Léo', 'Durand', 'H', '676 Avenue des Rêves', 'Clermont-Ferrand', '63000', '2757531699978', 138, '1963-04-05', 'Angers'),
    ('U','Lina', 'Lemoine', 'F', '787 Boulevard des Cieux', 'Amiens', '80000', '2936798001954', 139, '2006-07-18', 'Montpellier'),
    ('U','Enzo', 'Dupuis', 'H', '898 Allée des Merveilles', 'Limoges', '87000', '2407663346500', 140, '1975-10-30', 'Calais'),
    ('U','Eléna', 'Renault', 'F', '909 Rue des Sources', 'Tours', '37000', '2769351946314', 141, '1993-02-12', 'Avignon'),
    ('U','Axel', 'Henry', 'H', '123 Avenue des Monts', 'Metz', '57000', '2008434259991', 142, '1940-05-25', 'Toulouse'),
    ('U','Tom', 'Dubois', 'H', '345 Chemin des Gorges', 'Besançon', '25000', '2585471417258', 143, '1976-09-05', 'Caen'),
    ('U','Manon', 'Guillaume', 'F', '456 Rue des Rochers', 'Perpignan', '66000', '2922594628321', 136, '2000-12-18', 'Nantes'),
    ('U','Mattéo', 'Lefevre', 'H', '567 Allée des Prairies', 'Orléans', '45000', '2838339055427', 137, '1958-04-10', 'Lille'),
    ('U','Capucine', 'Robin', 'F', '678 Boulevard des Chutes', 'Mulhouse', '68100', '2984292917364', 138, '2009-07-22', 'Rennes'),
    ('U','Nolan', 'Roy', 'H', '789 Chemin des Cascades', 'Rouen', '76000', '2717180191606', 139, '1983-11-02', 'Dijon'),
    ('U','Zoé', 'Leclerc', 'F', '890 Rue des Collines', 'Saint-Denis', '93200', '2025269366256', 140, '1966-02-15', 'Fort-de-France'),
    ('U','Eliott', 'Guérin', 'H', '901 Avenue des Marais', 'Avignon', '84000', '2509637326720', 141, '1998-05-30', 'Nice'),
    ('U','Inaya', 'Renard', 'F', '112 Boulevard des Dunes', 'Nancy', '54000', '2226965274312', 142, '1948-09-10', 'Mulhouse'),
    ('U','Timéo', 'Lefort', 'H', '223 Allée des Baies', 'Lorient', '56100', '2837751965619', 143, '1971-12-22', 'La Rochelle'),
    ('U','Lilas', 'Picard', 'F', '334 Rue des Plaines', 'Nanterre', '92000', '2984275984680', null, '2002-04-15', 'Orléans'),
    ('U','Maxime', 'Vincent', 'H', '445 Chemin des Plages', 'Pau', '64000', '2427180019726', null, '1950-07-28', 'Nancy'),
    ('U','Maëlle', 'Martin', 'F', '556 Avenue des Côtes', 'La Rochelle', '17000', '2714482308148', null, '1996-11-08', 'Lyon'),
    ('U','Evan', 'Perrin', 'H', '667 Boulevard des Vagues', 'Champigny-sur-Marne', '94500', '2206333967296', null, '1969-02-20', 'Marseille'),
    ('U','Thaïs', 'Deschamps', 'F', '778 Allée des Falaises', 'Saint-Maur-des-Fossés', '94100', '2627786628243', null, '2007-06-02', 'Paris'),
    ('U','Ethan', 'Gérard', 'H', '889 Rue des Sables', 'Antibes', '06600', '2092493560073', null, '1977-09-15', 'Levallois-Perret'),
    ('U','Mia', 'Roussel', 'F', '900 Chemin des Grèves', 'Calais', '62100', '2977799304615', null, '1942-01-25', 'Antibes'),
    ('U','Victor', 'Barbier', 'H', '111 Rue des Horizons', 'Courbevoie', '92400', '2445632648406', null, '1994-05-08', 'Rouen');













