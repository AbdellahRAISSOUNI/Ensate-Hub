<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $rollmobilenum=$_POST['rollmobilenum'];
    $mobnum=$_POST['mobnum'];
    $password=md5($_POST['password']);
    $sql ="SELECT RollNumber,MobileNumber,Password,ID,Cid FROM tbluser WHERE (RollNumber=:rollmobilenum || MobileNumber=:rollmobilenum) and Password=:password";
    $query=$dbh->prepare($sql);
    $query->bindParam(':rollmobilenum',$rollmobilenum,PDO::PARAM_STR);
    $query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['ocasuid']=$result->ID;
$_SESSION['ocasucid']=$result->Cid;
}
$_SESSION['login']=$_POST['rollmobilenum'];

echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>alert('Détailles invalides');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ensaté-Hub Connection-Etudiant</title>
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
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .login-logo span {
            color: #15429b;
            font-size: 24px;
            font-weight: bold;
        }

        .login-form h4 {
            margin-bottom: 30px;
            color: #333;
            font-size: 30px;
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
            color: #15429b;
        }

        .register-link a:hover {
            color: #12347a;
        }
    </style>
</head>

<body>

    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="../index.php"><span>Ensaté-Hub</span></a>
                        </div>
                        <div class="login-form">
                            <h4>Connection : Etudiant</h4>
                            <form method="post">
                                <div class="form-group">
                                    <label>Votre numéro de téléphone ou votre numéro Apogée</label>
                                    <input type="text" class="form-control" placeholder="Cliquer ici pour entrer le numéro" required="true" name="rollmobilenum">
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" class="form-control" placeholder="Cliquer ici pour entrer le mot de passe" name="password" required="true">
                                </div>
                                <div class="checkbox">
                                    <label class="pull-right">
										<a href="forgot-password.php">Vous avez oublié votre mot de passe ?</a>
									</label>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary btn-flat m-b-30 m-t-30">Connectez-vous</button>

                                <div class="register-link m-t-15 text-center">
                                    <p>Vous n'avez pas de compte ? <a href="signup.php">Créer un compte</a></p>
                                </div>
                                <label>
                                    <a href="../index.php">Retour à l'accueil</a>
                                </label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
