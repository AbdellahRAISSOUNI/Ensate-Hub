<?php
session_start();
include('includes/dbconnection.php');

if (isset($_POST['comment']) && isset($_POST['post_id'])) {
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['ocasuid'];
    $user_type = 'student';

    $sql = "INSERT INTO tblcomments (user_id, post_id, comment, user_type) VALUES (:user_id, :post_id, :comment, :user_type)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $query->bindParam(':comment', $comment, PDO::PARAM_STR);
    $query->bindParam(':user_type', $user_type, PDO::PARAM_STR);

    if ($query->execute()) {
        echo "Commentaire envoyé avec succes.";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Erreur lors de l'nvoi de commentaire.";
    }
}
?>