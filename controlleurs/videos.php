<?php

require_once './modeles/videos.php';

class ControlleurVideo {

//Afficher toutes les videos

    function afficherJSON() {
        $video= modele_video::ObtenirTous();
        echo json_encode($video);
        }


//Afficher la video by id


    function afficherFicheJSON() {
        $erreur = new stdClass();
        if(isset($_GET["id"])) {
            $video = modele_video::ObtenirUn($_GET["id"]);
            if($video) { 
                echo json_encode($video);
            } else {
                $erreur->message = "Aucune video trouvée";
                echo json_encode($erreur);
            }
        } else {
            $erreur->message = "L'identifiant (id) de la video à afficher est manquant dans l'url";
            echo json_encode($erreur);
        }
    }


// ajouter une video

function ajouterJSON($data) {
    $resultat= new stdClass();
    if(isset($data['id']) && 
        isset($data['nom']) && 
        isset($data['description_video']) && 
        isset($data['code']) && 
        isset($data['image_video']) && 
        isset($data['categorie']) && 
        isset($data['date_publication']) && 
        isset($data['duree']) && 
        isset($data['nombres_vues']) && 
        isset($data['score']) && 
        isset($data['utilisateur'])) {
        $resultat->message= modele_video::ajouter($data['id'], 
                                                    $data['nom'], 
                                                    $data['description_video'], 
                                                    $data['code'], 
                                                    $data['image_video'], 
                                                    $data['categorie'], 
                                                    $data['date_publication'], 
                                                    $data['duree'], 
                                                    $data['nombres_vues'], 
                                                    $data['score'], 
                                                    $data['utilisateur']);
    } else{
        $resultat->message= "Impossible d'ajouter une video. Des informations sont manquantes";
        echo json_encode($erreur);
    }
    echo json_encode($resultat);
    }


    // modifier

    function modifierJSON($data) {
        $resultat= new stdClass();
        if(isset($_GET['id']) && 
        isset($data['nom']) && 
        isset($data['description_video']) && 
        isset($data['code']) && 
        isset($data['image_video']) && 
        isset($data['categorie']) && 
        isset($data['date_publication']) && 
        isset($data['duree']) && 
        isset($data['nombres_vues']) && 
        isset($data['score']) && 
        isset($data['utilisateur'])) {
        $resultat->message= modele_video::modifier($_GET['id'], 
                                                        $data['nom'], 
                                                        $data['description_video'], 
                                                        $data['code'], 
                                                        $data['image_video'], 
                                                        $data['categorie'], 
                                                        $data['date_publication'], 
                                                        $data['duree'], 
                                                        $data['nombres_vues'], 
                                                        $data['score'], 
                                                        $data['utilisateur']);
        } else{
        $resultat->message= "Impossible de modifier la video. Des informations sont manquantes";
        //require'./vues/erreur.php';
        echo json_encode($erreur);
        }
        echo json_encode($resultat);
        }


            /***
     * Fonction permettant de supprimer un produit
     */
    function supprimerJSON() {
        if(isset($_GET['id'])) {
            $message = modele_video::supprimer($_GET['id']);
            echo $message;
        } else {
            $erreur = "Impossible de supprimer la video. Des informations sont manquantes";
            //echo json_encode($erreur);
        }
    }

}

?>