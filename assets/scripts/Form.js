class Form {
    constructor(el) {
        this._el = el; //Section contenant le formulaire
		
		this._elForm = this._el.querySelector('form'); //Le formulaire
		
        this._elSubmit = this._elForm.querySelector('[data-js-submit]'); //Bouton Soumettre du formulaire
		
		this._elParams = this._elForm.querySelectorAll('[data-js-param]'); //Inputs ayant un dataset data-js-param
		
		this._elThank = this._el.parentNode.querySelector('[data-js-thank]'); //Div qui indique la fin de la commande
				
        this.init();
    }

	//Traitement initial du formulaire
    init = () => {
        this._elSubmit.addEventListener('click', this.valideForm);	
	}
	
	//Vérifier le formulaire avant l'envoi des données
	valideForm = (e) => {
		e.preventDefault();

		let formValidation = new FormValidator(this._elForm); //Valider le formulaire

		if(formValidation.isValid) {
			this._params = ''; //Initialise les paramètres
			let paramValue = ''; //Initialise la valeur des champs à récupérer

			for (let param of this._elParams) {
				if(param.type == 'text' || param.type == 'email') paramValue = encodeURIComponent(param.value);
	
				if(param.type == 'checkbox') 
					param.checked ? paramValue = param.value : paramValue = 0;

				let paramKey = param.dataset.jsParam;

				//Construit les paramètres avec la clé récupée du dataset du champ et sa valeur
				this._params += `&${paramKey}=${paramValue}`;
			}
						
			this.ajouteUsager(this._params);
		}
    }
	
	//Ajoute l'usager à la base de données
	ajouteUsager = (params) => {
		//Déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        //Initialisation de la requête
        if (xhr) {

            //Ouverture de la requête : fichier recherché
            xhr.open('POST', 'index.php?Usagers&cmd=insereUsager');
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.addEventListener('readystatechange', () => {

                if (xhr.readyState === 4) {							
                    if (xhr.status === 200) {
                        // Les données ont été reçues
                        // Traitement du DOM
						this.remercier();

                    } else if (xhr.status === 404) {
                        console.log('Le fichier appelé dans la méthode open() n’existe pas.');
                    }
                }
            });

            // Envoi de la requête
            xhr.send(params);
        }
	}
	
	//Fin de la commande, remercier le client
	remercier = () => {
        this._el.classList.add('hidden');
        this._elThank.classList.remove('thank--hidden');
		
		new Panier(); //Ajouter la commande

		setTimeout(function(){
            window.location.href = 'index.php';
        }, 5000);
		
		 //Vider le panier/sessionStorage
		sessionStorage.removeItem('decompte');
		sessionStorage.removeItem('montant');
		sessionStorage.removeItem('detail');
		sessionStorage.removeItem('panier');
    }
}