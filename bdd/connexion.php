<?php

session_start();

function connexionBDD(){
 
    include("paramCon.php");
    
    $dsn='mysql:host='.$lehost.';dbname='.$dbname;

    try { 
        $connex = new PDO($dsn, $user, $pass); 
        //echo "bdd oui";
        
    } catch (PDOException $e) {
        //echo 'Échec lors de la connexion : ' . $e->getMessage();
        //echo "bdd non";        
        die();
    }

    return $connex;
    
}


function deconnexionBDD($connex){
    $connex = null;
}

?>