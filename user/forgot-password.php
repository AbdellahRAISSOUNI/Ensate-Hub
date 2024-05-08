<?php
session_start(); // Démarrer la session
error_reporting(0); // Désactiver l'affichage des erreurs PHP
// Inclure le fichier de connexion à la base de données
include('includes/dbconnection.php');

// Vérifier si le formulaire de restauration de mot de passe est soumis
if(isset($_POST['submit']))
  {
    // Récupérer les données du formulaire
    $email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);

    // Vérifier si l'email et le numéro de téléphone correspondent à un utilisateur dans la base de données
  $sql ="SELECT Email FROM tbluser WHERE Email=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

// Si les informations sont valides, mettre à jour le mot de passe de l'utilisateur
if($query -> rowCount() > 0)
{
$con="update tbluser set Password=:newpassword where Email=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Votre mot de passe été changé avec succés');</script>";
}
else {
echo "<script>alert('Email o Numéro invalides');</script>"; 
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <!-- Styles -->
    <!-- Inclure les fichiers CSS nécessaires -->
    <!-- Styles spécifiques à cette page -->
    <!-- Scripts JavaScript -->
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
            color: #333;
        }

        .register-link a:hover {
            color: #15429b;
        }
    </style>
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("Les nouveaux mots de passe ne correspondent pas !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>

    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="dashboard.php"><span>Ensaté-Hub Etudiant</span></a>
                        </div>
                        <div class="login-form">
                            <h4>J'ai Oublié mon Mot de Passe</h4>
                            <!-- Formulaire de restauration de mot de passe -->
                            <form method="post" name="chngpwd" onSubmit="return valid();">
                                <div class="form-group">
                                    <label>Adresse Mail:</label>
                                    <input type="email" class="form-control" placeholder="Entrez votre adresse mail" required="true" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Numéro de téléphone :</label>
                                    <input type="text" class="form-control" placeholder="Entrez votre numéro de téléphone" required="true" name="mobile" maxlength="10" pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label>Nouveau mot de passe :</label>
                                    <input type="password" name="newpassword" class="form-control" placeholder="Entrez le nouveau mot de passe" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Confirmer le nouveau mot de passe :</label>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirmez le nouveau mot de passe" required="true">
                                </div>
                                <div class="checkbox">
                                    <label class="pull-right">
                                        <a href="login.php">Connectez vous?</a>
                                    </label>
                                </div>
                                <!-- Bouton de soumission du formulaire -->
                                <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Restaurer votre mot de passe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
