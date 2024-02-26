<?php
        header('Content-Type: application/json;');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST, DELETE, PUT, OPTIONS");
        header('Access-Control-Allow-Headers: Content-Type');
    require_once "../include/config.php";
    
    $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;   // Pour fins de débogage
            exit();
        } 

    switch($_SERVER['REQUEST_METHOD']) {

        case'PATCH': 

            $response = new stdClass();

            $response->message = "Augmenter le score";

            if(isset($_GET['id'])) { 
                
        
                if ($requete = $mysqli->prepare("UPDATE video SET score = score + 1 WHERE id=?")) {  
                    $requete->bind_param("i", $_GET['id']); 
        

                    if( $requete->execute()){
                        $response->message = "Score augmenté avec succés";
                    }else{
                        $response->message = "Erreur dans l'execution de la requête";
                    }

            } else{

                $response->message = "L'identifiant (id) de la video est manquant dans l'url";
            
            }
        break;
       
        }
    }
?>