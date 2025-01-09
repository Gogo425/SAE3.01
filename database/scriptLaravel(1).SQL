DROP DATABASE IF EXISTS scriptLaravel;

CREATE DATABASE IF NOT EXISTS scriptLaravel;
USE scriptLaravel;
# -----------------------------------------------------------------------------
#       TABLE : LEVELS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LEVELS
 (
   ID INTEGER NOT NULL  ,
   DESCRIPTION CHAR(32) NOT NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : SKILLS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SKILLS
 (
   ID INTEGER NOT NULL  ,
   ID_BELONG INTEGER NOT NULL  ,
   DESCRIPTION CHAR(32) NOT NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE SKILLS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_SKILLS_LEVELS
     ON SKILLS (ID_BELONG ASC);

# -----------------------------------------------------------------------------
#       TABLE : SESSIONS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SESSIONS
 (
   ID INTEGER NOT NULL  ,
   ID_LOCATE INTEGER NOT NULL  ,
   ID_INITIATE INTEGER NOT NULL  ,
   DATE_SESSION DATE NOT NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE SESSIONS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_SESSIONS_LOCATIONS
     ON SESSIONS (ID_LOCATE ASC);

CREATE  INDEX I_FK_SESSIONS_FORMATIONS
     ON SESSIONS (ID_INITIATE ASC);

# -----------------------------------------------------------------------------
#       TABLE : FORMATIONS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FORMATIONS
 (
   ID INTEGER NOT NULL  ,
   ID_ASSOCIATE INTEGER NOT NULL  ,
   ID_USERTYPE INTEGER NOT NULL  ,
   DATE_BEGINNING DATE NULL  ,
   DATE_ENDING DATE NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FORMATIONS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FORMATIONS_LEVELS
     ON FORMATIONS (ID_ASSOCIATE ASC);

CREATE  INDEX I_FK_FORMATIONS_TRAINING_MANAGERS
     ON FORMATIONS (ID_USERTYPE ASC);

# -----------------------------------------------------------------------------
#       TABLE : INITIATORS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INITIATORS
 (
   ID_USERTYPE INTEGER NOT NULL  ,
   ID INTEGER NOT NULL  
   , PRIMARY KEY (ID_USERTYPE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE INITIATORS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_INITIATORS_LEVELS
     ON INITIATORS (ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : PERSONS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PERSONS
 (
   ID INTEGER NOT NULL  ,
   NAME CHAR(32) NOT NULL  ,
   SURNAME CHAR(32) NOT NULL  ,
   PASSWORD CHAR(32) NOT NULL  ,
   MAIL_ADRESS CHAR(32) NOT NULL  ,
   LICENCE_NUMBER CHAR(32) NOT NULL  ,
   MEDICAL_CERTIFICATE_DATE DATE NOT NULL  ,
   BIRTH_DATE CHAR(32) NOT NULL  ,
   ADRESS CHAR(32) NOT NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : STUDENTS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS STUDENTS
 (
   ID_USERTYPE INTEGER NOT NULL  ,
   ID INTEGER NOT NULL  ,
   ID_LEARN INTEGER NOT NULL  
   , PRIMARY KEY (ID_USERTYPE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE STUDENTS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_STUDENTS_LEVELS
     ON STUDENTS (ID ASC);

CREATE  INDEX I_FK_STUDENTS_FORMATIONS
     ON STUDENTS (ID_LEARN ASC);

# -----------------------------------------------------------------------------
#       TABLE : TRAINING_MANAGERS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TRAINING_MANAGERS
 (
   ID_USERTYPE INTEGER NOT NULL  
   , PRIMARY KEY (ID_USERTYPE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : LOCATIONS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LOCATIONS
 (
   ID INTEGER NOT NULL  ,
   TYPE CHAR(32) NOT NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ABILITIES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ABILITIES
 (
   ID INTEGER NOT NULL  ,
   ID_LINKED INTEGER NOT NULL  ,
   DESCRIPTION CHAR(32) NOT NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ABILITIES
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ABILITIES_SKILLS
     ON ABILITIES (ID_LINKED ASC);

# -----------------------------------------------------------------------------
#       TABLE : STATUS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS STATUS
 (
   ID CHAR(32) NOT NULL  ,
   DESCRIPTION CHAR(32) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : TECHNICAL_DIRECTORS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TECHNICAL_DIRECTORS
 (
   ID_USERTYPE INTEGER NOT NULL  
   , PRIMARY KEY (ID_USERTYPE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : EVALUATIONS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EVALUATIONS
 (
   ID INTEGER NOT NULL  ,
   ID_1 INTEGER NOT NULL  ,
   ID_USERTYPE INTEGER NOT NULL  ,
   ID_USERTYPE_1 INTEGER NOT NULL  ,
   ID_2 CHAR(32) NOT NULL  ,
   OBSERVATIONS CHAR(32) NULL  
   , PRIMARY KEY (ID,ID_1,ID_USERTYPE,ID_USERTYPE_1,ID_2) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE EVALUATIONS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_EVALUATIONS_SESSIONS
     ON EVALUATIONS (ID ASC);

CREATE  INDEX I_FK_EVALUATIONS_ABILITIES
     ON EVALUATIONS (ID_1 ASC);

CREATE  INDEX I_FK_EVALUATIONS_INITIATORS
     ON EVALUATIONS (ID_USERTYPE ASC);

CREATE  INDEX I_FK_EVALUATIONS_STUDENTS
     ON EVALUATIONS (ID_USERTYPE_1 ASC);

CREATE  INDEX I_FK_EVALUATIONS_STATUS
     ON EVALUATIONS (ID_2 ASC);

# -----------------------------------------------------------------------------
#       TABLE : WORKS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS WORKS
 (
   ID INTEGER NOT NULL  ,
   ID_1 INTEGER NOT NULL  ,
   ID_USERTYPE INTEGER NOT NULL  
   , PRIMARY KEY (ID,ID_1,ID_USERTYPE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE WORKS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_WORKS_SESSIONS
     ON WORKS (ID ASC);

CREATE  INDEX I_FK_WORKS_ABILITIES
     ON WORKS (ID_1 ASC);

CREATE  INDEX I_FK_WORKS_STUDENTS
     ON WORKS (ID_USERTYPE ASC);

# -----------------------------------------------------------------------------
#       TABLE : TRAINS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TRAINS
 (
   ID_USERTYPE INTEGER NOT NULL  ,
   ID INTEGER NOT NULL  
   , PRIMARY KEY (ID_USERTYPE,ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE TRAINS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_TRAINS_INITIATORS
     ON TRAINS (ID_USERTYPE ASC);

CREATE  INDEX I_FK_TRAINS_FORMATIONS
     ON TRAINS (ID ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE SKILLS 
  ADD FOREIGN KEY FK_SKILLS_LEVELS (ID_BELONG)
      REFERENCES LEVELS (ID) ;


ALTER TABLE SESSIONS 
  ADD FOREIGN KEY FK_SESSIONS_LOCATIONS (ID_LOCATE)
      REFERENCES LOCATIONS (ID) ;


ALTER TABLE SESSIONS 
  ADD FOREIGN KEY FK_SESSIONS_FORMATIONS (ID_INITIATE)
      REFERENCES FORMATIONS (ID) ;


ALTER TABLE FORMATIONS 
  ADD FOREIGN KEY FK_FORMATIONS_LEVELS (ID_ASSOCIATE)
      REFERENCES LEVELS (ID) ;


ALTER TABLE FORMATIONS 
  ADD FOREIGN KEY FK_FORMATIONS_TRAINING_MANAGERS (ID_USERTYPE)
      REFERENCES TRAINING_MANAGERS (ID_USERTYPE) ;


ALTER TABLE INITIATORS 
  ADD FOREIGN KEY FK_INITIATORS_LEVELS (ID)
      REFERENCES LEVELS (ID) ;


ALTER TABLE INITIATORS 
  ADD FOREIGN KEY FK_INITIATORS_PERSONS (ID_USERTYPE)
      REFERENCES PERSONS (ID) ;


ALTER TABLE STUDENTS 
  ADD FOREIGN KEY FK_STUDENTS_LEVELS (ID)
      REFERENCES LEVELS (ID) ;


ALTER TABLE STUDENTS 
  ADD FOREIGN KEY FK_STUDENTS_FORMATIONS (ID_LEARN)
      REFERENCES FORMATIONS (ID) ;


ALTER TABLE STUDENTS 
  ADD FOREIGN KEY FK_STUDENTS_PERSONS (ID_USERTYPE)
      REFERENCES PERSONS (ID) ;


ALTER TABLE TRAINING_MANAGERS 
  ADD FOREIGN KEY FK_TRAINING_MANAGERS_INITIATORS (ID_USERTYPE)
      REFERENCES INITIATORS (ID_USERTYPE) ;


ALTER TABLE ABILITIES 
  ADD FOREIGN KEY FK_ABILITIES_SKILLS (ID_LINKED)
      REFERENCES SKILLS (ID) ;


ALTER TABLE TECHNICAL_DIRECTORS 
  ADD FOREIGN KEY FK_TECHNICAL_DIRECTORS_INITIATORS (ID_USERTYPE)
      REFERENCES INITIATORS (ID_USERTYPE) ;


ALTER TABLE EVALUATIONS 
  ADD FOREIGN KEY FK_EVALUATIONS_SESSIONS (ID)
      REFERENCES SESSIONS (ID) ;


ALTER TABLE EVALUATIONS 
  ADD FOREIGN KEY FK_EVALUATIONS_ABILITIES (ID_1)
      REFERENCES ABILITIES (ID) ;


ALTER TABLE EVALUATIONS 
  ADD FOREIGN KEY FK_EVALUATIONS_INITIATORS (ID_USERTYPE)
      REFERENCES INITIATORS (ID_USERTYPE) ;


ALTER TABLE EVALUATIONS 
  ADD FOREIGN KEY FK_EVALUATIONS_STUDENTS (ID_USERTYPE_1)
      REFERENCES STUDENTS (ID_USERTYPE) ;


ALTER TABLE EVALUATIONS 
  ADD FOREIGN KEY FK_EVALUATIONS_STATUS (ID_2)
      REFERENCES STATUS (ID) ;


ALTER TABLE WORKS 
  ADD FOREIGN KEY FK_WORKS_SESSIONS (ID)
      REFERENCES SESSIONS (ID) ;


ALTER TABLE WORKS 
  ADD FOREIGN KEY FK_WORKS_ABILITIES (ID_1)
      REFERENCES ABILITIES (ID) ;


ALTER TABLE WORKS 
  ADD FOREIGN KEY FK_WORKS_STUDENTS (ID_USERTYPE)
      REFERENCES STUDENTS (ID_USERTYPE) ;


ALTER TABLE TRAINS 
  ADD FOREIGN KEY FK_TRAINS_INITIATORS (ID_USERTYPE)
      REFERENCES INITIATORS (ID_USERTYPE) ;


ALTER TABLE TRAINS 
  ADD FOREIGN KEY FK_TRAINS_FORMATIONS (ID)
      REFERENCES FORMATIONS (ID) ;

