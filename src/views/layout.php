<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= $rootUri ?>/public/css/style.css?v=<?php echo random_int(1,1000);?>">
    <title>myWishList</title>
</head>
<body>
    <nav class="nav">
		<img src="<?= $rootUri ?>/public/images/logo.png" height="50">
		<span>
			<a class="link" href="<?= $router->pathFor('home') ?>">Accueil</a>
			<a class="link" href="<?= $router->pathFor('publicLists') ?>">Listes publiques</a>
			<?php if (isset($_SESSION['login'])) { ?>
			<a class="link" href="<?= $router->pathFor('accountLists') ?>">Mes listes</a>
			<a class="link" href="<?= $router->pathFor('newList') ?>">Créer liste</a>
			<?php } ?>
		</span>
		<span>
		<?php if (isset($_SESSION['login'])) { ?>
		<a class="link" href="<?= $router->pathFor('logout') ?>">Déconnexion</a>
		<a class="link" href="<?= $router->pathFor('account') ?>">Mon compte (<?= unserialize($_SESSION['login'])['username'] ?>)</a>
		<?php } else { ?>
		<a class="link" href="<?= $router->pathFor('register') ?>">Inscription</a>
		<a class="link" href="<?= $router->pathFor('login') ?>">Connexion</a>
		<?php } ?>
		</span>
	</nav>
    <div class="main">
        <?= $content ?>
    </div>

</body>
</html>