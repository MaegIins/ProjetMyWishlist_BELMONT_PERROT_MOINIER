<h1>Ajouter un nouvel item à votre liste</h1>
<br />
<form method="POST" enctype="multipart/form-data">
        <p>Donnez un nom à l'item</p>
        <input required type="text" placeholder="Nom" name="nom">
        <p>Ajoutez une description à l'item</p>
        <textarea required placeholder="Description" name="descr" rows="3"></textarea>
        <p>Indiquez le prix de l'item</p>
        <input required type="number" step="0.01" min="0" max="99999999.99" placeholder="Prix de l'item" name="tarif">
		<p>Ajoutez une image à votre item</p>
		<br />
        <input type="file" name="img">
		<br />
        <a href="<?= $router->pathFor('list', ['token' => $list->token])?>" role="button">Annuler</a>
        <button type="submit" name="submit">Ajouter l'item</button>
</form>
<br />
<h1>Utiliser un item existant</h1>
<select name="selectItem">
	<?php foreach($allItems as $i) { ?>
	<option><?= $i->nom?></option>
	<?php }?>
</select>
<button type="submit" name="submit">Ajouter l'item</button>
<br />
<br />
<?php foreach($allItems as $i) { ?>
	<img src="../public/images/<?= $i->img?>" height="100">
	<label><?= $i->nom?></label>
	<br />
	<br />
<?php } ?>