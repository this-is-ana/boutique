<?php
    class Controleur_Commandes extends BaseControleur {
		
        public function traite(array $params) {
			$this -> afficheVue("Entete");
			
			$donnees = array();

            if(isset($params["cmd"])) {
				$commande = $params["cmd"]; 
            } else {
                //Commande par défaut
                $commande = "afficheFormulaireAjout";
            }
        
            //Déterminer la vue et le modèle approprié
            switch($commande) {
                case "afficheFormulaireAjout":
                    //Afficher le formulaire d'ajout d'une commande
                    $this -> afficheFormAjoutCommande();
                    break;
                case "insereCommande":
                    if(isset($params["detail"], $params["montant"])) {
						//Validation
                        $messageErreur = $this -> valideFormAjoutCommande($params["detail"], $params["montant"]);
                        if($messageErreur == "") {
                            //Insertion de la nouvelle commande
                            $modeleCommandes = $this -> obtenirDAO("Commandes");
                            $nouvelleCommande = new Commande(0, $params["detail"], $params["montant"]);
                            $modeleCommandes -> sauvegarde($nouvelleCommande);
							header('Location: index.php'); //Redirection
                        } else {
                            //Afficher le formulaire d'ajout d'une commande
                            $this -> afficheFormAjoutCommande($messageErreur);  
                        }
                    } else {
                        trigger_error("Un ou plusieurs paramètres sont manquants.");
                    }
                    break;
				default:
                    trigger_error("Action invalide.");
            }
			
			$this -> afficheVue("PiedDePage");
        }

        public function valideFormAjoutCommande($detail, $montant) {
            $erreurs = "";

            $detail = trim($detail);

			if($montant <= 0)
				$erreurs .= "<p>Le montant doit être plus grand que 0.</p>";
			
			if($detail == "")
                $erreurs .= "<p>Veuillez choisir une quantité.</p>";

            return $erreurs;
        }

        public function afficheFormAjoutCommande($messageErreur = "") {
            //Afficher le formulaire d'ajout d'une commande
            //Aller porter les erreurs dans la vue
            $donnees["erreurs"] = $messageErreur;
            $this -> afficheVue("FormulaireAjoutCommande", $donnees);
        }
    }
?>