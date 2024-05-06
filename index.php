
<?php
session_start();
error_reporting(0);
include('admin/includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Ensaté-Hub | Page d'accueil</title>

	<!-- Style-sheets -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!--// Style-sheets -->
	<!--web-fonts-->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
	<!--//web-fonts-->
	<!-- top -->
	<style>
    .top-header-area {
      background-color: #15429b;
      padding: 10px 0;
    }

    .top-header-content a {
      color: #fff;
      margin-right: 20px;
      font-size: 14px;
      text-decoration: none;
    }

    .top-header-content a:last-child {
      margin-right: 0;
    }

    .top-header-content a i {
      margin-right: 5px;
    }

    .top-header-content span {
      vertical-align: middle;
    }

    .top-header-content a:hover {
      text-decoration: underline;
    }
/* nav bar */
.navbar-toggle.collapsed .icon-bar {
    background-color: #174ebb;
  }

  .navbar-toggle.collapsed .icon-bar:hover {
    background-color: #174ebb; /* Optionnel: Si vous voulez changer la couleur au survol */
  }

  .navbar-toggle.collapsed:focus .icon-bar {
    background-color: #174ebb; /* Optionnel: Si vous voulez changer la couleur lorsqu'il est en focus */
  }

  .contact-info span{
	color:#fff;
  }

  .contact-info {
            color: white;
            font-size: 16px;
            transition: transform 0.3s, #fff 0.3s;
            margin-bottom: 10px;
        }

        .contact-info a:hover {
            transform: scale(1.05);
            color: gray;
        }

        .contact-info i {
			color:#fff;
            margin: 5px;
        }

		.contact-info a{
			color:#fff;
		}



        .elementor-icon-box-wrapper {
            display: inline-block;
            margin: 30px;
            width: 400px;
            color: #ffffff; /* couleur du texte */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            background-color: #265dcc; /* couleur de fond */
			height: 390px;
			margin-inline: 60px;
			
        }

        .elementor-icon-box-content {
            text-align: justify;
        }

        .elementor-icon-box-title span {
            display: block;
            color: #ffffff; /* couleur du titre */
            font-weight: bold; /* mise en gras du titre */
			text-align: center;
			margin-bottom: 10px;
        }

        .elementor-icon-box-description {
            color: #ffffff; /* couleur de la description */
        }
/*--------------*/

.single-footer-widget {
  background-color: #174ebb;
  padding: 30px;
  color: #fff;
}

.single-footer-widget p {
  margin-bottom: 20px;
}

.footer-contact p {
  margin-bottom: 10px;
}

.footer-contact p i {
  margin-right: 10px;
}

.banner {
        position: relative;
        min-height: 795px;
        background: url('baner1.png') no-repeat 0 0;
        background-size: cover;

    }
.banner::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust the alpha value (0.5) for darkness */
}


h2 a .fa.fa-graduation-cap {
    color: #265dcc; /* couleur spécifique */
}

h1 a .fa.fa-graduation-cap {
    color: #265dcc; /* couleur spécifique */
}


  </style>
	<!-- -->

</head>

<body>
	<!--top -->

	<div class="top-header-area">
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <!-- Top Content -->
          <div class="col-6 col-md-9 col-lg-8">
            <div class="top-header-content">
              <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="BP: 2222 M'hannech Tétouan Morocco"><i class="fa fa-map-marker"></i> <span>BP: 2222 M'hannech Tétouan Morocco</span></a>
              <a href="mailto:admin@gmail.ma" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="admin@gmail.ma"><i class="fa fa-envelope"></i> <span>admin@gmail.ma</span></a>
            </div>
          </div>
          <!-- Top Header Social Info -->
          <div class="col-6 col-md-3 col-lg-4">
            <div class="top-header-social-info text-right">
                          </div>
          </div>
        </div>
      </div>
    </div>
	<!-- end top -->
	<!-- banner -->
	<div class="banner" id="home">
		<div class="container">
			<!-- header -->
			<header>

				<div class="header-bottom-w3layouts">
					<div class="main-w3ls-logo">
					<h1>
  <a href="index.php" style="color: #fff;">
    <span class="fa fa-graduation-cap" aria-hidden="true"></span>Ensaté-Hub</a>
</h1>

					</div>
					<!-- navigation -->
					<nav class="navbar navbar-default">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
							    aria-expanded="false">
					<span class="sr-only">Bascule de navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>

						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
							<li><a href="index.php">Accueil</a></li>
							<li><a href="user/login.php">Étudiants</a></li>
							<li><a href="teacher/login.php">Enseignant</a></li>
							<li><a href="admin/login.php">Administrateur</a></li>
								
							</ul>

						</div>
						<!-- /.navbar-collapse -->

					</nav>
					
				</div>
				<div class="clearfix"></div>
				<!-- //navigation -->
			</header>
			<!-- //header -->
			<!-- banner-text -->
			<div class="banner-text">
				<div class="callbacks_container">
					<ul class="rslides" id="slider3">
						<li>
							<div class="slider-info">
							<h3>Il n'est jamais trop tard pour étudier</h3>
							<p>L'éducation a besoin d'une solution complète</p>
								
							</div>
						</li>
						<li>

							<div class="slider-info">
							<h3>La meilleure institution d'apprentissage</h3>
							<p>Une carrière réussie commence par une bonne formation</p>

								
							</div>
						</li>

					</ul>

				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- //banner -->

	<!-- Notice -->
	<div class="testimonials-section">
		<div class="container">
			<h5 class="main-w3l-title">Avis de l'École</h5>
			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<?php
