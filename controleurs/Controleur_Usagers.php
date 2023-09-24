<?php
    class Controleur_Usagers extends BaseControleur {
		
        public function traite(array $params) {
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
                    //Afficher le formulaire d'ajout d'un usager
                    $this -> afficheVue("Entete");
                    $this -> afficheFormAjoutCommande();
                    $this -> afficheVue("PiedDePage");
                    break;
                case "insereUsager":
                    if(isset($params["nom"], $params["prenom"], $params["adresse"], $params["codepostal"], $params["courriel"])) {
						if(!isset($params["optin"])) $params["optin"] = 0;
						
						//Validation
                        $messageErreur = $this -> valideFormAjoutUsager($params["nom"], $params["prenom"], $params["adresse"], $params["codepostal"], $params["courriel"]);
						
						if($messageErreur == "") {
							if(!$this -> courrielExiste($params["courriel"])) {
								//Insertion du nouvel usager
								$modeleUsagers = $this -> obtenirDAO("Usagers");
								$nouvelUsager = new Usager(0, $params["nom"], $params["prenom"], $params["adresse"], $params["codepostal"], $params["courriel"], $params["optin"]);
								$modeleUsagers -> sauvegarde($nouvelUsager);
							}
							header("Location: index.php");
                        } else {
                            //Afficher le formulaire d'ajout d'un usager
                            $this -> afficheVue("Entete");
                            $this -> afficheFormAjoutCommande($messageErreur);
                            $this -> afficheVue("PiedDePage");   
                        }
                    } else {
                        trigger_error("Un ou plusieurs paramètres sont manquants.");
                    }
                    break;
				default:
                    trigger_error("Action invalide.");
            }
        }

        public function valideFormAjoutUsager($nom, $prenom, $adresse, $codepostal, $courriel) {
            $erreurs = "";

            $nom = trim($nom);
			$prenom = trim($prenom);
			$adresse = trim($adresse);
			$codepostal = trim($codepostal);
			$courriel = trim($courriel);

            if(!preg_match("/^[\p{Latin}\s\'-]{2,50}+$/u", $nom))
                $erreurs .= "<p>Le nom doit comporter entre 2 et 50 caractères.</p>";
				
			if(!preg_match("/^[\p{Latin}\s\'-]{2,50}+$/u", $prenom))
                $erreurs .= "<p>Le prénom doit comporter entre 2 et 50 caractères.</p>";
				
			if($adresse == "")
                $erreurs .= "<p>L'adresse ne peut être vide.</p>";

            if(!preg_match("/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/", $codepostal))
				$erreurs .= "<p>Le code postal doit être dans un format H0H 0H0</p>";
				
			if(!preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/", $courriel))
				$erreurs .= "<p>Le courriel doit être dans un format valide.</p>";

            return $erreurs;
        }
		
		public function courrielExiste($courriel) {
			//Déterminer si le courriel est déjà dans la base de données
			$modeleUsagers = $this -> obtenirDAO("Usagers");
			$courrielExiste = $modeleUsagers -> usager_par_courriel($courriel);
			return $courrielExiste;
		}

        public function afficheFormAjoutCommande($messageErreur = "") {
            //Afficher le formulaire d'ajout d'un usager
            //Aller porter les erreurs dans la vue
            $donnees["erreurs"] = $messageErreur;
            $this -> afficheVue("FormulaireAjoutCommande", $donnees);
        }
    }
?>