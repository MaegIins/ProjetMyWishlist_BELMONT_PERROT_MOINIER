<?php if (!isset($_SESSION['login'])) { ?>
	<h1>S'inscrire au site</h1>
	<br />
    <form method="POST" action="<?= $router->pathFor('register') ?>" id="register">
		<p>Nom d'utilisateur</p>
		<input required type="text" placeholder="Nom d'utilisateur" name="identifiant" id="identifiant" maxlength="30" autofocus>
		<p>Prénom</p>
		<input required type="text" placeholder="Prénom" name="prenom" id="prenom" maxlength="40">
		<p>Nom</p>
		<input required type="text" placeholder="Nom" name="nom" id="nom" maxlength="40">
		<p>Email</p>
		<input required type="email" placeholder="Votre email" name="email" id="email" maxlength="100">
		<p>Mot de passe</p>
		<input required type="password" minlength="8" placeholder="Mot de passe (minimum 8 caractères)" name="password" maxlength="50">
		<input required type="password" minlength="8" placeholder="Confirmez votre mot de passe" name="confirmPassWord" maxlength="50">
		<div>
		Pas la bonne page ? 
		<a href="<?= $router->pathFor('login') ?>">Se connecter</a>
		</div>
		<button type="submit" class="btn btn-primary">Inscription</button>
    </form>
<?php } else { ?>
    <h1>Vous êtes connecté</h1>
<?php } ?>