<?php
    class Usager {
        private $idUsager;
        private $nomUsager;
		private $prenomUsager;
        private $adresseUsager;
        private $codepostalUsager;
		private $courrielUsager;
		private $optinUsager;

        public function __construct($id = 0, $nom = '', $prenom = '', $adresse = '', $codepostal = '', $courriel = '', $optin = 0) {
            $this -> id = $id;
            $this -> nom = $nom;
			$this -> prenom = $prenom;
            $this -> adresse = $adresse;
            $this -> codepostal = $codepostal;
			$this -> courriel = $courriel;
			$this -> optin = $optin;
        }

        public function getId() {
            return $this -> id;
        }

        public function getNom() {
            return $this -> nom;
        }
		
		public function getPrenom() {
            return $this -> prenom;
        }

        public function getAdresse() {
            return $this -> adresse;
        }

        public function getCodePostal() {
            return $this -> codepostal;
        }
		
		public function getCourriel() {
            return $this -> courriel;
        }
		
		public function getOptin() {
            return $this -> optin;
        }
    }
?>