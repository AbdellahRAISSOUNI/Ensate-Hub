<?php
session_start(); // Démarre la session
error_reporting(0); // Désactive les rapports d'erreur
include('includes/dbconnection.php');  // Inclut le fichier de connexion à la base de données

// Vérifie si l'utilisateur est connecté, sinon le redirige vers la page de déconnexion
error_reporting(0);
if (strlen($_SESSION['ocastid']==0)) {
  header('location:logout.php');
  } else{
    // Si le formulaire est soumis
if(isset($_POST['submit']))
{
$tid=$_SESSION['ocastid'];
$cpassword=md5($_POST['currentpassword']); // Mot de passe actuel
$newpassword=md5($_POST['newpassword']); // Nouveau mot de passe

// Vérifie si le mot de passe actuel est correct
$sql ="SELECT ID FROM tblteacher WHERE ID=:tid and Password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':tid', $tid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
    // Met à jour le mot de passe dans la base de données
$con="update tblteacher set Password=:newpassword where ID=:tid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':tid', $tid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();

echo '<script>alert("Votre mot de passe a été changé avec succès.")</script>';
 echo "<script>window.location.href ='change-password.php'</script>";
} else {
echo '<script>alert("Your current password is wrong")</script>';

}
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  
    <title>Ensaté-Hub Professeur : Changer Mot de passe</title>
    <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('Les champs Nouveau mot de passe et Confirmer le mot de passe ne correspondent pas.');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>
</head>

<body>
<!--Inclusion de la bar de side et de header -->
<?php include_once('includes/sidebar.php');?>
   
    <?php include_once('includes/header.php');?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <!-- Header -->
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Changer Mot de passe</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Tableau de board</a></li>
                                    <li class="active">Changer Mot de passe</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4>Changer Mot de passe</h4>
                                    <div class="card-header-right-icon">
                                        <ul>
                                            <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>
                                            <li class="doc-link"><a href="#"><i class="ti-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                    <!-- Formulaire de changement de mot de passe -->
                    <form method="post"  name="changepassword" onsubmit="return checkpass();" name="changepassword">
                                     <div class="form-group"> <label for="exampleInputEmail1">Mot de passe actuelle</label> <input type="password" class="form-control" name="currentpassword" id="currentpassword"required='true'> </div> 
                                     <div class="form-group"> <label for="exampleInputEmail1">Nouveau Mot de passe</label> <input type="password" class="form-control" name="newpassword"  class="form-control" required="true"> </div>
                                     <div class="form-group"> <label for="exampleInputEmail1">Confirmer Mot de passe</label> <input type="password" class="form-control"  name="confirmpassword" id="confirmpassword"  required='true'> </div>
                                     
                                       
                         <button type="submit" class="btn btn-default" name="submit">Changer</button> </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <!-- Footer -->
                   <?php include_once('includes/footer.php');?>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript imports -->

    <!-- jquery vendor -->
    <script src="../assets/js/lib/jquery.min.js"></script>
    <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../assets/js/lib/menubar/sidebar.js"></script>
    <script src="../assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html><?php }  ?>