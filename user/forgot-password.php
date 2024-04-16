<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT Email FROM tbluser WHERE Email=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
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
    
    <title>Mot de passe oublié</title>
    
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="dashboard.php"><span>Etudiant</span></a>
                        </div>
                        <div class="login-form">
                            <h4>J'ai Oublié Mon Mot de Passe</h4>
                            <form method="post" name="chngpwd" onSubmit="return valid();">
                                <div class="form-group">
                                    <label>Adresse Mail:</label>
                                    <input type="email" class="form-control" placeholder="Qliquer ici pour entrer votre adresse mail" required="true" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Numéro de téléphone</label>
                                    <input type="text" class="form-control" placeholder="Qliquer ici pour entrer votre numéro de téléphone" required="true" name="mobile" maxlength="10" pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label>Nouveau mot de passe</label>
                                    <input type="password" name="newpassword" class="form-control" placeholder="Qliquer pour entrer le nouveau mot de passe" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Confirmer le nouveau mot de passe</label>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirmer le nouveau mot de passe" required="true">
                                </div>
                                <div class="checkbox">
                                    
                                    <label class="pull-right">
										<a href="login.php">Connectez vous</a>
									</label>

                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Restorer votre mot de passe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>