<?php
session_start(); //Démarre une nouvelle session ou restaure une session existante
session_unset(); // Efface toutes les données de la session
session_destroy(); //Détruit la session courante
header('location:login.php'); //Redirige l'utilisateur vers la page de connexion login.php

?>