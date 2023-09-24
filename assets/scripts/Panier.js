class Panier {
	constructor(el) {
		this._el = el; //Section affichant le panier
		
		this._detail = sessionStorage.getItem('detail'); //Détail de la commande

		this._montant = sessionStorage.getItem('montant'); //Montant total de la commande
		
		this._panier = JSON.parse(sessionStorage.getItem('panier')); //Panier contenu dans le sessionStorage
		
		this.ajouteCommande(this._detail, this._montant);		
	}
	
	//Ajouter la commande à la base de données
	ajouteCommande = (detail, montant) => {
		//Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        //Initialisation de la requête
        if (xhr) {

            //Ouverture de la requête : fichier recherché
            xhr.open('POST', `index.php?Commandes&cmd=insereCommande&detail=${detail}&montant=${montant}`);

            xhr.addEventListener('readystatechange', () => {

                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {
                        //Les données ont été reçues
						this.getInventaire(this._panier);

                    } else if (xhr.status === 404) {
                        console.log('Le fichier appelé dans la méthode open() n’existe pas.');
                    }
                }
            });

            //Envoi de la requête
            xhr.send();
        }
	}
	
	//Récupère l'inventaire du produit
	getInventaire = (panier) => {
		for(let produit of panier) {
			this.changeInventaire(produit.id, produit.inventaire);
		}
	}
	
	//Changer l'inventaire de l'article dans la base de données
	changeInventaire = (id, inventaire) => {
		//Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        //Initialisation de la requête
        if (xhr) {

            //Ouverture de la requête : fichier recherché
            xhr.open('POST', `index.php?Produits_AJAX&cmd=modifieInventaire&id=${id}&inventaire=${inventaire}`);

            xhr.addEventListener('readystatechange', () => {

                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {
						//Les données ont été reçues
                    } else if (xhr.status === 404) {
                        console.log('Le fichier appelé dans la méthode open() n’existe pas.');
                    }
                }
            });

            //Envoi de la requête
            xhr.send();
        }
	}
}