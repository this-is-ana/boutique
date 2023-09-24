<?php
    class Controleur_Produits_AJAX extends Controleur_Produits {
		
		//La fonction qui sera appelée par le routeur
        public function traite(array $params) {
			
            $donnees = array();
			
            if(isset($params["cmd"])) {
				$commande = $params["cmd"]; 
            } else {
                //Commande par défaut
                $commande = "afficheListe";
            }
			
			//Aller chercher le modèle pour les produits
            $modeleProduits = $this -> obtenirDAO("Produits");
			
			//Déterminer la vue et le modèle approprié
            switch($commande) {
				case "afficheListe":		
					//Afficher les produits selon l'ordre et la limite
                    if(isset($params["ordre"], $params["limit"])) {
                        $donnees["produits"] = $modeleProduits -> obtenir_produits($params["ordre"], $params["limit"]);
                        $this -> afficheVue("AfficheListeProduits", $donnees);
                    } else {
						$donnees["produits"] = $modeleProduits -> obtenir_produits('id', 12);
						$this -> afficheVue("AfficheListeProduits", $donnees);
                    }
					break;
				case "modifieInventaire":
					if(isset($params["id"], $params["inventaire"])) {
						//Modifier l'inventaire du produit
						$modification = $modeleProduits -> modifier_inventaire($params["id"], $params["inventaire"]);
					} else {
                        trigger_error("Un ou plusieurs paramètres sont manquants.");
                    }
					break;
                default:
                    trigger_error("Action invalide.");
            }
        }
    }
?>
