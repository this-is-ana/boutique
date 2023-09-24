<?php
    class Commande {
        private $idCommande;
        private $detailCommande;
        private $montantCommande;

        public function __construct($id = 0, $detail = '', $montant) {
            $this -> id = $id;
            $this -> detail = $detail;
            $this -> montant = $montant;
        }

        public function getId() {
            return $this -> id;
        }

        public function getDetail() {
            return $this -> detail;
        }
		
        public function getMontant() {
            return $this -> montant;
        }
    }
?>