<?php
	foreach($donnees["produits"] as $produit) {
?>
	<article data-js-id="<?= $produit -> getId() ?>">
		<div class="image-container">
			<img src="<?= $produit -> lienimage ?>">
		</div>
		<div class="image-bottom">
			<h2 data-js-nom><?= $produit -> getNom() ?></h2>
			<h3 data-js-prix><?= $produit -> getPrix() ?>$</h3>
			<p style="display:none" data-js-inventaire="<?= $produit -> getInventaire() ?>"></p>
		</div>
	</article>
<?php
	}
?>