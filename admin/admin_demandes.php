<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasaid']) == 0) {
    header('location:logout.php');
} else {
    // Suppression du compte utilisateur après approbation
if (isset($_POST['approve'])) {
    $email = $_POST['email'];

    // Mettre à jour le statut de la demande en 'approuvée'
    $sql = "UPDATE demandes_suppression SET statut = 'approuvée', date_traitement = NOW() WHERE email = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    // Supprimer le compte utilisateur
    $sql = "DELETE FROM tbluser WHERE Email = :email";
    $deleteUser = $dbh->prepare($sql);
    $deleteUser->bindParam(':email', $email, PDO::PARAM_STR);
    $deleteUser->execute();

    // Vérifier si un compte professeur existe avec la même adresse e-mail
    $sql = "SELECT * FROM tblteacher WHERE Email = :email";
    $checkTeacherQuery = $dbh->prepare($sql);
    $checkTeacherQuery->bindParam(':email', $email, PDO::PARAM_STR);
    $checkTeacherQuery->execute();

    // Si un compte professeur existe, le supprimer également
    if ($checkTeacherQuery->rowCount() > 0) {
        $sql = "DELETE FROM tblteacher WHERE Email = :email";
        $deleteTeacher = $dbh->prepare($sql);
        $deleteTeacher->bindParam(':email', $email, PDO::PARAM_STR);
        $deleteTeacher->execute();
    }

    echo '<script>alert("La demande de suppression a été approuvée et le compte a été supprimé.")</script>';
}


    if(isset($_POST['reject'])) {
        // Récupérer l'email de l'utilisateur à partir du formulaire
        $email = $_POST['email'];

        // Mettre à jour le statut de la demande en 'rejetée'
        $sql = "UPDATE demandes_suppression SET statut = 'rejetée', date_traitement = NOW() WHERE email = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("La demande de suppression a été rejetée.")</script>';
    }
}

{?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ensaté-Hub Admin : Gestion des Demandes de Suppression</title>
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
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Gestion des Demandes de Suppression</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Tableau de Bord</a></li>
                                    <li class="active">Gestion des Demandes</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4>Liste des Demandes</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <?php
                                        $sql = "SELECT * FROM demandes_suppression WHERE statut = 'en_attente'";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <div class="form-group">
                                                    <label>Email: <?php echo htmlentities($result->email); ?></label>
                                                    <p>Message: <?php echo htmlentities($result->message); ?></p>
                                                    <form method="post" name="admin_demandes">
                                                        <input type="hidden" name="email" value="<?php echo htmlentities($result->email); ?>">
                                                        <button type="submit" class="btn btn-default" name="approve">Approuver</button>
                                                        <button type="submit" class="btn btn-default" name="reject">Rejeter</button>
                                                    </form>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include_once('includes/footer.php'); ?>
                </section>
            </div>
        </div>
    </div>
    <!-- jquery vendor -->
    <script src="../assets/js/lib/jquery.min.js"></script>
    <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../assets/js/lib/menubar/sidebar.js"></script>
    <script src="../assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->


    <script src="../assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="../assets/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="../assets/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="../assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="../assets/js/lib/calendar-2/pignose.init.js"></script>
    <!-- scripit init-->

    <script src="../assets/js/scripts.js"></script>
</body>

</html><?php }  ?>