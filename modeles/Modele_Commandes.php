<?php
    class Modele_Commandes extends BaseDAO {
        public function getNomTable() {
            return "commandes";
        }

        public function getClePrimaire() {
            return "id";
        }
		
        public function sauvegarde(Commande $commande) {
			//Ajout d'une nouvelle commande
			$requete = "INSERT INTO commandes(detail, montant) VALUES (:d, :m)";
			$requetePreparee = $this -> db -> prepare($requete);
			$detail = $commande -> getDetail();
			$montant = $commande -> getMontant();
			$requetePreparee -> bindParam(":d", $detail);
			$requetePreparee -> bindParam(":m", $montant);
			$requetePreparee -> execute();
			
			if($requetePreparee -> rowCount() > 0)
				return $this -> db -> lastInsertId();
			else
				return false;
        }
    }

?>