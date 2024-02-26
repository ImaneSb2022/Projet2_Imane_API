<?php
        header('Content-Type: application/json;');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST, DELETE, PUT, OPTIONS");
        header('Access-Control-Allow-Headers: Content-Type');
    require_once'./controlleurs/avis.php';
    $ControlleurAvis = new ControlleurAvis;

    switch($_SERVER['REQUEST_METHOD']) {
        case'GET':
            $ControlleurAvis->afficherAvisJSON($_GET['id']);
        break;
        case'POST':
            $corpsJSON= file_get_contents('php://input');
            $data= json_decode($corpsJSON, TRUE);
            $ControlleurAvis->ajouterAvisJSON($data);
        break;
        default:
    }
?>