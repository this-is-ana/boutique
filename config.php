<?php
	
	//Définition de la racine du projet
	define("RACINE", $_SERVER["DOCUMENT_ROOT"] . "/tp2/");
	//Définition des constantes de connexion à la base de données
	define("DBTYPE", "mysql");
	define("HOST", "localhost");
	define("DBNAME", "boutique");
	define("USER", "root");
	define("PWD", "");

	//Définition de la fonction d'autoload
	function mon_autoloader($classe) {
		//Liste des répertoires à fouiller pour trouver les classes
		$repertoires = array(
			RACINE . "controleurs/",
			RACINE . "modeles/",
			RACINE . "lib/",
			RACINE . "vues/"
		);

		foreach($repertoires as $rep) {
			if(file_exists($rep . $classe . ".php")) {
				require_once($rep . $classe . ".php");
				return;
			}
		}
	}

	//Enregistrer cette fonction comme étant notre autoloader
	spl_autoload_register("mon_autoloader");
?>