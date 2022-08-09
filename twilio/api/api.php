<?php
require '../vendor/autoload.php';
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="number" placeholder="Numero"><br>
        <textarea name="message" id="" cols="70" rows="20"></textarea><br>
        <input type="submit" name="envoyer" value="Envoyer">
    </form>
</body>
</html>
