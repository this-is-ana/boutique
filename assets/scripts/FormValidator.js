class FormValidator {
    constructor(el) {
        this._el = el; //Le formulaire
		
		this._elInputs = this._el.querySelectorAll('[data-js-input]'); //Tous les champs avec dataset data-js-input
		
		this._emailRegex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/; //Regex pour courriel
		
		this._postalRegex = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/; //Regex pour code postal
		
		this._creditRegex = /^(4[0-9]{12}(?:[0-9]{3})?)|(?:5[1-5][0-9]{14})|(?:3[47][0-9]{13})$/; //Regex pour carte de crédit
		
		this._codeRegex = /^\d{3}$/; //Regex pour code de 3 chiffres

        this._isValid = true; //Booléen, valeur retournée par la validation

        this.validateInputs();
    }
	
	//Valide les champs du formulaire
	validateInputs = () => {
		for(let elInput of this._elInputs) {
			let closestElWrapper = elInput.closest('[data-js-input-wrapper]'),
				elErrorMsg = closestElWrapper.querySelector('[data-js-error-msg]'),
				elInputDataset = elInput.dataset.jsInput,
				msg = '', regex;

			switch(elInputDataset) {
				case 'Code postal':
					msg = `Le code postal saisi n'est pas valide.`;
					regex = this._postalRegex;
					break;
				case 'Courriel':
					msg = `L'adresse courriel saisie n'est pas valide.`;
					regex = this._emailRegex;
					break;
				case 'Carte de crédit':
					msg = `Le numéro de carte de crédit saisi n'est pas valide.`;
					regex = this._creditRegex;
					break;
				case 'Code de sécurité':
					msg = `Le code de sécurité doit être composé de 3 chiffres.`;
					regex = this._codeRegex;
					break;
			}
			
			if(elInput.required && elInput.value == '') {
				msg = `Le champ ${elInputDataset} est obligatoire.`;
				this.addError(closestElWrapper, elErrorMsg, msg);
            } else {
				this.removeError(closestElWrapper, elErrorMsg);
			}
			
			if(regex) {
				if(regex.test(elInput.value.replace(/\s/g, '')))
					this.removeError(closestElWrapper, elErrorMsg);
				else
					this.addError(closestElWrapper, elErrorMsg, msg);
			}
		}
	}
	
	//Retourne la validité du formulaire
    get isValid() {
        return this._isValid;
    }
	
	//Gère le cas où il y a des erreurs dans l'input
	addError = (el, elErrorMsg, msg) => {
        el.classList.add('error');
        elErrorMsg.textContent = msg;
        this._isValid = false;
    }
	
	//Gère le cas où l'erreur est corrigée
    removeError = (el, elErrorMsg) => {
        el.classList.remove('error');
        elErrorMsg.textContent = '';
    }
}