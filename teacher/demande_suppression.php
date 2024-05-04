<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocastid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $message = $_POST['message'];

        $sql = "INSERT INTO demandes_suppression (email, message, statut) VALUES (:email, :message, 'en_attente')";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Votre demande de suppression a été envoyée.")</script>';
        echo "<script>window.location.href ='demande_suppression.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ensaté-Hub : Demande de Suppression de Compte</title>
    <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include_once('includes/sidebar.php'); ?>
    <?php include_once('includes/header.php'); ?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- Contenu de la page -->
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4>Formulaire de Demande de Suppression de Compte</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea class="form-control" name="message" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default" name="submit">Envoyer la Demande</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include_once('includes/footer.php'); ?>
                </section>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="../assets/js/lib/jquery.min.js"></script>
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>
<?php } ?>
