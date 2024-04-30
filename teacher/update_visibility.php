<?php
session_start();
include('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assignmentId = $_POST['id'];
    $visible = $_POST['visible'];

    $sql = "UPDATE tblassigment SET visible = :visible WHERE ID = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':visible', $visible, PDO::PARAM_INT);
    $stmt->bindParam(':id', $assignmentId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Visibilité changé avec succès";
    } else {
        echo "erreue lors du changement du visibilité";
    }
}