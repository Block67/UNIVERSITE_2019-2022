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
   
   //
   $mode_edition=0;
   if(isset($_GET['edit']) AND !empty($_GET['edit']))
   {
    $mode_edition=1;
       $edit_id=htmlspecialchars($_GET['edit']);
       $modifier_patient=$base->prepare('SELECT * FROM patients WHERE id=?');
       $modifier_patient->execute(array($edit_id));
       if($modifier_patient->rowCount() ==1)
       {
           $modifier_patient=$modifier_patient->fetch();
          
       }else{
           die('Ce carnet n\'existe pas');
       }

   }

   if(isset($_POST['envoyer']))
   {
    $nom=htmlspecialchars($_POST['nom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $sexe=htmlspecialchars($_POST['sexe']);
    $adresse=htmlspecialchars($_POST['adresse']);
    
    $age=htmlspecialchars($_POST['age']);
    $numtelephone=htmlspecialchars($_POST['numtelephone']);
    $dateNaissance=htmlspecialchars($_POST['dateNaissance']);
    $langue=htmlspecialchars($_POST['langue']);
    $rolee=htmlspecialchars($_POST['rolee']);
     

     
            if($mode_edition==0)
            {
                $requete=$base->prepare("INSERT INTO patients(nom,prenom,sexe,adresse,numtelephone,age,
                                                dateNaissance,langue,rolee ) VALUES(?,?,?,?,?,?,?,?,?)");
                           $requete->execute(array($nom,$prenom,$sexe,$adresse,$numtelephone,$age,$dateNaissance,$langue,$rolee));
                           
            }else{
                $update=$base->prepare('UPDATE patients SET nom=?,prenom=?,sexe=?,adresse=?,
                                                            numtelephone=?,age=?, dateNaissance=?,langue=?, rolee=? WHERE id=?');
                $update->execute(array($nom,$prenom,$sexe,$adresse,$numtelephone,$age,$dateNaissance,$langue,$rolee,$edit_id));
               
                $message='Informations mise à jour';
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
        <div class="container">
       <p class="text-center"> <b>Modification</b></p> 

      <form method="POST" action="" >
      <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Calendrier Vaccinal PEV</h4>
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                    </div>
                                </div>
                                <section  class="row g-3">
                                <div class="col-12 col-lg-6 position-relative">
                                        <label for="nom" class="form-label fw-bold">Nom</label>
                                        <input type="text" class="form-control" name="nom" value="<?=$modifier_patient['nom']?>" required>
                                    </div>
                                    <div class="col-12 col-lg-6 position-relative">
                                        <label for="prenom" class="form-label fw-bold">Prénoms</label>
                                        <input type="text" class="form-control" name="prenom" value="<?=$modifier_patient['prenom']?>"  required>
                                    </div>
                                    <div class="col-12 col-lg-6 position-relative">
                                        <label class="form-label mt-2" for="sexe">Sexe</label>
                                                <select class="form-control" name="sexe">
                                                    <option value="<?=$modifier_patient['sexe']?>"><?=$modifier_patient['sexe']?> </option>
                                                    <option value="feminin">Féminin</option>
                                                    <option value="maxculin">Maxculin</option>      
                                                </select>
                                    </div>
                                    <div class="col-12 col-lg-6 position-relative">
                                        <label for="adresse" class="form-label fw-bold mt-2">Adresse</label>
                                        <input type="text" class="form-control" name="adresse" value="<?=$modifier_patient['adresse']?>" required>
                                    </div>
                                    <div class="col-12 col-lg-6 position-relative">
                                        <label for="numtelephone" class="form-label fw-bold mt-2">Numéro de Téléphone</label>
                                        <input type="text" class="form-control" name="numtelephone" value="<?=$modifier_patient['numtelephone']?>" required>
                                    </div>
                                    <div class="col-12 col-lg-6 position-relative">
                                        <label for="age" class="form-label fw-bold mt-2">Age</label>
                                        <input type="text" class="form-control" name="age"  value="<?=$modifier_patient['age']?>" placeholder="Ex:1 mois ou 20 ans" required>
                                    </div>
                                    <div class="col-12 col-lg-6 position-relative">
                                        <label for="dateNaissance" class="form-label fw-bold mt-2">Date de naissance</label>
                                        <input type="date" class="form-control" name="dateNaissance" value="<?=$modifier_patient['dateNaissance']?>" placeholder="Date de naissance du patient" required>
                                    </div>
                                    <div class="col-12 col-lg-6 position-relative">
                                        <label class="form-label mt-2" for="langue">Langue</label>
                                                <select class="form-control" name="langue">
                                                    <option value="<?=$modifier_patient['langue']?>"><?=$modifier_patient['langue']?></option>
                                                    <option value="Bariba">Bariba</option>
                                                    <option value="Dendi">Dendi</option>  
                                                    <option value="Ditamari">Ditamari</option>
                                                    <option value="Fon">Fon</option>    
                                                    <option value="Idatcha">Idatcha</option>
                                                    <option value="Fulfulde">Fulfulde</option>
                                                    <option value="Nago">Nago</option>
                                                    
                                                </select>
                                    </div>

                                    <div class="col-12 col-lg-6 position-relative">
                                        <label class="form-label mt-2" for="rolee">Attribut</label>
                                                <select class="form-control" name="rolee">
                                                    <option value="<?=$modifier_patient['rolee']?>"><?=$modifier_patient['rolee']?></option>
                                                    <option value="nourrisson">Nourrisson</option>
                                                    <option value="femmeEnceinte">Femme enceinte</option>      
                                                </select>
                                    </div>
                                       
                                </section>
                                <div class="col-12 mt-5">
         
 
                                    <button class="btn btn-primary" type="submit" name="envoyer" value="Envoyer">Mettre à jour</button>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>

      </form>
      <form method="POST" action="" class="row g-3">
  
</form>


      <div class="container pt-2 pb-2" align="center" style="border:1px solid #096A09; width:50%; background-color:white; border-radius:15px;">
      <?php
                  if(isset($message))
                  {
                      echo '<font color="#096A09" size="4em">'.$message.'<font/>';
                  }
             
             ?>


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
    <!-- Pignose Calender -->
    <script src="./plugins/moment/moment.min.js"></script>
    <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="./plugins/chartist/js/chartist.min.js"></script>
    <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>

    
     




    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>




