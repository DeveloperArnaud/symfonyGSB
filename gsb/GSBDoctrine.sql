DROP DATABASE IF EXISTS MLR1;

CREATE DATABASE IF NOT EXISTS MLR1;
USE MLR1;
# -----------------------------------------------------------------------------
#       TABLE : FRAISFORFAIT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FRAISFORFAIT
 (
   ID VARCHAR(128) NOT NULL  ,
   LIBELLE VARCHAR(255) NULL  ,
   MONTANT DECIMAL(10,2) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : LIGNEFRAISFORFAIT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LIGNEFRAISFORFAIT
 (
   ID SMALLINT NOT NULL  ,
   ID_CONCERNER VARCHAR(128) NOT NULL  ,
   ID_ETRE SMALLINT NOT NULL  ,
   QUANTITE BIGINT(4) NULL  ,
   DATEMODIFICATION DATE NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LIGNEFRAISFORFAIT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LIGNEFRAISFORFAIT_FRAISFORFAIT
     ON LIGNEFRAISFORFAIT (ID_CONCERNER ASC);

CREATE  INDEX I_FK_LIGNEFRAISFORFAIT_ETAT
     ON LIGNEFRAISFORFAIT (ID_ETRE ASC);

# -----------------------------------------------------------------------------
#       TABLE : COMPTABLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPTABLE
 (
   ID INTEGER NOT NULL  ,
   NOMCOMPTABLE VARCHAR(128) NULL  ,
   PRENOMCOMPTABLE VARCHAR(128) NULL  ,
   LOGINCOMPTABLE VARCHAR(128) NULL  ,
   MDPCOMPTABLE VARCHAR(128) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : VISITEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VISITEUR
 (
   ID VARCHAR(128) NOT NULL  ,
   ID_GERER INTEGER NOT NULL  ,
   NOMVISITEUR VARCHAR(128) NULL  ,
   PRENOMVISITEUR VARCHAR(128) NULL  ,
   LOGINVISITEUR VARCHAR(128) NULL  ,
   MDPVISITEUR VARCHAR(128) NULL  ,
   ADRVISITEUR VARCHAR(128) NULL  ,
   CPVISITEUR CHAR(5) NULL  ,
   VILLEVISITEUR VARCHAR(128) NULL  ,
   DATEEMBAUCHE DATE NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE VISITEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_VISITEUR_COMPTABLE
     ON VISITEUR (ID_GERER ASC);

# -----------------------------------------------------------------------------
#       TABLE : ETAT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ETAT
 (
   ID SMALLINT NOT NULL  ,
   LIBELLE VARCHAR(128) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : FICHEFRAIS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FICHEFRAIS
 (
   ID INTEGER NOT NULL  ,
   ID_ETRE2 SMALLINT NOT NULL  ,
   ID_DECLARER VARCHAR(128) NOT NULL  ,
   MOIS CHAR(6) NULL  ,
   NBJUSTIFICATIFS INTEGER NULL  ,
   MONTANTVALIDE DECIMAL(10,2) NULL  ,
   DATEMODIF DATE NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FICHEFRAIS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FICHEFRAIS_ETAT
     ON FICHEFRAIS (ID_ETRE2 ASC);

CREATE  INDEX I_FK_FICHEFRAIS_VISITEUR
     ON FICHEFRAIS (ID_DECLARER ASC);

# -----------------------------------------------------------------------------
#       TABLE : LIGNEFRAISHORSFORFAIT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LIGNEFRAISHORSFORFAIT
 (
   ID INTEGER NOT NULL  ,
   ID_ETRE1 SMALLINT NOT NULL  ,
   ID_1 INTEGER NOT NULL  ,
   ID_2 SMALLINT NOT NULL  ,
   ID_3 INTEGER NOT NULL  ,
   LIBELLE VARCHAR(128) NULL  ,
   DATE DATE NULL  ,
   MONTANT DECIMAL(10,2) NULL  ,
   DATEMODIF DATE NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LIGNEFRAISHORSFORFAIT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LIGNEFRAISHORSFORFAIT_ETAT
     ON LIGNEFRAISHORSFORFAIT (ID_ETRE1 ASC);

CREATE  INDEX I_FK_LIGNEFRAISHORSFORFAIT_FICHEFRAIS
     ON LIGNEFRAISHORSFORFAIT (ID_1 ASC);

CREATE  INDEX I_FK_LIGNEFRAISHORSFORFAIT_LIGNEFRAISFORFAIT
     ON LIGNEFRAISHORSFORFAIT (ID_2 ASC);

CREATE  INDEX I_FK_LIGNEFRAISHORSFORFAIT_FICHEFRAIS1
     ON LIGNEFRAISHORSFORFAIT (ID_3 ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE LIGNEFRAISFORFAIT 
  ADD FOREIGN KEY FK_LIGNEFRAISFORFAIT_FRAISFORFAIT (ID_CONCERNER)
      REFERENCES FRAISFORFAIT (ID) ;


ALTER TABLE LIGNEFRAISFORFAIT 
  ADD FOREIGN KEY FK_LIGNEFRAISFORFAIT_ETAT (ID_ETRE)
      REFERENCES ETAT (ID) ;


ALTER TABLE VISITEUR 
  ADD FOREIGN KEY FK_VISITEUR_COMPTABLE (ID_GERER)
      REFERENCES COMPTABLE (ID) ;


ALTER TABLE FICHEFRAIS 
  ADD FOREIGN KEY FK_FICHEFRAIS_ETAT (ID_ETRE2)
      REFERENCES ETAT (ID) ;


ALTER TABLE FICHEFRAIS 
  ADD FOREIGN KEY FK_FICHEFRAIS_VISITEUR (ID_DECLARER)
      REFERENCES VISITEUR (ID) ;


ALTER TABLE LIGNEFRAISHORSFORFAIT 
  ADD FOREIGN KEY FK_LIGNEFRAISHORSFORFAIT_ETAT (ID_ETRE1)
      REFERENCES ETAT (ID) ;


ALTER TABLE LIGNEFRAISHORSFORFAIT 
  ADD FOREIGN KEY FK_LIGNEFRAISHORSFORFAIT_FICHEFRAIS (ID_1)
      REFERENCES FICHEFRAIS (ID) ;


ALTER TABLE LIGNEFRAISHORSFORFAIT 
  ADD FOREIGN KEY FK_LIGNEFRAISHORSFORFAIT_LIGNEFRAISFORFAIT (ID_2)
      REFERENCES LIGNEFRAISFORFAIT (ID) ;


ALTER TABLE LIGNEFRAISHORSFORFAIT 
  ADD FOREIGN KEY FK_LIGNEFRAISHORSFORFAIT_FICHEFRAIS1 (ID_3)
      REFERENCES FICHEFRAIS (ID) ;

