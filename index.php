<?php

    header('Content-Type: application/json;');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: POST, DELETE, PUT, OPTIONS");
    header('Access-Control-Allow-Headers: Content-Type');
    require_once'./controlleurs/videos.php';
    $controlleurVideos = new ControlleurVideo;

    switch($_SERVER['REQUEST_METHOD']) {
        case'GET':
            if(isset($_GET['id'])) { 
            $controlleurVideos->afficherFicheJSON($_GET['id']);
            } else{
            $controlleurVideos->afficherJSON();
            }
        break;
        case'POST': 
            $corpsJSON= file_get_contents('php://input');
            $data= json_decode($corpsJSON, TRUE);
            $controlleurVideos->ajouterJSON($data);
        break;
        case'PUT': 
            if(isset($_GET['id'])) {
            $corpsJSON= file_get_contents('php://input');
            $data= json_decode($corpsJSON, TRUE);
            $controlleurVideos->modifierJSON($data);
            }else{
                echo "Identifiant Manquant";
            }
        break;
        case'DELETE': 
            if(isset($_GET['id'])) {
            $controlleurVideos->supprimerJSON($_GET['id']);
            }
            else{
                echo "Identifiant Manquant";
            }
        break;
        default:
    }
?>