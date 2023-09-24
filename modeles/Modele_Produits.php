<?php
    class Modele_Produits extends BaseDAO {
        public function getNomTable() {
            return "produits";
        }

        public function getClePrimaire() {
            return "id";
        }
		
		public function obtenir_tous() {
			$resultats = parent::obtenir_tous();
            $produits = $resultats -> fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Produit"); //Fetch un tableau de produits
            return $produits;
		}

        public function obtenir_produits($order, $limit) {
            $requete = "SELECT * FROM produits ORDER BY " . $order . " LIMIT " . $limit;
            $resultats = $this -> db -> query($requete);
            $produits = $resultats -> fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Produit"); //Fetch un tableau de produits
            return $produits;
        }
		
		public function modifier_inventaire($id, $inventaire) {
			$requete = "UPDATE produits SET inventaire = :i WHERE id = :id";
            $requetePreparee = $this -> db -> prepare($requete);
            $requetePreparee -> bindParam(":id", $id);
            $requetePreparee -> bindParam(":i", $inventaire);
            $requetePreparee -> execute();

            //Retour du nombre de rangées affectées
			if($requetePreparee -> rowCount() > 0)
				return $requetePreparee -> rowCount();
			else
                return false;
		}
    }

?>