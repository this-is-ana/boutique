<?php
    abstract class BaseDAO {
        //Objet PDO contenant une connexion à la base de données
        protected $db;

        public function __construct(PDO $connexion) {
            $this -> db = $connexion;
        }

        //Méthodes abstraites à être définies plus tard
        abstract function getNomTable();
        abstract function getClePrimaire();

        //Lecture(READ)
        public function obtenir_par_id($id) {
            $requete = "SELECT * FROM " . $this -> getNomTable() . " WHERE " . $this -> getClePrimaire() . "=:id";
            $requetePreparee = $this -> db -> prepare($requete);
            $requetePreparee -> bindParam(":id", $id);
            $requetePreparee -> execute();

            //Retour de l'identifiant de la dernière insertion
            return $requetePreparee;
        }

        public function obtenir_tous() {
            $requete = "SELECT * FROM " . $this -> getNomTable();
            $resultats = $this -> db -> query($requete);
            return $resultats;
        }

        //Suppression (DELETE)
        public function supprime($id) {
            $requete = "DELETE FROM " . $this -> getNomTable() . " WHERE " . $this -> getClePrimaire() . "=:id";
            $requetePreparee = $this -> db -> prepare($requete);
            $requetePreparee -> bindParam(":id", $id);
            $requetePreparee -> execute();

            //Retour du nombre de rangées affectées 
            return $requetePreparee -> rowCount();
        }
    }

?>