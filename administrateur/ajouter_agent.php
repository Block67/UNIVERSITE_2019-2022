<?php
session_start();
include("../connexion_base.php");
if (!$_SESSION['administrateur'] || $_SESSION['administrateur'] != true) {
    
 header('location:index.php');
   exit;
 }

 if(isset($_GET['id']) AND $_GET['id']>0)
   {
       $getid= intval($_GET['id']);
       $requser=$base->prepare("SELECT* FROM admins WHERE id=?");
       $requser->execute(array($getid));
       $userinfo=$requser->fetch();
       
   }
   
   
   if(isset($_POST['envoyer']))
   {
    
     $nom=htmlspecialchars($_POST['nom']);
     $prenom=htmlspecialchars($_POST['prenom']);
     $adresse=htmlspecialchars($_POST['adresse']);
     $numTel=htmlspecialchars($_POST['numTel']);
     $mail=htmlspecialchars($_POST['mail']);
     $mpasse=sha1($_POST['mpasse']);

        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['adresse']) AND
            !empty($_POST['numTel']) AND !empty($_POST['mail']) AND !empty($_POST['mpasse']))
            {
            
                            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                            {
            
                                $reqmail=$base->prepare("SELECT* FROM agent WHERE mail=?");
                                $reqmail->execute(array($mail));
                                $mailexist=$reqmail->rowcount();
                                if($mailexist==0)
                                {
            
                                    $requete=$base->prepare("INSERT INTO agent(nom,prenom,adresse,numTel,mail,mpasse) VALUES(?,?,?,?,?,?)");
                                    $requete->execute(array($nom,$prenom,$adresse,$numTel,$mail,$mpasse));
                                        $erreur="Votre compte a bien été créé";
                                        
                                
                                }else{
                                    $erreur="Ce mail existe deja.";
                                }
                                    
                            }else{
                                $erreur="Votre mail n'est pas valide";
                            }
            
            }else{
                $erreur="Remplissez tous les chanps";
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
                                <img src="../images/user/prof.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            
                            <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="profile.html"><i class="icon-user"></i> <span><?php  echo $userinfo['nomAdmin'].' '.$userinfo['prenomAdmin']; ?></span></a>
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
                            <li><a href="admin_dashboard.php?id=<?php echo $_SESSION['id'];?>">Dashboard</a></li>
                            
                        </ul>
                    </li>
                    <li class="nav-label"></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-user-md menu-icon"></i><span class="nav-text">Agent des santé</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="ajouter_agent.php?id=<?php echo $_SESSION['id'];?>">Ajouter Agent de santé</a></li>
                            
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
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Connexion</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php">Connexion</a></li>
                           
                           
                           
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
    <input type="email" class="form-control" name="mail" placeholder="Email" required>
  </div>
  <div class="col-12 col-lg-6 position-relative">
    <label for="mpasse" class="form-label fw-bold mt-2">Mot de passe</label>
    <input type="password" class="form-control" name="mpasse" placeholder="mot de passe" required>
  </div>
  <div class="col-12 mt-5">
  <button class="btn btn-primary" type="submit" name="envoyer" value="Envoyer">Ajouter Agent</button>
         
        
  </div>
</form>

      <?php
                   if(isset($erreur))
                   {
                       ?>
                       <div class="container pt-2 pb-2" align="center" style="border:1px solid #096A09; width:50%; background-color:white; border-radius:15px;">
                       <?php
                       echo '<font color="#EB0000" size="4em">'.$erreur.'<font/>';
                       ?>
                        </div>
                       <?php
                   }
             ?>


     
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

