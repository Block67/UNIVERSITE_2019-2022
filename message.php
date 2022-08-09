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

require 'twilio//vendor/autoload.php';
use Twilio\Rest\Client;
if(isset($_POST['envoyer'])){
    if (isset($_POST['number'], $_POST['message'])) {
        $sid    = "AC7f5d702aff1e841c0fc8926a719c493f"; 
        $token  = "cf20b0d7b243a851861f2a46dbd2d44a"; 
        $twilio = new Client($sid, $token); 
        
        $message = $twilio->messages 
                  ->create($_POST['number'], // to 
                           array(  
                               "messagingServiceSid" => "MGb6d3064ae1802e6aa17502b1898943c9",      
                               "body" => $_POST['message']
                           ) 
                  ); 
        
        echo 'succès';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>R-VACCIN</title>
   
    <!-- Custom Stylesheet -->
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

        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="email">
                                    <div class="compose-content mt-5">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <h2> RAPPEL DES PATIENTS POUR LA VACCINATION </h2></br>
                                                <input type="text" name="number" class="form-control bg-transparent" placeholder="Numero">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="textarea_editor form-control bg-light" name="message" id="" rows="5" cols="5" placeholder="Message ..."></textarea>
                                            </div>

                                                <div>
                                                    
                                            <label for="start">Date d'envoi:</label>

                                                    <input type="date" id="start" name="trip-start"
                                                        value="2018-07-22"
                                                        min="2022-01-01" max="2029-12-31">

                                                        <label for="appt">Heure d'envoi:</label>

                                                        <input type="time" id="appt" name="appt"
                                                            min="00:00" max="23:59" required>

                                                 </div>
                                            <input class="btn btn-primary m-b-30 m-t-15 f-s-14 p-l-20 p-r-20 m-r-10" type="submit" name="envoyer" value="Envoyer">
                                        </form>
                                    </div>
                                    <div class="text-left m-t-15">
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            
        </div>
    </div>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>