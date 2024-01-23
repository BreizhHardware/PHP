------------------------------------------------------------
--        Script Postgre
------------------------------------------------------------



------------------------------------------------------------
-- Table: Patient
------------------------------------------------------------
CREATE TABLE public.Patient(
	P_ID         SERIAL NOT NULL ,
	P_Mail       VARCHAR (50) NOT NULL ,
	P_Name       VARCHAR (50) NOT NULL ,
	P_Surname    VARCHAR (50) NOT NULL ,
	P_Phone      INT  NOT NULL ,
	P_Password   VARCHAR (150) NOT NULL  ,
	CONSTRAINT Patient_PK PRIMARY KEY (P_ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Medecin
------------------------------------------------------------
CREATE TABLE public.Medecin(
	M_ID          SERIAL NOT NULL ,
	M_Mail        VARCHAR (50) NOT NULL ,
	M_Name        VARCHAR (50) NOT NULL ,
	M_Surname     VARCHAR (50) NOT NULL ,
	M_Password    VARCHAR (150) NOT NULL ,
	M_Postal      INT  NOT NULL ,
	M_Phone       INT  NOT NULL ,
	M_Specialty   VARCHAR (50) NOT NULL  ,
	CONSTRAINT Medecin_PK PRIMARY KEY (M_ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Lieu
------------------------------------------------------------
CREATE TABLE public.Lieu(
	L_Id       SERIAL NOT NULL ,
	L_Adress   VARCHAR (200) NOT NULL ,
	L_City     VARCHAR (50) NOT NULL ,
	L_Postal   INT  NOT NULL  ,
	CONSTRAINT Lieu_PK PRIMARY KEY (L_Id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Rendez-Vous
------------------------------------------------------------
CREATE TABLE public.Rendez_Vous(
	RDV_Id     SERIAL NOT NULL ,
	RDV_Date   DATE  NOT NULL ,
	RDV_Time   TIMETZ  NOT NULL ,
	P_ID       INT   ,
	L_Id       INT  NOT NULL  ,
	CONSTRAINT Rendez_Vous_PK PRIMARY KEY (RDV_Id)

	,CONSTRAINT Rendez_Vous_Patient_FK FOREIGN KEY (P_ID) REFERENCES public.Patient(P_ID)
	,CONSTRAINT Rendez_Vous_Lieu0_FK FOREIGN KEY (L_Id) REFERENCES public.Lieu(L_Id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Propose
------------------------------------------------------------
CREATE TABLE public.Propose(
	RDV_Id   INT  NOT NULL ,
	M_ID     INT  NOT NULL  ,
	CONSTRAINT Propose_PK PRIMARY KEY (RDV_Id,M_ID)

	,CONSTRAINT Propose_Rendez_Vous_FK FOREIGN KEY (RDV_Id) REFERENCES public.Rendez_Vous(RDV_Id)
	,CONSTRAINT Propose_Medecin0_FK FOREIGN KEY (M_ID) REFERENCES public.Medecin(M_ID)
)WITHOUT OIDS;