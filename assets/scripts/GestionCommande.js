class GestionCommande {
	constructor(el) {
		this._el = el; //Section qui gère la commande
		
		this._elPanier = this._el.querySelector('[data-js-component="Panier"]'); //Section qui affiche le panier
		
		this._elForm = this._el.querySelector('[data-js-component="Form"]'); //Section qui affiche le formulaire
		
		this._elArticles = this._elPanier.querySelector('[data-js-articles]'); //Contenant du détail des articles dans le panier
		
		this._elTotal = this._elPanier.querySelector('[data-js-total]'); //Total de la commande
		
		this._elBtnCommande = this._elPanier.querySelector('[data-js-commander]'); //Bouton pour passer la commande
		
		this._elRetour = this._elForm.querySelector('[data-js-retour]'); //Élément pour retourner à la commande
		
		this._panier = JSON.parse(sessionStorage.getItem('panier')); //Tableau d'articles dans le sessionStorage

		this.init();
	}

	//Traitement initial de la commande
	init = () => {
		let iconePanier = document.querySelector('[data-js-panier]'); //Icône pour aller au panier			
		iconePanier.classList.add('non-disponible');
		
		this._elForm.classList.add('hidden');
						
		this._elArticles.addEventListener('change', this.changeQuantite);
		
		this._elBtnCommande.addEventListener('click', this.passeCommande);
		
		this._elRetour.addEventListener('click', this.revoirPanier);
		
		this.affichePanier();
	}
	
	//Afficher les articles sélectionnés dans le panier
	affichePanier = () => {
		let txt = '';
		
		//Peupler le tableau des valeurs du sessionStorage panier
		for (let item of this._panier) {
			txt += `<tr data-js-id="${item.id}">
						<td data-js-nom>${item.nom}</td>
						<td data-js-prix>${item.prix}</td>
						<td data-js-inventaire="${item.inventaire}">
							<input type="number" value="${item.quantite}" min="0" data-js-quantite>
						</td>
						<td data-js-montant>${this.calculeMontant(item.prix, item.quantite)}</td>
					</tr>`;
		}
		
		this._elArticles.innerHTML = txt;
		
		this.calculeTotal();
	}
	
	//Calcule le montant d'un article selon son prix et sa quantité
	calculeMontant = (prix, quantite) => {
		return prix * quantite;
	}

	//Calcule le montant total des articles
	calculeTotal = () => {
		let montants = this._elArticles.querySelectorAll('[data-js-montant]'),
			total = 0;
		
		//Additionner les montants des articles du panier
		for(let montant of montants) {
			total += parseInt(montant.innerHTML);
		}
		
		this._elTotal.innerHTML = total;
	}
	
	//Changer le total de l'article selon le changement de quantité
	changeQuantite = (e) => {
		let quantite = e.target.parentNode,
			montant = quantite.nextElementSibling,
			total = this.calculeMontant(quantite.previousElementSibling.innerHTML, e.target.value);
		
		montant.innerHTML = total;
		
		this.calculeTotal();
	}
	
	//Ajouter les valeurs du panier dans un sessionStorage
	passeCommande = () => {
		let detail = [];
		
		if(this._elTotal.innerHTML > 0) {
			sessionStorage.setItem('montant', this._elTotal.innerHTML);
			let produit = [];
	
			for(let item of this._elArticles.children) {				
				let quantite = item.querySelector('[data-js-quantite]').value,
					nom = item.querySelector('[data-js-nom]').innerHTML,
					id = item.dataset.jsId,
					prix = item.querySelector('[data-js-prix]').innerHTML,
					inventaire = item.querySelector('[data-js-inventaire]').dataset.jsInventaire;
				
				if(quantite > 0)
					detail.push(`${quantite} ${nom}`);
					
				produit.push({'id': id, 'nom': nom, 'prix': prix, 'inventaire': inventaire - quantite, 'quantite': quantite});		
			}
			
			this.modifiePanier(produit);
			
			sessionStorage.setItem('detail', detail.join(', '));
			
			this._elForm.classList.remove('hidden');
			this._elPanier.classList.add('hidden');
		}
	}
	
	//Modifier la quantité des produits dans le sessionStorage
	modifiePanier = (produit) => {	
		sessionStorage.setItem('panier', JSON.stringify(produit));
	}
	
	//Retour vers l'affichage du panier
	revoirPanier = () => {
		this._elPanier.classList.remove('hidden');
		this._elForm.classList.add('hidden');
	}
}