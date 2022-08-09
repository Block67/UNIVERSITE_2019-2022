<?php

   session_start();
   include("connexion_base.php");
   if (!$_SESSION['rvaccin_d'] || $_SESSION['rvaccin_d'] != true) {
       
    header('location:index.php');
      exit;
    }
   

   if(isset($_GET['id']) AND $_GET['id']>0)
   {
       $getid= intval($_GET['id']);
       $requser=$base->prepare("SELECT* FROM agent WHERE id=?");
       $requser->execute(array($getid));
       $userinfo=$requser->fetch();
       
   }

    //Code de Bachirou
   /*$reponse=$base->query("SELECT  id FROM patients");
   $n=0;
   while($conter=$reponse->fetch())
   {
       $n++;
   }
   $reponse=$base->query("SELECT  id FROM patients WHERE sexe='maxculin' ");
   $nbrgarçon=0;
   while($conter=$reponse->fetch())
   {
       $nbrgarçon++;
   }
   $reponse=$base->query("SELECT  id FROM patients WHERE sexe='feminin' ");
   $nbrfille=0;
   while($conter=$reponse->fetch())
   {
       $nbrfille++;
   }*/
   //Le nombre de patient
   $requete1=$base->query("SELECT COUNT(*) AS nbrpatient FROM patients");
   $nbrpatient=$requete1->fetch();
   // le nombre de garçon

   $requete2=$base->query("SELECT COUNT(*) AS nbrgarçon FROM patients WHERE sexe='maxculin'");
   $nbrgarçon=$requete2->fetch();
// le nombre de fille
   $requete3=$base->query("SELECT COUNT(*) AS nbrfille FROM patients WHERE sexe='feminin'");
   $nbrfille=$requete3->fetch();
   // le nombre agent de santé
   $requete4=$base->query("SELECT COUNT(*) AS nbragent FROM agent ");
   $nbragent=$requete4->fetch();



    

      
   

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>R-Vaccin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
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
        <div class="nav-header " style="background-color: #6fd96f;">
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
                                            <a href="profile.html"><i class="icon-user"></i> <span><?php  echo $userinfo['prenom'].' '.$userinfo['nom']; ?></span></a>
                                        </li>
                                        <li>
                                        <span><?php  echo $userinfo['mail']; ?></span>
                                        </li>
                                       
                                        <hr class="my-2">
                                        <li>
                                        <?php
                                        if(isset($_SESSION['id']) AND $userinfo['id']==$_SESSION['id']){
                                            ?>
                                                <a href="">Profil</a>
                                                <hr class="my-2">
                                                <a href="deconnexion.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>

                                            <?php
                                        }
                                        ?>
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
                            <li><a href="dashboard.php?id=<?php echo $_SESSION['id'];?>">Dashboard</a></li>
                            
                        </ul>
                    </li>
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-users"></i><span class="nav-text">Patients</span>
                        </a>
                        <ul aria-expanded="false">
                           
                            <li><a href="listepatient.php?id=<?php echo $_SESSION['id'];?>" aria-expanded="false">Liste des Patients</a></li>
                        </ul>
                    </li>
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Ajouter</span>
                        </a>
                        <ul aria-expanded="false">
                           
                            <li><a href="ajouterpatient.php?id=<?php echo $_SESSION['id'];?>">Ajouter patient</a></li>
                           
                        </ul>
                    </li>
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-bar-chart menu-icon"></i><span class="nav-text">Statistique</span>
                        </a>
                        <ul aria-expanded="false">
                        <li><a href="/administrateur/statistique.php?id=<?php echo $_SESSION['id'];?>">Stat_global</a></li>
                            <li><a href="/administrateur/statenfant.php?id=<?php echo $_SESSION['id'];?>">Stat_enfants</a></li>
                            
                        </ul>
                    </li>
                    
                    
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Calendrier</span>
                        </a>
                        <ul aria-expanded="false">
                          
                            <li><a href="calendrier.php?id=<?php echo $_SESSION['id'];?>">Calendrier</a></li>
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
        <div class="container-fluid mt-3">
        <?php
                 
                        
            ?>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Nombre de patient</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $nbrpatient['nbrpatient']; ?></h2>
                                    
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Nombre garçon</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $nbrgarçon['nbrgarçon']; ?></h2>
                                    
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-mars"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Nombre de fille</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $nbrfille['nbrfille']; ?></h2>
                                    
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-venus"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Nbre d'agent de santé</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $nbragent['nbragent']; ?></h2>
                                
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-user-md"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                

                
         </div>
         <div class="container">
             <h2>Ajouter un</h2>

         </div>
            <!-- #/ container -->
         <div class="container">
             <div class="row">
                 <div class="col-12 col-lg-6">
                    <div class="card" style="width: 18rem;">
                        <img src="images/imgs/1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Ajouter un patient</h5>
                          
                        </div>
                        
                        <div class="card-body">
                          <a href="#" class="card-link">Ajouter</a>
                          <a href="#" class="card-link">Another link</a>
                        </div>
                      </div>
                 </div>

             </div>
            

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
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
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




