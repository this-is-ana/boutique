<section data-js-component="GestionCommande">

	<section data-js-component="Panier">
		<h2>Confirmation de la commande</h2>
		<table>
			<thead>
				<tr>
					<th>Articles</th>
					<th>Prix</th>
					<th>Quantité</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody data-js-articles></tbody>
		</table>
		<h3>Total : <span data-js-total></span>$</h3>
		<button data-js-commander>Passer la commande</button>
		<?php
			if($donnees["erreurs"] != "")
		?>
		<p class="error-message"><?= $donnees["erreurs"] ?></p>
	</section>
	
	<section data-js-component="Form">
		<form action="index.php?Usagers" method="post">
			<h2>Coordonnées</h2>
			<div class="input-wrapper" data-js-input-wrapper>
				<label for="nom" class="required">Nom de famille</label> 
				<input type="text" name="nom" required data-js-param="nom" data-js-input="Nom de famille"/>
				<small class="error-message" data-js-error-msg></small>
			</div>
			<div class="input-wrapper" data-js-input-wrapper>
				<label for="prenom" class="required">Prénom</label> 
				<input type="text" name="prenom" required data-js-param="prenom" data-js-input="Prénom"/>
				<small class="error-message" data-js-error-msg></small>
			</div>
			<div class="input-wrapper" data-js-input-wrapper>
				<label for="adresse" class="required">Adresse</label>
				<input type="text" name="adresse" required data-js-param="adresse" data-js-input="Adresse"/>
				<small class="error-message" data-js-error-msg></small>
			</div>
			<div class="input-wrapper" data-js-input-wrapper>
				<label for="codepostal" class="required">Code postal</label>
				<input type="text" name="codepostal" required data-js-param="codepostal" data-js-input="Code postal"/>
				<small class="error-message" data-js-error-msg></small>
			</div>
			<div class="input-wrapper" data-js-input-wrapper>
				<label for="courriel" class="required">Courriel</label> 
				<input type="email" name="courriel" required data-js-param="courriel" data-js-input="Courriel"/>
				<small class="error-message" data-js-error-msg></small>
			</div>	
			<div class="input-wrapper" data-js-input-wrapper>
				<label for="optin">S'inscrire à l'infolettre</label> 
				<input type="checkbox" name="optin" value="1" data-js-param="optin"/>
			</div>
			<div class="infoCarte">
				<h2>Informations de paiement</h2>
				<div class="input-wrapper" data-js-input-wrapper>
					<label for="carteCredit" class="required">Carte de crédit (Visa / Mastercard / American Express)</label>
					<input type="text" name="carteCredit" pattern="[0-9\s]{13,19}" maxlength="19" required data-js-input="Carte de crédit"/>
					<small class="error-message" data-js-error-msg></small>
				</div>
				<div class="expiration input-wrapper" data-js-input-wrapper>
					<label for="expiration" class="required">Expiration</label>
					<select name="mois" required data-js-input="Expiration">
						<option value="" selected disabled hidden>Mois</option>
						<option value="01">Janvier</option>
						<option value="02">Février</option>
						<option value="03">Mars</option>
						<option value="04">Avril</option>
						<option value="05">Mai</option>
						<option value="06">Juin</option>
						<option value="07">Juillet</option>
						<option value="08">Août</option>
						<option value="09">Septembre</option>
						<option value="10">Octobre</option>
						<option value="11">Novembre</option>
						<option value="12">Decembre</option>
					</select>
					<select name="annee" required data-js-input="Expiration">
						<option value="" selected disabled hidden>Année</option>
						<option value="21"> 2021</option>
						<option value="22"> 2022</option>
						<option value="23"> 2023</option>
						<option value="24"> 2024</option>
						<option value="25"> 2025</option>
						<option value="26"> 2026</option>
					</select>
					<small class="error-message" data-js-error-msg></small>
				</div>
				<div class="input-wrapper securite" data-js-input-wrapper>
					<label for="codeSecurite" class="required">Code de sécurité :</label> 
					<input class="smallInput" type="text" name="codeSecurite" pattern="\d{3}" maxlength="3" 
						title="Code de 3 chiffres" required data-js-input="Code de sécurité"/>
					<small class="error-message" data-js-error-msg></small>
				</div>
			</div>
			<input type="hidden" name="cmd" value="insereUsager"/>
			<input type="submit" value="Soumettre" data-js-submit/>
		</form>
		<?php
			if($donnees["erreurs"] != "")
		?>
		<div class="error-message"><?= $donnees["erreurs"] ?></div></br>
		
		<h3 data-js-retour>&#60; Retour à la commande</h3>
	</section>

	<div class="thank thank--hidden" data-js-thank>
		<h2>Merci !</h2>
		
		<a href="index.php">&#60; Continuez votre visite</a>
	</div>
	
</section>