<?php
   session_start();
   $_SESSION['administrateur'] = false;

   include("../connexion_base.php");

  if(isset($_POST['connexionadmin']))
   {
       $mailconnect=htmlspecialchars($_POST['mailconnect']);
       $mpasseconnect=sha1($_POST['mpasseconnect']);

      if(!empty($_POST['mailconnect']) AND !empty($_POST['mpasseconnect']))
      {
       $requser=$base->prepare("SELECT* FROM admins WHERE mail=? AND mot_passe=?");
       $requser->execute(array($mailconnect,$mpasseconnect));
       $userexist=$requser->rowcount();

       if($userexist==1)
       {
        $userinfo=$requser->fetch();
        $_SESSION['administrateur'] = true;
        $_SESSION['id']=$userinfo['id'];
      
          header("Location:admin_dashboard.php?id=".$_SESSION['id']);
       }else{
           $erreur="Mauvais mail ou mot de passe";
       }


      }else{
          $erreur="Tous leschamps doivent être remplis !";
      }
   }
?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>R-Vaccin</title>
    <!-- Favicon icon -->
    
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="../css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
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

    



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.php"> <h2 style="color:#6fd96f ;">R-vaccin</h2></a>
                                <h4 class="text-center mt-2">Connexion des administrateurs</h4>
        
                                <form class="mt-5 mb-5 login-input" method="POST" action="" >
                                    <div class="form-group">
                                        <input type="email" class="form-control"  name="mailconnect" id="mail" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="mpasseconnect" id="mot_passe" placeholder="Mot de passe">
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit" name="connexionadmin" value="Connexion" id="connexion" style="background-color:#6fd96f ;">Connexion</button>
                                    
                                </form>
                               <!-- <p class="mt-5 login-form__footer">Dont have account? <a href="page-register.html" class="text-primary">Sign Up</a> now</p>-->
                               <?php
                  if(isset($erreur))
                  {
                      echo '<font color="#EB0000" size="4em">'.$erreur.'<font/>';
                  }
             
             ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../js/styleSwitcher.js"></script>
</body>
</html>





