-- Insertion des utilisateurs
INSERT INTO Utilisateur (id_utilisateur, nom, prenom, email, numTel, role)
VALUES 
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', "+33781579226", 'Administrateur'),
(2, 'Martin', 'Sophie', 'sophie.martin@example.com', "+33741526364", 'enseignant'),
(3, 'Durand', 'Pierre', 'pierre.durand@example.com', "+33770816729", 'responsable'),
(4, 'Bernard', 'Elise', 'elise.bernard@example.com', "+33700241936", 'responsable'),
(5, 'Robert', 'Paul', 'paul.robert@example.com', "+33767198240", 'enseignant'),
(6, 'Lefevre', 'Julie', 'julie.lefevre@example.com', "+33701023468", 'Utilisateur'),
(7, 'PARTHIPAN', 'Ahash Michel', 'michel.parthipan@edu.univ-paris13.fr', "+33781226125", "étudiant");

-- Insertion des départements
INSERT INTO Departement (id_departement, nom)
VALUES 
(1, 'INFO'), -- Informatique
(2, 'GEA'),  -- Gestion des Entreprises et des Administrations
(3, 'CJ'),   -- Carrières Juridiques
(4, 'SD'),   -- Sciences du Développement
(5, 'GEII'), -- Génie Électrique et Informatique Industrielle
(6, 'RT');   -- Réseaux et Télécommunications

-- Insertion des relations Utilisateur_Departement
INSERT INTO Utilisateur_Departement (id_utilisateur, id_departement)
VALUES 
(1, 1), -- Jean Dupont est dans le département INFO
(1, 5), -- Jean Dupont est également dans le département GEII
(2, 2), -- Sophie Martin est dans le département GEA
(3, 3), -- Pierre Durand est dans le département CJ
(4, 4), -- Elise Bernard est dans le département SD
(4, 6), -- Elise Bernard est également dans le département RT
(5, 5), -- Paul Robert est dans le département GEII
(6, 6), -- Julie Lefevre est dans le département RT
(7,1), -- Je suis dans INFO
(7,3), -- CJ
(7,4); -- SD

-- Insertion des types de brochures
INSERT INTO TypesBrochure (id_typeBrochure, nomBrochure)
VALUES 
(1, 'Recto'),
(2, 'Recto-Verso'),
(3, 'Livret'),
(4, 'Cahier');

-- Insertion des demandes
/*
INSERT INTO Demande (id_demande, examen, nb_pages, nb_copies, agrafes, format_feuille, couverture_couleur, page_fin_couleur, nb_pages_par_copies, date_demande, status, commentaire, fichier, id_utilisateur, id_departement, id_typeBrochure)
VALUES 
(1, FALSE, 15, 40, TRUE, 'A4', TRUE, FALSE, 15, '2025-02-01', 'Non traitée', 'Brochure évènement', 'brochure1.pdf', 1, 1, 2), -- Jean Dupont (INFO)
(2, FALSE, 8, 80, FALSE, 'A5', FALSE, TRUE, 8, '2025-02-02', 'En cours', 'Brochure pour GEA', 'brochure2.pdf', 2, 2, 4), -- Sophie Martin (GEA)
(3, TRUE, 25, 50, TRUE, 'A3', TRUE, TRUE, 25, '2025-02-03', 'Terminée', 'Mémoire de recherche terminé', 'brochure3.pdf', 3, 3, 2), -- Pierre Durand (CJ)
(4, TRUE, 10, 60, TRUE, 'A4', TRUE, TRUE, 10, '2025-02-03', 'Terminée', 'Plaquette de formation SD', 'brochure4.pdf', 4, 4, 4), -- Elise Bernard (SD)
(5, FALSE, 5, 100, TRUE, 'A5', TRUE, FALSE, 5, '2025-02-03', 'En cours', 'Fiche technique en attente', 'brochure5.pdf', 5, 5, 3), -- Paul Robert (GEII)
(6, FALSE, 12, 70, TRUE, 'A4', TRUE, TRUE, 12, '2025-02-04', 'Non traitée', 'Rapport de stage RT', 'brochure6.pdf', 6, 6, 4), -- Julie Lefevre (RT)
(7, TRUE, 20, 50, TRUE, 'A4', TRUE, FALSE, 20, '2025-02-05', 'Non traitée', 'Projet étude finalisé', 'projet_final.pdf', 1, 3, 2),
(8, TRUE, 30, 120, TRUE, 'A5', TRUE, TRUE, 30, '2025-02-05', 'En cours', 'Rapport semestriel', 'rapport_semestriel.pdf', 2, 2, 4);


-- Insertion dans l'historique des demandes
INSERT INTO HistoriqueDemande (id_historiqueDemande, terminee_le, status_final, id_demande)
VALUES 
(1, '2025-02-03', 'Terminée', 1),
(2, '2025-02-04', 'Terminée', 2),
(3, '2025-02-05', 'Terminée', 3),
(4, '2025-02-05', 'Terminée', 4),
(5, '2025-02-06', 'Terminée', 2),
(6, '2025-02-06', 'Terminée', 1);
*/