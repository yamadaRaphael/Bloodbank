DROP DATABASE IF EXISTS bloodbankdb;
CREATE DATABASE IF NOT EXISTS bloodbankdb;

use bloodbankdb;




DROP TABLE IF EXISTS BloodBank;
CREATE TABLE IF NOT EXISTS BloodBank(
   BloodTypeID INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,BloodGroup  VARCHAR(3) NOT NULL
  ,Quantity    INTEGER  NOT NULL
);
INSERT INTO BloodBank(BloodTypeID,BloodGroup,Quantity) VALUES (default,'A+',23);
INSERT INTO BloodBank(BloodTypeID,BloodGroup,Quantity) VALUES (default,'A-',23);
INSERT INTO BloodBank(BloodTypeID,BloodGroup,Quantity) VALUES (default,'B+',20);
INSERT INTO BloodBank(BloodTypeID,BloodGroup,Quantity) VALUES (default,'B-',12);
INSERT INTO BloodBank(BloodTypeID,BloodGroup,Quantity) VALUES (default,'AB+',24);
INSERT INTO BloodBank(BloodTypeID,BloodGroup,Quantity) VALUES (default,'AB-',29);
INSERT INTO BloodBank(BloodTypeID,BloodGroup,Quantity) VALUES (default,'O+',55);
INSERT INTO BloodBank(BloodTypeID,BloodGroup,Quantity) VALUES (default,'O-',21);




DROP TABLE IF EXISTS Department;
CREATE TABLE IF NOT EXISTS Department(
   DepID   INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,DepName VARCHAR(30) NOT NULL
);
INSERT INTO Department(DepID,DepName) VALUES (default,'Accident and emergency');
INSERT INTO Department(DepID,DepName) VALUES (default,'Cardiology');
INSERT INTO Department(DepID,DepName) VALUES (default,'Critical care');
INSERT INTO Department(DepID,DepName) VALUES (default,'General surgery');
INSERT INTO Department(DepID,DepName) VALUES (default,'Pain management clinics');
INSERT INTO Department(DepID,DepName) VALUES (default,'Burn Center');
INSERT INTO Department(DepID,DepName) VALUES (default,'Elderly services');
INSERT INTO Department(DepID,DepName) VALUES (default,'Haematology');
INSERT INTO Department(DepID,DepName) VALUES (default,'Intensive Care Unit');
INSERT INTO Department(DepID,DepName) VALUES (default,'Infection Control');

DROP TABLE IF EXISTS Disease;
CREATE TABLE IF NOT EXISTS Disease(
   DiseaseID INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,Name      VARCHAR(12) NOT NULL
  ,Type      VARCHAR(13) NOT NULL
  ,Status    VARCHAR(7) NOT NULL
);
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Aplastic','Anemia','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Hepatitis','Liver disease','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Type A','Hemophilia','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Allergic','Asthma','Acute');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Skin','Cancer','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Sickle cell','Anemia','Acute');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Type B','Hemophilia','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Skin','Cancer','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Hepatitis','Liver disease','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Allergic','Asthma','Acute');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Blood','Cancer','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Hemolytic','Anemia','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Allergic','Asthma','Acute');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Hepatitis','Liver disease','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Aplastic','Anemia','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Skin','Cancer','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Hemolytic','Anemia','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Allergic','Asthma','Acute');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Hepatitis','Liver disease','Chronic');
INSERT INTO Disease(DiseaseID,Name,Type,Status) VALUES (default,'Skin','Cancer','Chronic');

SET foreign_key_checks =0;

DROP TABLE IF EXISTS Patient;
CREATE TABLE IF NOT EXISTS Patient(
   PatientID   INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,DiseaseID   INTEGER  NOT NULL
  ,BloodTypeID INTEGER  NOT NULL
  ,DepID       INTEGER  NOT NULL
  ,LastName    VARCHAR(15) NOT NULL
  ,FirstName   VARCHAR(15) NOT NULL
  ,Age         INTEGER  NOT NULL
   ,FOREIGN KEY(DiseaseID) REFERENCES Disease(DiseaseID)
  ON UPDATE CASCADE ON DELETE RESTRICT
   ,FOREIGN KEY(BloodTypeID) REFERENCES BloodBank(BloodTypeID)
  ON UPDATE CASCADE ON DELETE RESTRICT
    ,FOREIGN KEY(DepID) REFERENCES Department(DepID)
  ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,11,1,1,'Jones','Mary',33);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,18,1,3,'Douglas','Sam',37);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,10,6,5,'Saint','Doug',48);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,5,7,7,'Smith','Sam',46);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,6,4,8,'Murray','Dan',23);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,20,4,9,'Scott','Haley',45);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,15,4,10,'Sawyer','Peyton',27);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,17,2,6,'Davis','Brooke',23);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,4,1,4,'Baker','Hannah',22);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,12,6,2,'Johnson','Katie',49);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,13,2,1,'Khan','Faiza',20);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,14,1,1,'Mathew','Elena',44);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,15,2,4,'Graham','Jeanne',35);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,10,8,5,'Dunlap','Haley',40);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,2,1,6,'Allison','Baran',39);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,16,7,3,'Patrick','Dolores',36);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,6,1,7,'Montoya','Tamzin',30);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,8,8,8,'Bloom','Ianis',22);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,19,7,9,'Bowes','Nicola',48);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,15,8,10,'Paine','Ella',26);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,1,3,4,'Lincoln','Andrew',21);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,3,3,3,'Reedus','Norman',56);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,7,3,2,'Yeun','Steven',54);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,9,2,6,'Smithson','Steve',34);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,11,6,8,'McBride','Mel',88);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,20,5,9,'Tawsen','Mike',19);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,19,8,10,'Riggs','Chandler',45);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,18,7,3,'Willam','Maisi',33);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,5,4,5,'Mathews','Sandra',23);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,3,5,6,'Jones','Jerson',22);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,6,3,1,'Sethi','Sabha',32);
INSERT INTO Patient(PatientID,DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES (default,2,1,2,'Yeu','Arya',20);
