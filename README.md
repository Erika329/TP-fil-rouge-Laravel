# TP Fil Rouge — Ticketing
FRONTEND + BACKEND PHP

## Projet

Une application de gestion de tickets pour une société de services.
Les clients suivent leurs demandes et valident si besoin.
Les collaborateurs créent et traitent les tickets pour les clients.

---

## Prérequis

- PHP 8.5+
- MySQL 8.0+
- MySQL Workbench (optionnel)

---

## Installation

1. Cloner le repo
2. Créer un fichier `.env` à la racine du projet :
```
DB_HOST=localhost
DB_PORT=3307
DB_NAME=ticketing_db
DB_USER=root
DB_PASSWORD=tonmotdepasse
```
3. Importer le fichier `SQL.sql` dans MySQL Workbench pour créer la base de données et les tables
4. Lancer le serveur PHP depuis la racine :
```bash
php -S localhost:8002
```

---

## Tester le projet

- Page de connexion : http://localhost:8002/src/pages/index.php
- Tableau de bord : http://localhost:8002/src/pages/dashboard.html

---

## Pages

### Authentification
- [Connexion](src/pages/index.php)
- [Inscription](src/pages/createaccount.php)
- [Mot de passe oublié](src/pages/forgot-password.php)

### Collaborateur
- [Tableau de bord](src/pages/dashboard.html)
- [Projets](src/pages/projects.php)
- [Détail d'un projet](src/pages/project%20detail.php)
- [Création / édition d'un projet](src/pages/project%20create.php)
- [Tickets](src/pages/tickets.php)
- [Détail d'un ticket](src/pages/ticket%20detail.php)
- [Création d'un ticket](src/pages/ticket%20create.php)
- [Clients](src/pages/clients.html)
- [Profil](src/pages/profile.php)
- [Paramètres](src/pages/settings.html)

### Administrateur
- [Tableau de bord admin](src/pages/dashboard-admin.html)
- [Utilisateurs](src/pages/users.html)
- [Projets admin](src/pages/projects-admin.html)
- [Tickets admin](src/pages/tickets-admin.html)
- [Clients admin](src/pages/clients-admin.html)
- [Contrats](src/pages/contracts.html)
- [Paramètres admin](src/pages/settings-admin.html)

### Client
- [Tableau de bord client](src/pages/dashboard-client.html)
- [Projets client](src/pages/projects-client.html)
- [Tickets client](src/pages/tickets-client.html)
- [Profil client](src/pages/profile-client.html)
- [Paramètres client](src/pages/settings-client.html)

---

## Base de données

La base de données `ticketing_db` contient les tables suivantes :

- `utilisateurs` — comptes utilisateurs avec rôles
- `clients` — clients associés aux projets
- `projets` — projets liés aux clients
- `tickets` — tickets liés aux projets

---

## Services PHP

Les services se trouvent dans `src/services/` :

- `TicketService.php` — remplacé par PDO direct
- `ProjectService.php` — remplacé par PDO direct

---

## Fonctionnalités PHP et SQL

- Connexion PDO sécurisée via fichier `.env`
- Authentification avec vérification en BDD et hachage du mot de passe
- Création de compte avec insertion en BDD
- Création de tickets et projets avec insertion en BDD
- Lecture et affichage des tickets et projets depuis la BDD
- Filtrage des données côté serveur via requêtes SQL
- Pages de détail dynamiques via `id` en paramètre URL
- Sécurisation des affichages avec `htmlspecialchars`
- Validation côté serveur en complément de la validation JS

---

## JavaScript

Les pages incluant du JS sont :

- [Connexion](src/pages/index.php)
- [Inscription](src/pages/createaccount.php)
- [Mot de passe oublié](src/pages/forgot-password.php)
- [Projets collaborateur](src/pages/projects.php)
- [Tickets collaborateur](src/pages/tickets.php)
- [Création / édition d'un projet](src/pages/project%20create.php)
- [Création d'un ticket](src/pages/ticket%20create.php)
- [Utilisateurs](src/pages/users.html)
- [Projets admin](src/pages/projects-admin.html)
- [Tickets admin](src/pages/tickets-admin.html)

Le nombre d'erreurs des formulaires est visible dans la console du navigateur (F12).

---

## Validation W3C

https://validator.w3.org/nu/

---

## Repo front end

La partie contenant uniquement le front end se trouve ici :
https://github.com/Erika329/TP-fil-rouge-HTML-CSS.git