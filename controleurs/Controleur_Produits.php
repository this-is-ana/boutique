<?php
    class Controleur_Produits extends BaseControleur {
		
		//La fonction qui sera appelée par le routeur
        public function traite(array $params) {
			$this -> afficheVue("Entete");
			
            $donnees = array();
			
            if(isset($params["cmd"])) {
				$commande = $params["cmd"]; 
            } else {
                //Commande par défaut
                $commande = "accueil";
            }
			
            //Déterminer la vue appropriée
            switch($commande) {
				case "accueil":
					//Aller chercher le modèle pour les produits
					$modeleProduits = $this -> obtenirDAO("Produits");
					$donnees["nbProduits"] = count($modeleProduits -> obtenir_tous());
					$this -> afficheVue("Accueil", $donnees);
					break;
                default:
                    trigger_error("Action invalide.");
            }
			
			$this -> afficheVue("PiedDePage");
        }
    }
?>
