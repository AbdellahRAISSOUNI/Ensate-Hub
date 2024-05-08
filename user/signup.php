<?php 
session_start(); // Démarrer la session et désactiver la notification des erreurs
error_reporting(0); // Inclure le fichier de connexion à la base de données
include('includes/dbconnection.php');
// Vérifier si le formulaire d'inscription a été soumis
if(isset($_POST['submit']))
  {
    // Récupérer les données du formulaire
    $fname=$_POST['fname'];
    $mobno=$_POST['mobno'];
    $email=$_POST['email'];
    $cid=$_POST['cid'];
    $rollnum=$_POST['rollnum'];
    // Crypter le mot de passe avant de le stocker en base de données
    $password=md5($_POST['password']);
    // Vérifier si l'adresse e-mail, le numéro de téléphone ou l'apogée existe déjà dans la base de données
    $ret="select Email,MobileNumber,RollNumber from tbluser where Email=:email || MobileNumber=:mobno || RollNumber=:rollnum ";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
    $query->bindParam(':rollnum',$rollnum,PDO::PARAM_INT);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    // Si aucun enregistrement correspondant n'est trouvé, insérer les données de l'utilisateur dans la base de données
if($query -> rowCount() == 0)
{
$sql="insert into tbluser(FullName,MobileNumber,Email,Cid,RollNumber,Password)Values(:fname,:mobno,:email,:cid,:rollnum,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
$query->bindParam(':cid',$cid,PDO::PARAM_INT);
$query->bindParam(':rollnum',$rollnum,PDO::PARAM_INT);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
// Récupérer l'ID de l'utilisateur nouvellement inscrit
$lastInsertId = $dbh->lastInsertId();
// Si l'inscription réussit, afficher un message de succès et rediriger vers la page de connexion
if($lastInsertId)
{

echo "<script>alert('Votre compte a été crée avec succés');</script>";
echo "<script>window.location.href ='login.php'</script>";
}
else
{
// Sinon, afficher un message d'erreur
echo "<script>alert('Erreur');</script>";
}
}
 else
{
// Si l'adresse e-mail, le numéro de téléphone ou l'apogée existe déjà, afficher un message d'erreur
echo "<script>alert('Adresse mail o numéro existe déja. Essayer quelque chose');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadonnées -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnsateHub -  Creation du compte</title>
    <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #15429b;
        }

        .login-content {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            margin-bottom: 20px;        }

        .login-logo span {
            color: #15429b;
            font-size: 24px;
            font-weight: bold;
        }

        .login-form h4 {
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }

        .form-group label {
            color: #333;
            font-weight: bold;
        }

        .form-group label.bold {
            font-weight: bold;
        }

        .form-control {
            border-radius: 25px;
        }

        .btn-primary {
            border-radius: 25px;
            background-color: #15429b;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #12347a;
        }

        .register-link a {
            color: #15429b;
        }

        .register-link a:hover {
            color: #12347a;
        }
    </style>
</head>

<body>
    <!-- Formulaire d'inscription -->
    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#"><span>Création d'un compte étudiant</span></a>
                        </div>
                        <div class="login-form">
                            <h4>Inscription</h4>
                            <form method="post">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" value="" name="fname" required="true" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bold">Numéro de Téléphone</label>
                                    <input type="text" name="mobno" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label class="bold">Adresse mail</label>
                                    <input type="email" class="form-control" value="" name="email" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Apogé</label>
                                    <input type="text" value="" name="rollnum" required="true" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>choisir un cours</label>
                                    <select type="text" value="" name="cid" required="true" class="form-control">
                                        <option value="">choisir un cour</option>
                                        <?php
                                          
$sql="SELECT * from tblcourse";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{            


   ?>
                                       <option value="<?php  echo $row->ID;?>"><?php  echo htmlentities($row->CourseName);?>(<?php  echo htmlentities($row->BranchName);?>)</option><?php $cnt=$cnt+1;}} ?>
                                       </select>
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" value="" class="form-control" name="password" required="true">
                                </div>
                               
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="submit">Register</button>
                               
                                <div class="register-link m-t-15 text-center">
                                    <p>Vous avez déjà un compte ? <a href="login.php"> Connectez Vous !</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>