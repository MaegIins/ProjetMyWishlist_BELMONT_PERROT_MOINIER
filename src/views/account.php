<?php if (isset($_SESSION['login'])) { ?>
		<h1>Vos Informations</h1>
		<br />
		<form method="POST" action="<?= $router->pathFor('editAccount') ?>">
			<p>Prénom</p>
			<input required type="text" name="prenom" placeholder="Prénom" value="<?= $account->prenom ?>">
			<p>Nom</p>
			<input required type="text" name="nom" placeholder="Nom" value="<?= $account->nom ?>">
			<p>Nom d'utilisateur</p>
			<input disabled type="text" name="username" placeholder="Nom d'utilisateur" value="<?= $account->username ?>">
			<p>Email</p>
			<input required type="email" name="email" placeholder="Email" value="<?= $account->email ?>">
			<br />
			<br />
			<a href="<?= $router->pathFor('home')?>" role="button">Retour</a>
			<button type="submit">Enregistrer les modifications</button>
		</form>
		<br />
		<h1>Changer Votre Mot de Passe</h1>
		<br />
		<form method="POST" action="<?= $router->pathFor('changePassword') ?>">
			<input required type="password" name="oldPassword"  placeholder="Ancien mot de passe">
			<input required type="password" name="newPassword"  placeholder="Nouveau mot de passe" minlength="8" maxlength="50">
			<input required type="password" name="confirmPassWord"  placeholder="Confirmez votre mot de passe" minlength="8" maxlength="50">
			<button type="submit">Confirmer</button>
		</form>


<?php } else { ?>
    <h1>Vous n'etes pas connecté</h1>
<?php } ?>

</script>
