<?php

    class Produit {
        private $idProduit;
        private $nomProduit;
        private $prixProduit;
        private $lienImageProduit;
		private $inventaireProduit;

        public function __construct($id = 0, $nom = '', $prix = 0, $lienImage = '', $inventaire = 0) {
            $this -> id = $id;
            $this -> nom = $nom;
            $this -> prix = $prix;
			$this -> lienImage = $lienImage;
            $this -> inventaire = $inventaire;
        }

        public function getId() {
            return $this -> id;
        }

        public function getNom() {
            return $this -> nom;
        }
		
        public function getPrix() {
            return $this -> prix;
        }
		
        public function getLienImage() {
            return $this -> lienImage;
        }
		
		public function getInventaire() {
			return $this -> inventaire;
		}
    }

?>