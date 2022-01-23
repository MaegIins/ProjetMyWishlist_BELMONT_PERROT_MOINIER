<?php if (isset($_SESSION['login'])) { ?>
    <h1>Créez une nouvelle liste</h1>
	<br />
    <form method="POST" action="<?= $router->pathFor('newList') ?>">
		<p>Donnez un titre à la liste</p>
		<input required type="text" placeholder="Titre" name="titre">
            <p>Indiquez une date d'expiration</p>
            <input required type="date" placeholder="Date expiration" name="expiration">
            <p>Ajoutez une description à la liste</p>
            <textarea required placeholder="Description" name="description" id="description" rows="3"></textarea>
            <p>Publique</p>
			<input type="checkbox" name="public">
			<br />
            <button type="submit">Créer la liste</button>
    </form>
<?php } else { ?>
    <h1>Vous n'etes pas connecté</h1>
<?php } ?>
