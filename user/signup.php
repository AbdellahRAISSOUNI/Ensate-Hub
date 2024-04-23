<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
  {
    $fname=$_POST['fname'];
    $mobno=$_POST['mobno'];
    $email=$_POST['email'];
    $cid=$_POST['cid'];
    $rollnum=$_POST['rollnum'];
    $password=md5($_POST['password']);
    $ret="select Email,MobileNumber,RollNumber from tbluser where Email=:email || MobileNumber=:mobno || RollNumber=:rollnum ";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
    $query->bindParam(':rollnum',$rollnum,PDO::PARAM_INT);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
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
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

echo "<script>alert('Votre compte a été crée avec succés');</script>";
echo "<script>window.location.href ='login.php'</script>";
}
else
{

echo "<script>alert('Erreur');</script>";
}
}
 else
{

echo "<script>alert('Adresse mail o numéro existe déja. Essayer quelque chose');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>OCAS User : Signup</title>

    <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-primary">

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
                                    <label>Numéro de Téléphone</label>
                                    <input type="text" name="mobno" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label>Adresse mail</label>
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
                                    <p>Vous avez déja un compte ? <a href="login.php"> Connectez Vous !</a></p>
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