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
   
 



     $reponse=$base->query("SELECT id, nom, prenom, sexe, adresse, numtelephone, rolee FROM patients WHERE rolee='nourrisson' ORDER BY id DESC");
            
    if(isset($_GET['recherche']) AND !empty($_GET['recherche'])){
        $recherche=htmlspecialchars($_GET['recherche']);
        $reponse= $base->query('SELECT id, nom, prenom, sexe, adresse, numtelephone, rolee FROM patients WHERE rolee="nourrisson" AND nom LIKE "%'.$recherche.'%" ORDER BY id DESC');
        if($reponse->rowCount() == 0) {
            $reponse= $base->query('SELECT id, nom, prenom, sexe, adresse, numtelephone, rolee FROM patients WHERE rolee="nourrisson" AND prenom LIKE "%'.$recherche.'%" ORDER BY id DESC');
        }
        if($reponse->rowCount() == 0) {
            $reponse= $base->query('SELECT id, nom, prenom, sexe, adresse, numtelephone, rolee FROM patients WHERE rolee="nourrisson" AND numtelephone LIKE "%'.$recherche.'%" ORDER BY id DESC');
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
                           
                            <li><a href="listepatient.php?id=<?php echo $_SESSION['id'];?>" aria-expanded="false">Liste des enfants</a></li>
                            <li><a href="listefemme.php?id=<?php echo $_SESSION['id'];?>" aria-expanded="false">Liste des femmes enceintes</a></li>
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
                        <li><a href="statistique.php?id=<?php echo $_SESSION['id'];?>">Stat_global</a></li>
                            <li><a href="statenfant.php?id=<?php echo $_SESSION['id'];?>">Stat_enfants</a></li>
                            
                            
                        </ul>
                    </li>
                    
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Notification</span>
                        </a>
                        <ul aria-expanded="false">
                          
                            <li><a href="message.php?id=<?php echo $_SESSION['id'];?>">Message</a></li>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Liste des Enfants (Nourrisson)</h4>
                                <div class="table-responsive">
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                    
                                    </div>
                                    <div class="col-4">
                                        <form method='GET'>
                                            <div>
                                            <input type='search' placeholder='recherche' class="form-control" name="recherche" autocomplete="off"/>
                                            <input type='submit' name="envoyer" value="Rechercher" class="mt-2 mb-2 text-white pt-1 pb-1 pl-3 pr-3" style="background-color: #6fd96f; border:none;"/>
                                            </div>
                                            
                                           
                                        </form>
                                    </div>
                                </div>
                                
                                <section>
                                <?php
                                    if($reponse->rowCount()>0){
                                        ?>
                                        <table class="table  table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Sexe</th>
                                                    <th>Adresse</th>
                                                    <th>Num Téléphone</th>
                                                    <th>Rôle</th>
                                                    <th>Voir</th>
                                                    <th>Carnet</th>
                                                </tr>
                                            </thead>
                                            <?php
                                        while($donnees=$reponse->fetch())
                                        {
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $donnees['nom']; ?></td>
                                                <td><?php echo $donnees['prenom']; ?></td>
                                                <td><?php echo $donnees['sexe']; ?></td>
                                                <td><?php echo $donnees['adresse']; ?></td>
                                                <td><?php echo $donnees['numtelephone']; ?></td>
                                                <td><?php echo $donnees['rolee']; ?></td>
                                                <td class="fs-1">
                                                    <a href="infopatient.php?patient=<?= $donnees['id']?>" class="text-success"><i class="fa fa-eye" style="font-size: 30px; color:#003399;"></i></a>
                                                </td>
                                                <td class="fs-1">
                                                    <a href="editioncarnet.php?edit=<?= $donnees['id']?>" class=""><i class="fa fa-pencil-square-o" style="font-size: 30px; color:#22780F;"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                            <?php
                                        }
                                        ?>
                                        <tfoot>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Sexe</th>
                                                <th>adresse</th>
                                                <th>numtelephone</th>
                                                <th>rolee</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php
                                        $reponse->closecursor();
                                    ?>
                                    <?php

                                    }else{
                                        ?>
                                        <p>Aucun utilisateur trouvé</p>
                                        <?php
                                    }

                                    ?>
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
    

     <!--table-->
     <!--<script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>-->
     




    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>







           
