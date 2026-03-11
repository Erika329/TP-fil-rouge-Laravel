USE ticketing_db;

INSERT INTO clients (nom, email) VALUES
('Agence Nova', 'contact@agencenova.fr'),
('Tech Corp', 'contact@techcorp.fr');

INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe, role) VALUES
('Erika', 'Kamdom', 'erika@exemple.fr', 'password123', 'collaborateur'),
('Admin', 'System', 'admin@exemple.fr', 'password123', 'admin');

INSERT INTO projets (nom, client_id, contrat, taux, statut) VALUES
('Portail client', 1, 'forfait', 500.00, 'actif'),
('Intranet RH', 2, 'regie', 650.00, 'en-attente');

INSERT INTO tickets (titre, description, projet_id, priorite, type, estimation, assignes, statut) VALUES
('Bug formulaire contact', 'Le formulaire ne s envoie pas', 1, 'haute', 'inclus', 2.00, 'Erika', 'nouveau'),
('Ajout export PDF', 'Ajouter un bouton export PDF', 1, 'moyenne', 'facturable', 4.00, 'Erika', 'en-cours'),
('Mise a jour logo', 'Changer le logo sur toutes les pages', 2, 'basse', 'inclus', 1.00, 'Erika', 'termine');