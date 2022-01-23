<?php if (!isset($_SESSION['login'])) { ?>
	<h1>Se connecter au site</h1>
	<br />
    <form method="post" action="<?= $router->pathFor('login') ?>">
		<input required type="text" name="id" maxlength="100" placeholder="Email ou nom d'utilisateur">
		<input required type="password" name="password" maxlength="50" placeholder="Mot de passe">
		<div>
			Pas la bonne page ? 
			<a href="<?= $router->pathFor('register') ?>">S'inscrire</a>
		</div>
		<button type="submit">Connexion</button>
    </form>
<?php } else { ?>
    <h1>Vous êtes connecté</h1>
<?php } ?>
