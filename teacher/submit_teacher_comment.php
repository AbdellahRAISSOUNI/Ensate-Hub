<?php
session_start();
include('includes/dbconnection.php');

if (isset($_POST['teacher_comment']) && isset($_POST['comment_id'])) {
    $teacher_comment = $_POST['teacher_comment'];
    $comment_id = $_POST['comment_id'];
    $teacher_id = $_SESSION['ocasteacherid'];
    $user_type = 'teacher';

    $sql = "INSERT INTO tblcomments (user_id, comment, parent_id, user_type) VALUES (:teacher_id, :teacher_comment, :comment_id, :user_type)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $query->bindParam(':teacher_comment', $teacher_comment, PDO::PARAM_STR);
    $query->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $query->bindParam(':user_type', $user_type, PDO::PARAM_STR);

    if ($query->execute()) {
        echo "Response submitted successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error submitting response.";
    }
}
?>