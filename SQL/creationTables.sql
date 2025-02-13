-- SUPPRIMER LES TABLES
DROP TABLE IF EXISTS Utilisateur, Departement, Utilisateur_Departement, TypesBrochure, HistoriqueDemande, Demande;


-- CREATION DES TABLES

-- Utilisateura
CREATE TABLE Utilisateur (
    id_utilisateur INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    numTel VARCHAR(50) UNIQUE NOT NULL,
    role VARCHAR(50) NOT NULL
);

-- Departement
CREATE TABLE Departement (
    id_departement INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

-- Utilisateur_Departement
CREATE TABLE Utilisateur_Departement (
    id_utilisateur INT,
    id_departement INT,
    PRIMARY KEY (id_utilisateur, id_departement),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_departement) REFERENCES Departement(id_departement) ON DELETE CASCADE
);

CREATE TABLE TypesBrochure (
    id_typeBrochure INT PRIMARY KEY,
    nomBrochure VARCHAR(255) NOT NULL
);

-- Demande
CREATE TABLE Demande (
    id_demande INT PRIMARY KEY AUTO_INCREMENT,
    examen INT NOT NULL,
    nb_pages INT NOT NULL,
    nb_copies INT NOT NULL,
    format_feuille VARCHAR(255) NOT NULL,
    agrafes BOOLEAN NOT NULL,
    nb_pages_par_copies INT NOT NULL,
    date_demande DATE NOT NULL,
    couverture_couleur VARCHAR(255),
    page_fin_couleur VARCHAR(255),
    type_finition VARCHAR(255),
    type_perforation VARCHAR(255),
    statut VARCHAR(255) NOT NULL,
    commentaire TEXT,
    fichier VARCHAR(255), -- chemin vers le fichier (peut-être un path complet)
    id_utilisateur INT,
    id_departement INT,
    id_typeBrochure INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur) ON DELETE SET NULL,
    FOREIGN KEY (id_departement) REFERENCES Departement(id_departement) ON DELETE SET NULL,
    FOREIGN KEY (id_typeBrochure) REFERENCES TypesBrochure(id_typeBrochure) ON DELETE SET NULL
);

-- HistoriqueDemande
CREATE TABLE HistoriqueDemande (
    id_historiqueDemande INT PRIMARY KEY,
    terminee_le DATE NOT NULL, -- Date de finalisation de la demande
    status_final VARCHAR(255) NOT NULL,
    id_demande INT,
    FOREIGN KEY (id_demande) REFERENCES Demande(id_demande) ON DELETE CASCADE
);
