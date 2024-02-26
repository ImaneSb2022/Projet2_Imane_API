<?php

require_once "./include/config.php";

class modele_video {
    public $id; 
    public $nom; 
    public $description_video;
    public $code;
    public $image_video;
    public $categorie; 
    public $date_publication; 
    public $duree;
    public $nombres_vues;
    public $score;
    public $utilisateur;


    public function __construct($id, $nom, $description_video, $code,  $image_video, $categorie, $date_publication, $duree, $nombres_vues,  $score,  $utilisateur) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description_video = $description_video;
        $this->code = $code;
        $this->image_video = $image_video;
        $this->categorie = $categorie;
        $this->date_publication = $date_publication;
        $this->duree = $duree;
        $this->nombres_vues = $nombres_vues;
        $this->score = $score;
        $this->utilisateur = $utilisateur;
    }

    static function connecter() {
        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);
      
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error; 
            exit();
        } 
        return $mysqli;
    }

    
    public static function ObtenirTous() {
        $liste = [];
        $mysqli = self::connecter();

        $resultatRequete = $mysqli->query("SELECT id, nom, description_video, code,  image_video, categorie, date_publication, duree, nombres_vues,  score,  utilisateur FROM `video` ORDER BY id");

        foreach ($resultatRequete as $enregistrement) {
            $liste[] = new modele_video($enregistrement['id'], 
                                        $enregistrement['nom'], 
                                        $enregistrement['description_video'],
                                        $enregistrement['code'],
                                        $enregistrement['image_video'],
                                        $enregistrement['categorie'], 
                                        $enregistrement['date_publication'], 
                                        $enregistrement['duree'], 
                                        $enregistrement['nombres_vues'], 
                                        $enregistrement['score'], 
                                        $enregistrement['utilisateur']
            );
        }
        return $liste;
    }

    public static function ObtenirUn($id) {
        $video = [];
        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("SELECT id, nom, description_video, code,  image_video, categorie, date_publication, duree, nombres_vues,  score,  utilisateur FROM `video` WHERE id=? ORDER BY id")) {  
            $requete->bind_param("i", $id); 

            $requete->execute();

            $result = $requete->get_result(); 

            if($enregistrement = $result->fetch_assoc()) {

                $video[] = new modele_video($enregistrement['id'], 
                                                $enregistrement['nom'], 
                                                $enregistrement['description_video'],
                                                $enregistrement['code'],
                                                $enregistrement['image_video'],
                                                $enregistrement['categorie'], 
                                                $enregistrement['date_publication'], 
                                                $enregistrement['duree'], 
                                                $enregistrement['nombres_vues'], 
                                                $enregistrement['score'], 
                                                $enregistrement['utilisateur']
                    );

            } else {

                return null;
            }   
            
            $requete->close(); 
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : ";  
            echo $mysqli->error;
            return null;
        }
        return $video;
    }

// Ajouter


    public static function ajouter($id, $nom, $description_video, $code,  $image_video, $categorie, $date_publication, $duree, $nombres_vues,  $score,  $utilisateur) {
        $message = '';

        $mysqli = self::connecter();
        
    
        if ($requete = $mysqli->prepare("INSERT INTO video(id, nom, description_video, code,  image_video, categorie, date_publication, duree, nombres_vues,  score,   utilisateur) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {      


        $requete->bind_param("issssssiiis", $id, $nom, $description_video, $code,  $image_video, $categorie, $date_publication, $duree, $nombres_vues,  $score,  $utilisateur);

        if($requete->execute()) { 
            $message = "video ajoutée";  
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


    public static function modifier($id, $nom, $description_video, $code,  $image_video, $categorie, $date_publication, $duree, $nombres_vues,  $score, $utilisateur) {
        $message = '';

        $mysqli = self::connecter();
        
        if ($requete = $mysqli->prepare("UPDATE video SET nom=?, description_video=?, code=?,  image_video=?, categorie=?, date_publication=?, duree=?, nombres_vues=?,  score=?, utilisateur=? WHERE id=?")) {      

        $requete->bind_param("ssssssiiisi", $nom, $description_video, $code,  $image_video, $categorie, $date_publication, $duree, $nombres_vues,  $score,  $utilisateur, $id);

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