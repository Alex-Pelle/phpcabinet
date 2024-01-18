
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

DELIMITER //
CREATE TRIGGER check_numero_securite
BEFORE INSERT ON Personne
FOR EACH ROW
BEGIN
    DECLARE v_count INT;
    
    IF NEW.numero_securite IS NOT NULL THEN
        -- Vérifie si le numero_securite existe déjà dans la table
        SELECT COUNT(*)
        INTO v_count
        FROM Personne
        WHERE numero_securite = NEW.numero_securite;

        IF v_count > 0 THEN
            SIGNAL SQLSTATE '45002'
            SET MESSAGE_TEXT = 'Le numero_securite existe déjà dans la table.';
        END IF;
    END IF;
END//
DELIMITER ;


DELIMITER //
CREATE TRIGGER before_insert_rendez_vous_medecin
BEFORE INSERT ON rendez_vous
FOR EACH ROW
BEGIN
    DECLARE existing_rendezvous INT;
    
    SELECT COUNT(*)
    INTO existing_rendezvous
    FROM rendez_vous
    WHERE idMedecin = NEW.idMedecin
    AND date_rendez_vous = NEW.date_rendez_vous
    AND (
        (heure_rendez_vous BETWEEN NEW.heure_rendez_vous AND ADDTIME(NEW.heure_rendez_vous, SEC_TO_TIME(NEW.duree_minute * 60)))
        OR
        (ADDTIME(heure_rendez_vous, SEC_TO_TIME(duree_minute * 60)) BETWEEN NEW.heure_rendez_vous AND ADDTIME(NEW.heure_rendez_vous, SEC_TO_TIME(NEW.duree_minute * 60)))
    );

    IF existing_rendezvous > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Un rendez-vous est programmé dans cet intervalle pour ce medecin et cette personne.';
    END IF;
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER before_insert_rendez_vous_usager
BEFORE INSERT ON rendez_vous
FOR EACH ROW
BEGIN
    DECLARE existing_rendezvous INT;
    
    SELECT COUNT(*)
    INTO existing_rendezvous
    FROM rendez_vous
    WHERE idUsager = NEW.idUsager
    AND date_rendez_vous = NEW.date_rendez_vous
    AND (
        (heure_rendez_vous BETWEEN NEW.heure_rendez_vous AND ADDTIME(NEW.heure_rendez_vous, SEC_TO_TIME(NEW.duree_minute * 60)))
        OR
        (ADDTIME(heure_rendez_vous, SEC_TO_TIME(duree_minute * 60)) BETWEEN NEW.heure_rendez_vous AND ADDTIME(NEW.heure_rendez_vous, SEC_TO_TIME(NEW.duree_minute * 60)))
    );

    IF existing_rendezvous > 0 THEN
        SIGNAL SQLSTATE '45001'
        SET MESSAGE_TEXT = 'Un rendez-vous est programmé dans cet intervalle pour ce medecin et cette personne.';
    END IF;
END;
//

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


    INSERT INTO Personne (fonction, prenomPersonne, nomPersonne, civilite, adresse, ville , code_postal, numero_securite, idMedecin, date_naissance, lieu_de_naissance)
