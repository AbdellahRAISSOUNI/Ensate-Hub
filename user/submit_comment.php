<?php
session_start();// Démarrer la session
include('includes/dbconnection.php');// Inclure le fichier de connexion à la base de données

// Vérifier si les données du formulaire ont été soumises
if (isset($_POST['comment']) && isset($_POST['post_id'])) {
    // Récupérer le commentaire et l'ID de la publication
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    // Récupérer l'ID de l'utilisateur à partir de la session
    $user_id = $_SESSION['ocasuid'];
    // Définir le type d'utilisateur
    $user_type = 'student';

    // Requête pour insérer le commentaire dans la base de données
    $sql = "INSERT INTO tblcomments (user_id, post_id, comment, user_type) VALUES (:user_id, :post_id, :comment, :user_type)";
    $query = $dbh->prepare($sql);
    // Liaison des paramètres avec les valeurs
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $query->bindParam(':comment', $comment, PDO::PARAM_STR);
    $query->bindParam(':user_type', $user_type, PDO::PARAM_STR);

    // Exécution de la requête
    if ($query->execute()) {
        // Afficher un message de succès si l'ajout du commentaire est réussi
        echo "Commentaire envoyé avec succes.";
        // Rediriger vers la page du tableau de bord après l'ajout du commentaire
        header("Location: dashboard.php");
        // Arrêter l'exécution du script
        exit();
    } else {
        // Afficher un message d'erreur si l'ajout du commentaire échoue
        echo "Erreur lors de l'nvoi de commentaire.";
    }
}
?>