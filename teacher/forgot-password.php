<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT Email FROM tblteacher WHERE Email=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblteacher set Password=:newpassword where Email=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Ensaté-HUB Proffesseur : Mot de passe oublié</title>
    
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
                            <a href="dashboard.php"><span>Ensaté-HUB Proffesseur</span></a>
                        </div>
                        <div class="login-form">
                            <h4>Mot de passe oublié</h4>
                            <form method="post" name="chngpwd" onSubmit="return valid();">
                                <div class="form-group">
                                    <label>Addresse Email </label>
                                    <input type="email" class="form-control" placeholder="Addresse Email" required="true" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Nombre de Télèphone</label>
                                    <input type="text" class="form-control" placeholder="Nombre de Télèphone" required="true" name="mobile" maxlength="10" pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label>Nouveau Mot de passe</label>
                                    <input type="password" name="newpassword" class="form-control" placeholder="Nouveau Mot de passe" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Confirmer Mot de passe</label>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirmer Mot de passe required="true">
                                </div>
                                <div class="checkbox">
                                    
                                    <label class="pull-right">
										<a href="login.php">se conneter</a>
									</label>

                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Réinitialiser</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>