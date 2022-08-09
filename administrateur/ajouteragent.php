<?php

   include("connexion_base.php");
   
   if(isset($_POST['envoyer']))
   {
    
     $nom=htmlspecialchars($_POST['nom']);
     $prenom=htmlspecialchars($_POST['prenom']);
     $adresse=htmlspecialchars($_POST['adresse']);
     $numTel=htmlspecialchars($_POST['numTel']);
     $mail=htmlspecialchars($_POST['mail']);
     $mpasse=htmlspecialchars($_POST['mpasse']);

     if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['adresse']) AND
        !empty($_POST['numTel']) AND !empty($_POST['mail']) AND !empty($_POST['mpasse']))
        {
          $requete=$base->prepare("INSERT INTO agent(nom,prenom,adresse,numTel,mail,mpasse) VALUES(?,?,?,?,?,?)");
          $requete->execute(array($nom,$prenom,$adresse,$numTel,$mail,$mpasse));
                           echo"Succès";
        
        }else{
          echo "Remplissez tous les chanps";
        }
   }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>R-Vaccin</title>
    <!-- Favicon icon -->
    
    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <!-- Custom Stylesheet -->
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header ">
            <div class="brand-logo">
                <a href="index.php" class="fw-bold">
                    <!--<b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>-->
                    <b class="logo-abbr text-white fw-bold">RV</b>
                    <span class="logo-compact tex-white">RV</span>
                    <span class="brand-title text-white">
                    R-Vaccin
                    </span>
                    
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Recherche" aria-label="Search Dashboard">
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                    
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/user/prof.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span>le nom</span></a>
                                        </li>
                                        <li>
                                            <div></div>
                                        </li>
                                       
                                        <hr class="my-2">
                                        <li>
                                       log
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        





        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            
                        </ul>
                    </li>
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-users"></i><span class="nav-text">Patients</span>
                        </a>
                        <ul aria-expanded="false">
                           
                            <li><a href="listepatient.php" aria-expanded="false">Liste des Patients</a></li>
                        </ul>
                    </li>
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Ajouter</span>
                        </a>
                        <ul aria-expanded="false">
                           
                            <li><a href="ajouterpatient.php">Ajouter patient</a></li>
                           
                        </ul>
                    </li>
                    
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Calendrier</span>
                        </a>
                        <ul aria-expanded="false">
                          
                            <li><a href="calendrier.php">Calendrier</a></li>
                        </ul>
                    </li>
                    
                   
                    
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Connexion</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="connexion.php">Connexion</a></li>
                           
                           
                           
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
        <div class="container">
    <h2 class="text-center mt-3">Formulaire d'ajout Agent de Santé</h2>

<form method="POST" action="" class="row g-3">
  <div class="col-12 col-lg-6 position-relative">
    <label for="nom" class="form-label fw-bold">Nom</label>
    <input type="text" class="form-control" name="nom" placeholder="Le nom" required>
  </div>
  <div class="col-12 col-lg-6 position-relative">
    <label for="prenom" class="form-label fw-bold">Prénom</label>
    <input type="text" class="form-control" name="prenom" placeholder="Prénoms" required>
  </div>
  <div class="col-12 col-lg-6 position-relative">
    <label for="adresse" class="form-label fw-bold mt-2">Adresse</label>
    <input type="text" class="form-control" name="adresse" placeholder="Adresse" required>
  </div>
  <div class="col-12 col-lg-6 position-relative">
    <label for="numtelephone" class="form-label fw-bold mt-2">Numéro de Téléphone</label>
    <input type="text" class="form-control" name="numTel" placeholder="+22995505050" required>
  </div>
  <div class="col-12 col-lg-6 position-relative">
  <label for="nom" class="form-label fw-bold">Adresse email</label>
    <input type="text" class="form-control" name="mail" placeholder="Email" required>
  </div>
  <div class="col-12 col-lg-6 position-relative">
    <label for="mpasse" class="form-label fw-bold mt-2">Mot de passe</label>
    <input type="password" class="form-control" name="mpasse" placeholder="mot de passe" required>
  </div>
  <div class="col-12 mt-5">
         
         <button class="btn login-form__btn submit w-100">Ajouter</button>
    <!--<button class="btn btn-primary" type="submit" name="envoyer" value="Envoyer">Ajouter patient</button>-->
  </div>
</form>
</div>
        
       
           
        </div>
        
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
            <p>Copyright &copy; 2022 Tous les droits sont réservés</p>            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="./plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="./plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="./plugins/d3v3/index.js"></script>
    <script src="./plugins/topojson/topojson.min.js"></script>
    <script src="./plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="./plugins/raphael/raphael.min.js"></script>
    <script src="./plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="./plugins/moment/moment.min.js"></script>
    <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="./plugins/chartist/js/chartist.min.js"></script>
    <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>









