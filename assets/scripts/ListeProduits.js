class ListeProduits {
	constructor(el) {
        this._el = el; //Section qui affiche la liste des produits
		
        this._elSelect = document.querySelector('[data-js-select]'); //Filtre
		
		this._elBtn = document.querySelector('[data-js-btn]'); //Bouton pour voir plus d'articles
		
		this._elNbProduits = document.querySelector('[data-js-nbProduits]').dataset.jsNbproduits; //Nombre total d'articles
		
		this._elBtnPanier = document.querySelector('[data-js-btnPanier]'); //Bouton pour aller au panier
		
		this._elIconePanier = document.querySelector('[data-js-panier]'); //Icône pour aller au panier
		
		this._order = 'id'; //Ordre par défaut
		
		this._limit = 12; //Nombre d'articles affiché par défaut
		
        this.init();
    }
	
	//Traitement initial de l'affichage des produits
	init = () => {
		let spanDecompte = document.querySelector('[data-js-articlesPanier]');
		
		if(!sessionStorage.getItem('panier')) {
			this._elBtnPanier.classList.add('hidden');
			this._elIconePanier.classList.add('non-disponible');
		} else {
			spanDecompte.innerText = parseInt(sessionStorage.getItem('decompte'));
		}
		
		this.afficheListe(this._order, this._limit);
		
		this._elSelect.addEventListener('change', (e) => {
			this._order = e.target.value; //Ordre selon la valeur du select
			this._limit = 12; //Limite revient à 12 lors du changement d'ordre
			
			this.afficheListe(this._order, this._limit);
		})
		
		this._elBtn.addEventListener('click', () => {
			this.voirPlus(this._limit);
		});
	}
	
	//Afficher la liste d'articles selon l'ordre et la limite
	afficheListe = (ordre, limit) => {
		//Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        //Initialisation de la requête
        if (xhr) {	

            // Ouverture de la requête : fichier recherché
            xhr.open('POST', `index.php?Produits_AJAX&cmd=afficheListe&ordre=${ordre}&limit=${limit}`);

            xhr.addEventListener('readystatechange', () => {

                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {

                        //Les données ont été reçues
                        //Traitement du DOM
                        this._el.innerHTML = xhr.responseText;
						
						//Si on arrive à la fin de la liste, le bouton pour voir plus disparaît
						limit >= this._elNbProduits ? this._elBtn.style.display = 'none' : this._elBtn.style.display = 'block';
						
						//Créer un nouvelle classe Produit pour chaque articles
						for (let article of this._el.children) {
							new Produit(article);
						}
                    } else if (xhr.status === 404) {
                        console.log('Le fichier appelé dans la méthode open() n’existe pas.');
                    }
                }
            });

            //Envoie de la requête
            xhr.send();
        }
	}
	
	//Détermine le nombre de produits affichés
	voirPlus = (limit) => {
		this._limit = limit + this._limit;
		this.afficheListe(this._order, this._limit);
	}
}