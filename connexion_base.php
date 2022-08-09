<?php
    try
    {
        $base= new PDO ("mysql:host=localhost;dbname=rvaccin1","root", "");
        //echo 'connexon réussie';
        
    }
    catch(Exception $e)
    {
        die("Erreur".$e->getMessage());
        echo 'echec echec';
    }
?>