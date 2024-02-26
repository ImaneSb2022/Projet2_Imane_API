<?php

require_once "./include/config.php";

class modele_avis {
    public $id_avis; 
    public $note; 
    public $commentaire;
    public $id_video;

    public function __construct($id_avis, $note, $commentaire, $id_video) {
        $this->id_avis = $id_avis;
        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->id_video = $id_video;
    }

    static function connecter() {
        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);
        
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
            exit();
        } 
        return $mysqli;
    }

    public static function ObtenirAvisTous($id) {

        $avis = [];
    
        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("SELECT id_avis, note, commentaire, id_video FROM `avis` WHERE id_video=? ORDER BY note")) { 
            $requete->bind_param("i", $id);

            $requete->execute();  

            $result = $requete->get_result(); 

            while ($enregistrement = $result->fetch_assoc()) {
                $avis[] = new modele_avis(
                    $enregistrement['id_avis'],
                    $enregistrement['note'],
                    $enregistrement['commentaire'],
                    $enregistrement['id_video']
                );
            }

            $requete->close(); 
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : "; 
            echo $mysqli->error;
            return null;
        }

        return $avis;

    }

// Ajouter

    public static function ajouterAvis($id_avis, $note, $commentaire, $id_video) {
        $message = '';

        $mysqli = self::connecter();
        
        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("INSERT INTO avis(id_avis, note, commentaire, id_video) VALUES(?, ?, ?, ?)")) {      

        $requete->bind_param("iisi", $id_avis, $note, $commentaire, $id_video);

        if($requete->execute()) { 
            $message = "Avis ajoutée";  
        } else {
            $message =  "Une erreur est survenue lors de l'ajout: " . $requete->error;  
        }

        $requete->close();

        } else  {
            echo "Une erreur a été détectée dans la requête utilisée : ";  
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return $message;
    }


    public static function modifier($id, $nom, $description_video, $code,  $image_video, $categorie, $date_publication, $duree, $nombres_vues,  $score,  $avis,  $utilisateur) {
        $message = '';

        $mysqli = self::connecter();
        
        if ($requete = $mysqli->prepare("UPDATE video SET nom=?, description_video=?, code=?,  image_video=?, categorie=?, date_publication=?, duree=?, nombres_vues=?,  score=?,  avis=?,  utilisateur=? WHERE id=?")) {      

        $requete->bind_param("ssssssiiissi", $nom, $description_video, $code,  $image_video, $categorie, $date_publication, $duree, $nombres_vues,  $score,  $avis,  $utilisateur, $id);

        if($requete->execute()) { 
            $message = "video modifiée";  
        } else {
            $message =  "Une erreur est survenue lors de l'édition: " . $requete->error;  
        }

        $requete->close(); 

        } else  {
            echo "Une erreur a été détectée dans la requête utilisée : ";
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return $message;
    }


    public static function supprimer($id) {
        $message = '';

        $mysqli = self::connecter();
        
        if ($requete = $mysqli->prepare("DELETE FROM video WHERE id=?")) {      

        $requete->bind_param("i", $id);

        if($requete->execute()) { 
            $message = "video supprimée";  
        } else {
            $message =  "Une erreur est survenue lors de la suppression de la video: " . $requete->error; 
        }

        $requete->close();

        } else  {
            echo "Une erreur a été détectée dans la requête utilisée : ";
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return $message;
    }

}

?>