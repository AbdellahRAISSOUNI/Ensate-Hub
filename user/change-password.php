<?php
session_start(); // Démarrer la session pour accéder aux données de session
error_reporting(0);// Désactiver l'affichage des erreurs pour un environnement de production
include('includes/dbconnection.php'); // Inclure le fichier de connexion à la base de données pour utiliser les fonctions de connexion
error_reporting(0); // Désactiver l'affichage des erreurs pour un environnement de production (redondant avec la ligne 5)
if (strlen($_SESSION['ocasuid']==0)) { // Vérifier si l'utilisateur est connecté en vérifiant la valeur de la variable de session 'ocasuid', sinon le rediriger vers la page de déconnexion

  header('location:logout.php');
  } else{
if(isset($_POST['submit'])) // Vérifier si le formulaire a été soumis

{
// Récupérer l'ID de l'utilisateur à partir de la session
$uid=$_SESSION['ocasuid'];
$cpassword=md5($_POST['currentpassword']); // Hacher le mot de passe actuel soumis avec md5
$newpassword=md5($_POST['newpassword']); // Hacher le nouveau mot de passe soumis avec md5
// Requête SQL pour vérifier si l'ID de l'utilisateur et le mot de passe actuel sont corrects
$sql ="SELECT ID FROM tbluser WHERE ID=:uid and Password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

// Vérifier si la requête a retourné des résultats
if($query -> rowCount() > 0)
{
// Requête SQL pour mettre à jour le mot de passe de l'utilisateur
$con="update tbluser set Password=:newpassword where ID=:uid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':uid', $uid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
// Afficher un message de succès et rediriger vers la page "change-password.php"
echo '<script>alert("Votre mot de passe a été changé avec succés")</script>';
 echo "<script>window.location.href ='change-password.php'</script>";
} else {
// Afficher un message d'erreur si le mot de passe actuel est incorrect
echo '<script>alert("Le mot de passe que vous avez entré est incorrecte")</script>';

}
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  
    <title>Ensaté-Hub Etudiant : Changer votre le passe </title>
    <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script type="text/javascript">
// Fonction JavaScript pour vérifier que le nouveau mot de passe et la confirmation sont identiques
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('Le nouveau mot de passe et le mot de passe confirmé est incorrecte');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>
</head>

<body>

<?php include_once('includes/sidebar.php');?>
   
    <?php include_once('includes/header.php');?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Changer Mot de Passe</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Tableau de borad</a></li>
                                    <li class="active">Changer mot de passe</li>
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
                                    <h4>Changer le mot de passe</h4>
                                    <div class="card-header-right-icon">
                                        <ul>
                                            <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>
                                            <li class="doc-link"><a href="#"><i class="ti-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                    <form method="post"  name="changepassword" onsubmit="return checkpass();" name="changepassword">
                                     <div class="form-group"> <label for="exampleInputEmail1">Mot de passe actuelle</label> <input type="password" class="form-control" name="currentpassword" id="currentpassword"required='true'> </div> 
                                     <div class="form-group"> <label for="exampleInputEmail1">Nouveau mot de passe</label> <input type="password" class="form-control" name="newpassword"  class="form-control" required="true"> </div>
                                     <div class="form-group"> <label for="exampleInputEmail1">Confirmer le mot passe</label> <input type="password" class="form-control"  name="confirmpassword" id="confirmpassword"  required='true'> </div>
                                     
                                       
                         <button type="submit" class="btn btn-default" name="submit">Changer</button> </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
         
                   <?php include_once('includes/footer.php');?>
                </div>
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
    <script src="../assets/js/scripts.js"></script>
</body>

</html><?php }  ?>