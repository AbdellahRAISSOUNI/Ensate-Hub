<?php
session_start(); // Démarre la session
error_reporting(0); // Désactive les rapports d'erreur
include('includes/dbconnection.php'); // Inclut le fichier de connexion à la base de données

// Vérifie si l'utilisateur est connecté, sinon le redirige vers la page de déconnexion
if (strlen($_SESSION['ocastid']==0)) {
  header('location:logout.php');
  } else{
    // Si le formulaire est soumis
    if(isset($_POST['submit']))
  {
$eid=$_GET['editid'];
$file=$_FILES["assfile"]["name"];
$extension = substr($file,strlen($file)-4,strlen($file));
$allowed_extensions = array("docs",".doc",".pdf");
// Vérifie si l'extension du fichier est autorisée
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Le fichier a un format invalide. Seuls les formats docs / doc / pdf sont autorisés.');</script>";
}
else
{
// Renomme le fichier et le déplace vers le répertoire 'assignmentfile'
$file=md5($file).time().$extension;
 move_uploaded_file($_FILES["assfile"]["tmp_name"],"assignmentfile/".$file);
// Met à jour le nom du fichier dans la base de données
$sql="update tblassigment set AssignmentFile=:file where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':file',$file,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
    echo '<script>alert("Les détails de l`assignation ont été mis à jour.")</script>';
}}
?>
<!DOCTYPE html>
<html lang="en">

<head>Ensaté-Hub 
  
    <title>Professeur : Mise à jour Affectation </title>
    <!-- Styles -->
    <link href="../assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
<!--Inclusion de la bar de side et le header -->
<?php include_once('includes/sidebar.php');?>
   
    <?php include_once('includes/header.php');?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Mise à jour d'Affectation</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Tableau de board</a></li>
                                    <li class="active">Mise à jour Information d'Affectation</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="card alert">
                        <div class="card-body">
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                <?php
                                    $eid=$_GET['editid'];
$sql="SELECT tblcourse.ID,tblcourse.BranchName,tblcourse.CourseName,tblsubject.SubjectFullname,tblsubject.SubjectCode,tblassigment.AssignmentNumber,tblassigment.AssignmenttTitle,tblassigment.SubmissionDate,tblassigment.AssignmentDescription,tblassigment.AssigmentMarks,tblassigment.AssignmentFile from tblassigment join tblcourse on tblcourse.ID=tblassigment.Cid join tblsubject on tblsubject.ID=tblassigment.Sid where tblassigment.ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row1)
{               ?>
                            <div class="card-header m-b-20">
                                <h4>Mise à jour Numero d'Affectation: <?php  echo htmlentities($row1->AssignmentNumber);?></h4>
                                <div class="card-header-right-icon">
                                    <ul>
                                        <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>
                                        <li class="card-option drop-menu"><i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                            <ul class="card-option-dropdown dropdown-menu">
                                                <li><a href="#"><i class="ti-loop"></i> Mise à jour donnée </a></li>
                                                <li><a href="#"><i class="ti-menu-alt"></i> Détails</a></li>
                                                <li><a href="#"><i class="ti-pulse"></i> Statistiques</a></li>
                                                <li><a href="#"><i class="ti-power-off"></i> Effacer</a></li>
                                            </ul>
                                        </li>
                                        <li class="doc-link"><a href="#"><i class="ti-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                           
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Titre d'Affectation</label>
                                            <!-- Champ d'entrée pour le titre de l'affectation -->
                                            <input type="text" class="form-control border-none input-flat bg-ash" name="asstitle" required="true" value="<?php  echo htmlentities($row1->AssignmenttTitle);?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="basic-form">
                                        <div class="form-group image-type">
                                            <label>Fichier d'Affectation si existe</label>
                                             <!-- Lien pour afficher le fichier d'affectation existant -->
                                            <a href="assignmentfile/<?php echo $row1->AssignmentFile;?>" width="100" height="100" target="_blank"> <strong style="color: red">Voir</strong></a>

                                        </div>
                                    </div>
                                   <div class="basic-form">
                                        <div class="form-group image-type">
                                            <label>Fichier d'Affectation si existe <span>(150 X 150)</span></label>
                                            <input type="file" name="assfile" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div><?php $cnt=$cnt+1;}} ?>
                            <!-- Boutons pour soumettre le formulaire et le réinitialiser -->
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Mise à jour </button>
                            <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Réinitialiser</button>
                        </form>
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