VALUES
    ('U','Léa', 'Dubois', 'F' ,'123 Rue de la Liberté', 'Paris', '75000', '2147532469183', 1, '2014-03-25', 'Nîmes'),
    ('U','Gabriel', 'Martin', 'H', '456 Avenue des Roses', 'Marseille', '13000', '1871311372548', 2, '1987-09-12', 'Saint-Denis'),
    ('U','Manon', 'Leroux', 'F', '789 Boulevard du Soleil', 'Lyon', '69000', '2565642431902', 3, '1956-07-08', 'Toulon'),
    ('U','Lucas', 'Lefevre', 'H', '101 Rue de Avenir', 'Toulouse', '31000', '1803193788150', 4, '1980-02-15', 'Saint-Nazaire'),
    ('U','Emma', 'Bernard', 'F', '202 Rue de Espoir', 'Nice', '06000', '2656343157240', 5, '1965-11-30', 'Le Havre'),
    ('U','Louis', 'Robert', 'H', '303 Avenue de la Paix', 'Nantes', '44000', '2130448232898', 6, '2003-06-20', 'Besançon'),
    ('U','Chloé', 'Dupont', 'F', '404 Chemin de la Tranquillité', 'Strasbourg', '67000', '2787108759554', 7, '1978-05-10', 'Mulhouse'),
    ('U','Nathan', 'Moreau', 'H', '505 Allée de la Victoire', 'Montpellier', '34000', '2953413985592', 8, '1995-08-22', 'Aix-en-Provence'),
    ('U','Jade', 'Simon', 'F', '606 Rue du Bonheur', 'Bordeaux', '33000', '2823328235761', 1, '1982-04-18', 'Villeurbanne'),
    ('U','Hugo', 'Laurent', 'H', '707 Avenue de la Sagesse', 'Lille', '59000', '2605933079273', 2, '1960-10-05', 'Brest'),
    ('U','Zoé', 'Girard', 'F', '808 Boulevard de la Joie', 'Rennes', '35000', '2923578279449', 3, '1992-12-10', 'Champigny-sur-Marne'),
    ('U','Jules', 'Thomas', 'H', '909 Chemin de la Nature', 'Reims', '51100', '2737126829782', 4, '1973-01-28', 'Tours'),
    ('U','Camille', 'Lemoine', 'F', '111 Rue de la Libération', 'Le Havre', '76600', '2899283411642', 5, '1989-07-15', 'Pau'),
    ('U','Mathis', 'Leroy', 'H', '222 Avenue des Champs', 'Cergy', '95000', '2727672850340', 6, '1972-11-25', 'Metz'),
    ('U','Louise', 'Roux', 'F', '333 Boulevard des Lumières', 'Saint-Étienne', '42000', '2505691804575', 7, '2005-09-01', 'Cergy'),
    ('U','Adam', 'Lefort', 'H', '444 Allée des Étoiles', 'Toulon', '83000', '2686810507641', 8, '1968-04-14', 'Amiens'),
    ('U','Clara', 'Michel', 'F', '555 Chemin des Montagnes', 'Grenoble', '38000', '2804599879229', null, '2008-10-08', 'La Rochelle'),
    ('U','Théo', 'Giraud', 'H', '666 Rue de la Vie', 'Dijon', '21000', '2999984537457', null, '1945-06-22', 'Courbevoie'),
    ('U','Lola', 'Gauthier', 'F', '777 Avenue des Oiseaux', 'Angers', '49000', '2845096096633', null, '1999-03-17', 'Limoges'),
    ('U','Inès', 'Petit', 'F', '888 Boulevard de la Plage', 'Nîmes', '30000', '2906916475822', null, '1984-08-19', 'Le Mans'),
    ('U','Raphaël', 'Faure', 'H', '999 Allée des Fleurs', 'Villeurbanne', '69100', '2700282106306', null, '1990-12-30', 'Grenoble'),
    ('U','Lilou', 'Mercier', 'F', '121 Rue des Nuages', 'Le Mans', '72000', '2129261874425', null, '1970-02-20', 'Clermont-Ferrand'),
    ('U','Ethan', 'Roche', 'H', '232 Avenue du Vent', 'Aix-en-Provence', '13090', '2876334829230', null, '2001-01-03', 'Nanterre'),
    ('U','Rose', 'Caron', 'F', '343 Boulevard de la Rivière', 'Brest', '29200', '2529273176741', null, '1986-05-15', 'Reims'),
    ('U','Noah', 'Leroux', 'H', '454 Chemin des Vallées', 'Levallois-Perret', '92300', '2977494214974', 1, '1952-11-28', 'Lorient'),
    ('U','Anaïs', 'Brun', 'F', '565 Rue des Forêts', 'Caen', '14000', '2636024562113', 2, '1997-09-12', 'Perpignan'),
    ('U','Léo', 'Durand', 'H', '676 Avenue des Rêves', 'Clermont-Ferrand', '63000', '2757531699978', 3, '1963-04-05', 'Angers'),
    ('U','Lina', 'Lemoine', 'F', '787 Boulevard des Cieux', 'Amiens', '80000', '2936798001954', 4, '2006-07-18', 'Montpellier'),
    ('U','Enzo', 'Dupuis', 'H', '898 Allée des Merveilles', 'Limoges', '87000', '2407663346500', 5, '1975-10-30', 'Calais'),
    ('U','Eléna', 'Renault', 'F', '909 Rue des Sources', 'Tours', '37000', '2769351946314', 6, '1993-02-12', 'Avignon'),
    ('U','Axel', 'Henry', 'H', '123 Avenue des Monts', 'Metz', '57000', '2008434259991', 7, '1940-05-25', 'Toulouse'),
    ('U','Tom', 'Dubois', 'H', '345 Chemin des Gorges', 'Besançon', '25000', '2585471417258', 8, '1976-09-05', 'Caen'),
    ('U','Manon', 'Guillaume', 'F', '456 Rue des Rochers', 'Perpignan', '66000', '2922594628321', 1, '2000-12-18', 'Nantes'),
    ('U','Mattéo', 'Lefevre', 'H', '567 Allée des Prairies', 'Orléans', '45000', '2838339055427', 2, '1958-04-10', 'Lille'),
    ('U','Capucine', 'Robin', 'F', '678 Boulevard des Chutes', 'Mulhouse', '68100', '2984292917364', 3, '2009-07-22', 'Rennes'),
    ('U','Nolan', 'Roy', 'H', '789 Chemin des Cascades', 'Rouen', '76000', '2717180191606', 4, '1983-11-02', 'Dijon'),
    ('U','Zoé', 'Leclerc', 'F', '890 Rue des Collines', 'Saint-Denis', '93200', '2025269366256', 5, '1966-02-15', 'Fort-de-France'),
    ('U','Eliott', 'Guérin', 'H', '901 Avenue des Marais', 'Avignon', '84000', '2509637326720', 6, '1998-05-30', 'Nice'),
    ('U','Inaya', 'Renard', 'F', '112 Boulevard des Dunes', 'Nancy', '54000', '2226965274312', 7, '1948-09-10', 'Mulhouse'),
    ('U','Timéo', 'Lefort', 'H', '223 Allée des Baies', 'Lorient', '56100', '2837751965619', 8, '1971-12-22', 'La Rochelle'),
    ('U','Lilas', 'Picard', 'F', '334 Rue des Plaines', 'Nanterre', '92000', '2984275984680', null, '2002-04-15', 'Orléans'),
    ('U','Maxime', 'Vincent', 'H', '445 Chemin des Plages', 'Pau', '64000', '2427180019726', null, '1950-07-28', 'Nancy'),
    ('U','Maëlle', 'Martin', 'F', '556 Avenue des Côtes', 'La Rochelle', '17000', '2714482308148', null, '1996-11-08', 'Lyon'),
    ('U','Evan', 'Perrin', 'H', '667 Boulevard des Vagues', 'Champigny-sur-Marne', '94500', '2206333967296', null, '1969-02-20', 'Marseille'),
    ('U','Thaïs', 'Deschamps', 'F', '778 Allée des Falaises', 'Saint-Maur-des-Fossés', '94100', '2627786628243', null, '2007-06-02', 'Paris'),
    ('U','Ethan', 'Gérard', 'H', '889 Rue des Sables', 'Antibes', '06600', '2092493560073', null, '1977-09-15', 'Levallois-Perret'),
    ('U','Mia', 'Roussel', 'F', '900 Chemin des Grèves', 'Calais', '62100', '2977799304615', null, '1942-01-25', 'Antibes'),
    ('U','Victor', 'Barbier', 'H', '111 Rue des Horizons', 'Courbevoie', '92400', '2445632648406', null, '1994-05-08', 'Rouen');

    INSERT INTO rendez_vous(idUsager , idMedecin , date_rendez_vous , heure_rendez_vous)
