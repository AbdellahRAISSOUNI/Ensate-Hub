# Guide d'exécution du Projet de Système de Devoirs en Ligne avec PHP et MySQL

## Instructions

1. **Téléchargement**: Téléchargez le fichier zip.
2. **Extraction**: Extrayez le fichier et copiez le dossier `ocas`.
3. **Placement**: Collez le dossier `ocas` dans le répertoire racine (pour XAMPP : `xampp/htdocs`, pour WAMP : `wamp/www`, pour LAMP : `var/www/html`).
4. **Configuration de la base de données**:
    - Ouvrez PHPMyAdmin (http://localhost/phpmyadmin).
    - Créez une nouvelle base de données nommée `ocasdb`.
    - Importez le fichier `ocasdb.sql` (fourni dans le dossier SQL du package zip).
5. **Exécution du script**: Accédez au script via http://localhost/ocas.

## Identifiants

- **Administrateur**:
    - Nom d'utilisateur : `admin`
    - Mot de passe : `Test@123`
- **Enseignant**:
    - Nom d'utilisateur : `EMP12345`
    - Mot de passe : `Test@123`
    - *Ou* inscrivez un nouvel enseignant via le panneau d'administration.
- **Utilisateur**:
    - Nom d'utilisateur : `test@gmail.com`
    - Mot de passe : `Test@123`
    - *Ou* inscrivez un nouvel utilisateur.