$sql="SELECT * from tblnews";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
						<li>
							<div class="testimonial-agileits-w3layouts">
								<h3><?php  echo htmlentities($row->Title);?></h3>
								<p><?php  echo substr(($row->Description),0,95);?>. </p>
								<p><?php  echo htmlentities($row->CreationDate);?></p>
							
							</div>
							
							<div class="clearfix"> </div>
						</li>
					<?php $cnt=$cnt+1;}} ?>
			
					</ul>
				</div>
			</section>
		</div>
	</div>
	<!-- Testimonials -->

	<!-- Footer -->
	<div class="footer-agileits-w3layouts">
		<div class="container">
			<div class="btm-logo-w3ls">
				<h2><a href="index.html"><span class="fa fa-graduation-cap" aria-hidden="true"></span>Ensaté-Hub</a></h2>
			</div>
			<div class="elementor-icon-box-wrapper">
    <div class="elementor-icon-box-content">
        <h3 class="elementor-icon-box-title">
            <span>
			Réalisateurs de projets :
            </span>
        </h3>
        <p class="elementor-icon-box-description">
		L'équipe de réalisateurs, composée de <b>Oussama Ben Kacem</b>, <b>Abdellah Raissouni</b>, <b>Jihan Elamrani</b> et <b>Mohamed Salim Soulmani</b>, sont des étudiants de l'École Nationale des Sciences Appliquées de Tétouan. Ils ont créé la plateforme <b>Ensaté-Hub</b> dans le cadre du module de développement web 1, répondant ainsi à un besoin spécifique : offrir un espace d'apprentissage en ligne aux étudiants. Grâce à leur collaboration et à leurs compétences en développement web, ils ont réussi à concevoir une plateforme moderne et fonctionnelle pour soutenir l'enseignement et l'apprentissage.
        </p>
    </div>
</div>

<div class="elementor-icon-box-wrapper">
    <div class="elementor-icon-box-content">
        <h3 class="elementor-icon-box-title">
            <span>
			Encadrant :
            </span>
        </h3>
        <p class="elementor-icon-box-description">
		Nous avons eu la chance d'être encadrés par notre meilleur professeur de développement web1, <b>El Jourani Reda</b>, tout au long de la réalisation de ce projet. Son expertise, ses conseils avisés et son soutien indéfectible ont été précieux pour nous guider dans la conception et le développement de la plateforme <b>Ensaté-Hub</b>. Nous lui exprimons notre profonde gratitude pour son dévouement et son engagement envers notre réussite. Ses encouragements ont été une source d'inspiration et nous ont permis d'atteindre nos objectifs avec succès.
        </p>
    </div>
</div>


			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="single-footer-widget" >
					<div href="./index.html" class="d-block mb-4"><img src="ensatelogo.png" style="max-width: 10%" alt="logo" color="white"></div>
            <p>Ensaté-Hub : Votre Plateforme d'Enseignement Supérieur en Ligne.</p>
            <div class="footer-contact">
			<p class="contact-info" color="white"><span class="c1"><i class="fa fa-map-marker"></i></span><span><a href="#">BP: 2222 M'hannech Tétouan</a></span></p>
			<p class="contact-info"><span><i class="fa fa-phone"></i></span><span><a href="#">+212. 500. 000. 000</a></span></p>
			<p class="contact-info"><span><i class="fa fa-envelope"></i></span><span><a href="mailto:admin@gmail.ma">admin@gmail.ma</a></span></p>
            </div>
          </div>
	<div class="copyright-w3layouts">
		<div class="container">
			<p>&copy; 2024 : Ensaté-Hub - TOUS LES DROITS SONT RÉSERVÉS | </p>
		</div>
	</div>
	<!-- //Footer -->

	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- //smooth scrolling -->


	<script type='text/javascript' src='js/jquery-2.2.3.min.js'></script>
	<!-- stats -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>
	<script>
		$('.counter').countUp();
	</script>
	<!-- //stats -->
	<!-- flexSlider -->
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				start: function (slider) {
					$('body').removeClass('loading');
				}
			});
		});
	</script>
	<!-- //flexSlider -->
	<!-- Responsiveslides -->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		// You can also use "$(window).load(function() {"
		$(function () {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>
	<!-- // Responsiveslides -->
	<!--search-bar-->
	<script src="js/main.js"></script>
	<!--//search-bar-->

	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function () {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //here ends scrolling icon -->
	<!-- Js for bootstrap working-->
	<script src="js/bootstrap.js"></script>
	<!-- //Js for bootstrap working -->
</body>

</html>