VALUES 
    (25,7,'2023-10-15','09:30:00'), 
    (16,1,'2023-05-20','12:00:00'), 
    (39,8,'2024-08-02','11:00:00'), 
    (27,4,'2023-12-08','13:30:00'), 
    (40,5,'2023-04-18','08:30:00'),
    (10,2,'2024-03-07','16:30:00'), 
    (13,7,'2023-09-22','15:00:00'), 
    (36,1,'2023-11-30','09:30:00'), 
    (46,6,'2024-05-11','14:30:00'), 
    (43,8,'2023-06-14','18:00:00'),
    (31,5,'2024-09-05','10:00:00'), 
    (15,2,'2024-12-01','07:00:00'), 
    (33,1,'2023-11-18','17:00:00'), 
    (23,7,'2024-06-10','08:00:00'), 
    (45,4,'2024-01-27','14:00:00'),
    (30,6,'2024-04-03','13:30:00'), 
    (17,3,'2023-08-12','08:30:00'), 
    (11,2,'2023-02-21','14:00:00'), 
    (21,5,'2023-09-16','16:00:00'), 
    (26,3,'2024-08-31','10:00:00'),
    (12,8,'2024-11-14','07:00:00'),
    (14,1,'2023-03-25','11:30:00'), 
    (35,7,'2024-07-09','14:30:00'), 
    (19,5,'2023-12-02','16:00:00'), 
    (32,2,'2023-03-30','13:00:00'),
    (28,8,'2023-01-15','15:30:00'), 
    (24,1,'2024-06-06','17:30:00'), 
    (44,7,'2024-05-05','07:30:00'), 
    (48,6,'2023-07-20','14:00:00'), 
    (9,4,'2023-10-29','10:30:00'),
    (22,7,'2024-01-03','15:30:00'), 
    (41,5,'2023-06-19','13:00:00'), 
    (42,3,'2023-12-08','08:00:00'), 
    (29,1,'2023-05-15','15:00:00'), 
    (47,8,'2023-08-22','14:30:00'),
    (38,5,'2024-11-10','12:30:00'), 
    (34,6,'2024-10-17','07:30:00'), 
    (20,3,'2024-02-04','13:00:00'), 
    (37,2,'2024-08-12','08:30:00'), 
    (18,7,'2023-09-30','11:30:00'),
    (16,3,'2023-05-15','11:00:00'), 
    (45,5,'2023-08-25','10:00:00'), 
    (13,1,'2023-12-18','07:30:00'),
    (22,4,'2024-09-14','14:00:00'), 
    (11,7,'2023-01-22','12:30:00'), 
    (31,8,'2023-03-10','09:30:00'), 
    (9,2,'2024-06-01','08:00:00'), 
    (29,4,'2024-12-30','17:00:00'),
    (44,6,'2024-11-01','14:30:00'), 
    (38,3,'2023-12-10','10:00:00'), 
    (27,7,'2023-02-07','09:00:00'), 
    (21,6,'2024-04-06','16:30:00'),
    (10,4,'2024-03-18','08:30:00'), 
    (30,5,'2023-11-09','14:00:00'), 
    (46,8,'2023-11-12','15:30:00'), 
    (39,2,'2023-07-28','13:00:00'), 
    (20,1,'2023-10-05','12:00:00'),
    (35,6,'2023-10-21','11:30:00'), 
    (28,2,'2024-05-25','16:00:00'), 
    (15,1,'2023-09-16','14:00:00'), 
    (24,8,'2024-02-14','11:00:00'),
    (47,3,'2024-11-02','07:30:00'), 
    (12,3,'2024-03-29','16:30:00'), 
    (26,8,'2023-07-04','08:00:00'), 
    (33,1,'2023-08-07','15:30:00'),
    (14,7,'2024-09-17','10:30:00'), 
    (37,6,'2023-12-02','11:00:00'), 
    (43,4,'2023-11-12','17:30:00'), 
    (36,2,'2023-03-06','12:30:00'), 
    (19,8,'2024-12-27','10:00:00'),
    (25,5,'2024-02-08','09:30:00'), 
    (42,1,'2024-07-31','10:30:00'), 
    (17,6,'2023-10-14','08:00:00'), 
    (34,5,'2024-02-09','15:30:00'),
    (23,2,'2024-06-23','15:00:00'), 
    (18,1,'2023-11-30','08:30:00'), 
    (40,8,'2023-06-15','13:00:00'), 
    (49,4,'2023-03-12','15:30:00'), 
    (10,3,'2024-12-13','16:00:00'), 
    (14,5,'2023-05-01','09:30:00'),
    (37,6,'2023-01-07','15:00:00'), 
    (28,2,'2023-10-16','12:30:00'), 
    (41,7,'2024-10-11','10:00:00'), 
    (18,1,'2023-01-05','08:30:00'), 
    (45,2,'2024-11-24','10:30:00'), 
    (22,4,'2023-07-03','15:00:00'), 
    (27,3,'2023-03-14','12:30:00'), 
    (9,7,'2024-08-05','16:00:00'), 
    (32,1,'2023-10-09','09:30:00'),
    (16,3,'2023-05-19','14:00:00'), 
    (48,2,'2023-06-06','13:30:00'), 
    (26,1,'2023-07-20','09:00:00'), 
    (42,8,'2023-02-14','17:00:00'),
    (19,7,'2024-12-18','15:30:00'),
    (12,6,'2023-08-25','14:00:00'), 
    (35,5,'2024-11-14','07:30:00'), 
    (21,3,'2023-08-05','08:30:00'), 
    (28,8,'2023-10-11','16:00:00'),
    (37,3,'2024-03-29','08:00:00'), 
    (23,4,'2023-03-06','11:30:00'), 
    (44,1,'2023-09-09','07:00:00'), 
    (16,5,'2024-10-05','12:00:00'),
    (33,8,'2023-02-18','11:30:00'), 
    (10,7,'2023-12-22','08:00:00'), 
    (26,3,'2024-04-18','16:30:00'), 
    (15,2,'2024-07-15','14:30:00'),
    (34,7,'2023-08-12','16:00:00'), 
    (46,4,'2024-04-24','13:30:00'), 
    (31,6,'2024-02-07','07:30:00'), 
    (38,1,'2023-10-16','16:00:00'), 
    (11,3,'2023-11-30','12:30:00'),
    (44,2,'2023-02-01','14:00:00'), 
    (27,8,'2024-07-08','11:00:00'),
    (13,5,'2023-09-06','09:30:00'), 
    (23,1,'2023-07-13','14:00:00'), 
    (45,6,'2023-09-01','07:30:00'),
    (21,8,'2023-04-25','12:30:00'), 
    (30,2,'2024-08-10','16:00:00'), 
    (17,1,'2024-05-03','10:30:00'), 
    (9,6,'2024-12-20','13:00:00'), 
    (36,5,'2023-09-13','15:30:00'),
    (41,4,'2023-12-15','11:00:00'), 
    (19,2,'2024-09-07','08:30:00'), 
    (42,6,'2023-11-27','14:30:00'), 
    (28,1,'2023-05-24','08:00:00'), 
    (24,5,'2024-10-20','10:30:00'),
    (44,3,'2023-01-09','09:00:00'), 
    (38,8,'2024-01-28','17:30:00'),  
    (15,7,'2023-02-16','16:00:00'), 
    (47,1,'2023-12-11','11:30:00'), 
    (12,5,'2023-08-21','14:30:00'), 
    (26,7,'2024-08-28','08:00:00'),
    (33,3,'2023-09-28','08:30:00'), 
    (14,8,'2023-01-13','09:00:00'),
    (37,4,'2024-06-09','16:30:00');







