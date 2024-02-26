<?php

require_once './modeles/avis.php';

class ControlleurAvis {

//Afficher l'avis by id

    function afficherAvisJSON() {
        $erreur = new stdClass();
        if(isset($_GET["id"])) {
            $avis = modele_avis::ObtenirAvisTous($_GET["id"]);
            if($avis) { 
                echo json_encode($avis);
            } else {
                $erreur->message = "Aucun avis trouvé pour cette video";
                echo json_encode($erreur);
            }
        } else {
            $erreur->message = "L'identifiant (id) de l'avis à afficher est manquant dans l'url";
            echo json_encode($erreur);
        }
    }

//Ajouter un avis

function ajouterAvisJSON($data) {
    $resultat= new stdClass();
    if(isset($data['id_avis']) && 
        isset($data['note']) && 
        isset($data['commentaire']) && 
        isset($data['id_video'])) {
        $resultat->message= modele_avis::ajouterAvis($data['id_avis'], 
                                                    $data['note'], 
                                                    $data['commentaire'], 
                                                    $data['id_video']);
    } else{
        $resultat->message= "Impossible d'ajouter un avis. Des informations sont manquantes";
        echo json_encode($erreur);
    }
    echo json_encode($resultat);
    }

}

?>