class Produit {
	constructor(el) {
        this._el = el; //Article
		
		this._id = this._el.dataset.jsId; //Id de l'article
		
		this._nom = this._el.querySelector('[data-js-nom]').innerHTML; //Nom de l'article
		
		this._prix = parseInt(this._el.querySelector('[data-js-prix]').innerHTML); //Prix de l'article
		
		this._inventaire = this._el.querySelector('[data-js-inventaire]').dataset.jsInventaire; //Inventaire de l'article
		
		this._quantite = 0; //Quantité de départ
		
		this._produit = {'id': this._id, 
						 'nom': this._nom, 
						 'prix': this._prix, 
						 'inventaire': this._inventaire,
						 'quantite': this._quantite 
						};				
				
		this.init();
	}
	
	//Traitement initial du produit
	init = () => {
		if(this._produit.inventaire == 0)
			this._el.classList.add('non-disponible'); //Rendre non disponible un article épuisé
		
		this._el.addEventListener('click', this.ajouteAuPanier);
	}
	
	//Ajouter l'article au panier
	ajouteAuPanier = () => {
		let btnPanier = document.querySelector('[data-js-btnPanier]'), //Bouton pour aller au panier
			iconePanier = document.querySelector('[data-js-panier]'), //Icône pour aller au panier
			spanDecompte = document.querySelector('[data-js-articlesPanier]'), //Afficher nombre d'articles dans le panier
			decompte = 0;
			
		btnPanier.classList.remove('hidden');
		iconePanier.classList.remove('non-disponible');
						
		this._produit.quantite = ++this._produit.quantite; //Augmenter la quantité au clic

		if(sessionStorage.getItem('panier')) {
			let lePanier = JSON.parse(sessionStorage.getItem('panier'));
			
			if(!lePanier.includes(lePanier.find(produit => produit.id == this._produit.id)))
				lePanier.push(this._produit); //Si l'article n'est pas déjà dans le panier, l'ajouter
			
			for(let i = 0; i < lePanier.length; i++) {
				if(lePanier[i].id == this._id)
					lePanier[i] = this._produit; //Mettre à jour le produit
						
				 decompte += lePanier[i].quantite;
			}
			
			sessionStorage.setItem('panier', JSON.stringify(lePanier));
		} else {
			sessionStorage.setItem('panier', JSON.stringify([this._produit])); //Ajout du produit au panier
			++decompte;
		}
		
		sessionStorage.setItem('decompte', decompte);
		spanDecompte.innerText = sessionStorage.getItem('decompte');
	}
}