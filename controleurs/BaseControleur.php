<?php
    abstract class BaseControleur {
		
		//La fonction qui sera appellée par le routeur
        public abstract function traite(array $params);
		
		//Fonction héritée par les contrôleurs pour afficher la vue partielle appelée 
        public function afficheVue($nomVue, $donnees = null) {
            $cheminVue = RACINE . "vues/" . $nomVue . ".php";
            
            if(file_exists($cheminVue)) {
                //N.B. le paramètre $donnees sera utilisé DIRECTEMENT dans la vue
                include_once($cheminVue);
            } else {
                trigger_error("Erreur 404! La vue spécifiée est introuvable.");
            }
        }

        public function obtenirDAO($nomModele) {
            $classe = "Modele_" . $nomModele;

            if(class_exists($classe)) {
                //Création de la connexion à la base de données (les constantes sont dans config.php)
                $connexionPDO = DBFactory::getDB(DBTYPE, DBNAME, HOST, USER, PWD);

                //Création d'une instance de la classe Modele_$nomModele
                $objetModele = new $classe($connexionPDO);

                if($objetModele instanceof BaseDAO)
                    return $objetModele;
                else
                    trigger_error("Modèle invalide!");  
                
            } else
                trigger_error("La classe $classe n'existe pas.");
        }
    }

?>