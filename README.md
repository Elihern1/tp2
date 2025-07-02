# API de gestion des locaux et équipements

Cette API permet de gérer les locaux, les équipements, et les départements d’un collège. Elle a été développée en PHP avec une architecture MVC et utilise une base de données MySQL.

## Fonctionnalités

- CRUD pour les locaux
- CRUD pour les équipements
- Filtrer les locaux par département
- Filtrer les équipements par local

## Instructions

### 1. Exécuter le serveur
Lancer Apache et MySQL avec XAMPP. Le projet se trouve dans le dossier `htdocs/chepa-api`. Accéder à l’API via `http://localhost:8080/chepa-api/`.

### 2. Initialiser la base de données
Créer une base de données `chepa_db` dans phpMyAdmin et importer le fichier SQL avec les tables et les données initiales.

### 3. Tester les routes
Utiliser Postman pour tester les routes de type GET, POST, PUT, DELETE selon les ressources :
- `/chepa-api/locaux`
- `/chepa-api/locaux/departement/{id}`
- `/chepa-api/equipements`
- `/chepa-api/equipements/local/{id}`
