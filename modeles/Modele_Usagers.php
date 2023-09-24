<?php
    class Modele_Usagers extends BaseDAO {
        public function getNomTable() {
            return "usagers";
        }

        public function getClePrimaire() {
            return "id";
        }

		public function usager_par_courriel($courriel) {
			$requete = "SELECT courriel FROM usagers WHERE courriel = :c";
            $requetePreparee = $this -> db -> prepare($requete);
            $requetePreparee -> bindParam(":c", $courriel);
            $requetePreparee -> execute();
			if($requetePreparee -> rowCount() > 0 )
				return true;
			else
				return false;
		}
		
        public function sauvegarde(Usager $usager) {
			//Ajout d'un nouvel usager
			$requete = "INSERT INTO usagers(nom, prenom, adresse, codepostal, courriel, optin) VALUES (:n,:p,:a,:cp,:c,:o)";
			$requetePreparee = $this -> db -> prepare($requete);
			$nom = $usager -> getNom();
			$prenom = $usager -> getPrenom();
			$adresse = $usager -> getAdresse();
			$codepostal = $usager -> getCodePostal();
			$courriel = $usager -> getCourriel();
			$optin = $usager -> getOptin();
			$requetePreparee -> bindParam(":n", $nom);
			$requetePreparee -> bindParam(":p", $prenom);
			$requetePreparee -> bindParam(":a", $adresse);
			$requetePreparee -> bindParam(":cp", $codepostal);
			$requetePreparee -> bindParam(":c", $courriel);
			$requetePreparee -> bindParam(":o", $optin);
			$requetePreparee -> execute();
			
			if($requetePreparee -> rowCount() > 0)
				return $this -> db -> lastInsertId();
			else
				return false;
        }
    }

?>