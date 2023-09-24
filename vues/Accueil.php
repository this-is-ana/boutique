<select name="filter" aria-label="Filtre" data-js-select>
	<option value="filtre" selected disabled hidden>Filtrer par</option>
	<option value="nom">Ordre alphabétique</option>
	<option value="prix asc">Prix ascendant</option>
	<option value="prix desc">Prix descendant</option>
</select>

<section class="grid-container" data-js-component="ListeProduits" data-js-nbProduits="<?= $donnees["nbProduits"] ?>"></section>
<button class="voirPlus" data-js-btn>Voir plus</button>