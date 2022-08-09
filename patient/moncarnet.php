<?php
session_start();
include("../connexion_base.php");
if (!$_SESSION['patient'] || $_SESSION['patient'] != true) {
    
 header('location:index.php');
   exit;
 }

 if(isset($_GET['id']) AND $_GET['id']>0)
   {
       $getid= intval($_GET['id']);
       $requser=$base->prepare("SELECT* FROM patients WHERE id=?");
       $requser->execute(array($getid));
       $userinfo=$requser->fetch();
       
   }
   
   $mode_edition=0;
   if(isset($_GET['id']) AND !empty($_GET['id']))
   {
    
       $patient_id=htmlspecialchars($_GET['id']);
       $info_patient=$base->prepare('SELECT * FROM patients WHERE id=?');
       $info_patient->execute(array($patient_id));

       

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
   
    <!-- Custom Stylesheet -->
    <link href="../plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

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
        <div class="nav-header "  style="background-color: #6fd96f;">
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
                           
                           
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="../images/user/prof.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            
                            <div class="dropdown-content-body">
                            <ul>
                                        <li>
                                            <a href="profile.html"><i class="icon-user"></i> <span><?php  echo $userinfo['nom'].' '.$userinfo['prenom']; ?></span></a>
                                        </li>
                                        <li>
                                        <span><?php  echo $userinfo['numtelephone']; ?></span>
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
                            <i class="fa fa-user-md menu-icon"></i><span class="nav-text">Mon carnet</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="moncarnet.php?id=<?php echo $_SESSION['id'];?>">Mon carnet</a></li>
                            
                        </ul>
                    </li>
                   
                 
                    
                    
                   
                    
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Connexion</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="connexion_patient.php">Connexion</a></li>
                           
                           
                           
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
                <h2 class="text-center mt-3">Renseignements généraux</h2>
            </div>
            <?php
                $donnees=$info_patient->fetch()
                        
            ?>
            <section class="container">
            <div class="container mt-5 p-3 text-white" style="border: 2px solid #7571f9; border-radius:10px; background-color:#7571f9;">
                <div class="row justify-content-start">
                    <div class="col-4" style="font-weight: bold; font-size:large;"> Nom</div>
                    <div class="col-4"><?php echo $donnees['nom']; ?></div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-4" style="font-weight: bold; font-size:large;"> Prénom</div>
                    <div class="col-4"><?php echo $donnees['prenom']; ?></div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-4" style="font-weight: bold; font-size:large;"> Sexe</div>
                    <div class="col-4"><?php echo $donnees['sexe']; ?></div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-4" style="font-weight: bold; font-size:large;"> Age</div>
                    <div class="col-4"><?php echo $donnees['age']; ?></div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-4" style="font-weight: bold; font-size:large;"> Date de naissance</div>
                    <div class="col-4"><?php echo $donnees['dateNaissance']; ?></div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-4" style="font-weight: bold; font-size:large;"> Adresse</div>
                    <div class="col-4"><?php echo $donnees['adresse']; ?></div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-4" style="font-weight: bold; font-size:large;"> Numero de téléphone</div>
                    <div class="col-4"><?php echo $donnees['numtelephone']; ?></div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-4" style="font-weight: bold; font-size:large;"> Langue</div>
                    <div class="col-4"><?php echo $donnees['langue']; ?></div>
                </div>
                
                <div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: 20px;">
                    <div class="mt-auto p-2 bd-highlight" style="font-size: 30px; font-weight:bold;"><?php echo $donnees['id']; ?></div>
                </div>
            </div> 

            </section>
            <div class="container">
            <div class="row">
                    <div class="col-12">
                        
                        <div class="card mt-5">
                        <h2  class="text-center mt-3">Carnet de vaccination d'un enfant</h2>
                            <div class="card-body">
                                <h4 class="card-title">Calendrier Vaccinal PEV</h4>
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                    </div>
                                </div>
                                <section>
                                        <table class="table  table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>Vaccins</th>
                                                    <th>Ages</th>
                                                    <th>Date de rendez-vous du prochain vaccin</th> 
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr>
                                                <th>BCG + Polio 0 + Hep B</th>
                                                <td>Dès la naissance</td>
                                                <td><?php echo $donnees['rdvPenta1']; ?></td>
                                               
                                            </tr>
                                            
                                            <tr>
                                                <th>Penta 1 + VPO 1 + Rota 1+ PCV 13_1</th>
                                                <td>6 semaines après la naissance</td>
                                                <td><?php echo $donnees['rdvPenta2']; ?></td>
                                               
                                            </tr>
                                            <tr>
                                                <th>Penta 2 + VPO 2 + Rota 1+ PCV 13_2</th>
                                                <td>10 semaines après la naissance</td>
                                                <td><?php echo $donnees['rdvPenta3']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Penta 3 + VPO 3 + PCV 13_3 + VPI</th>
                                                <td>14 semaines après la naissance</td>
                                                <td><?php echo $donnees['rdvVitaminea']; ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <th>Vitamine A</th>
                                                <td> 6 mois après la naissance</td>
                                                <td><?php echo $donnees['rdvRR']; ?></td>
                                               
                                            </tr>
                                            <tr>
                                                <th>RR (Rougeole Rubéole)</th>
                                                <td> 9 mois après la naissance</td>
                                                <td><?php echo $donnees['rdvVAA']; ?></td>
                                               
                                            </tr>
                                            <tr>
                                                <th>VAA (Fièvre jaune)</th>
                                                <td> 9 mois après la naissance</td>
                                                <td><?php echo $donnees['rdvVAA']; ?></td>
                                               
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>

                        <div class="card mt-5">
                        <h2  class="text-center mt-3">Carnet de vaccination femme enceinte</h2>
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                    </div>
                                </div>
                                <section>
                                        <table class="table  table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>Vaccins</th>
                                                    <th>Période</th>
                                                    <th>Date de rendez-vous du prochain vaccin</th> 
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr>
                                                <th>vitamine 1</th>
                                                <td>Dès la confirmation de la grossèsse</td>
                                                <td><?php echo $donnees['rdvVit2']; ?></td>
                                               
                                            </tr>
                                            
                                            <tr>
                                                <th>vitamine 2</th>
                                                <td>1 mois après la grossèsse</td>
                                                <td><?php echo $donnees['rdvVit3']; ?></td>
                                               
                                            </tr>
                                            <tr>
                                                <th>vitamine 3</th>
                                                <td>6 mois après la grossèsse</td>
                                                <td><?php echo $donnees['rdvVit4']; ?></td>
                                               
                                            </tr>
                                            <tr>
                                                <th>Vitamine 4 + Vitamine 5</th>
                                                <td>1 an après la grossèsse</td>
                                                <td><?php echo $donnees['fin']; ?></td>
                                                
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
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
            <p>Copyright &copy; 2022 Tous les droits sont réservés</p>
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
    <script src="../plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../js/styleSwitcher.js"></script>

    
    <script src="./plugins/circle-progress/circle-progress.min.js"></script>
    
    <!-- ChartistJS -->
    
    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>

