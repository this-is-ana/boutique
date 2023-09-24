<?php

	class Routeur {
		
	   // Obtenir le controleur qui devra traiter la requète
       public static function route() {
            //Obtenir la query string (tout ce qui se trouve à droite du ? dans la requête)
            $queryString = $_SERVER["QUERY_STRING"];

            if($queryString != "") {
                $posEperluette = strpos($queryString, "&");
                if($posEperluette === false) {
                    //Pas de paramètres (ex: index.php?Films)
                    $controleur = $queryString;
                } else {
                    //Avec paramètres (ex: index.php?Films&cmd=valeur)
                    $controleur = substr($queryString, 0, $posEperluette);
                }
            } else {
                //Définir le contrôleur par défaut
                $controleur = "Produits";
            }

            //On a déterminé le nom du contrôleur
            //Chaque classe controleur s'appelle Controleur_NomControleur
            $classe = "Controleur_" . $controleur;
			
			//Vérifier que la classe existe
            if(class_exists($classe)) {
                //Instanciation dynamique de classe
                $objControleur = new $classe;

                if($objControleur instanceof BaseControleur) {
                    //Appeller la fonction traite de la classe Contrôleur instanciée pour traiter la requête
                    $objControleur -> traite($_REQUEST); //Passer en paramètre les variables de la requète HTTP
                } else {
                    trigger_error("Erreur 404! Contrôleur invalide.");
                }

            } else
                trigger_error("La classe $classe n'existe pas.");
       }
   } 

?>