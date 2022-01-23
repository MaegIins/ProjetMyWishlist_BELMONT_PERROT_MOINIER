<?php if (isset($_SESSION['accountCreated'])) : ?>
    <div class="alert alert-success">Compte créé avec succès !</div>
    <?php unset($_SESSION['accountCreated']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['redirect']['msg'])) {
    echo $_SESSION['redirect']['msg'];
    unset($_SESSION['redirect']['msg']);
} ?>

<h1>Bienvenue sur le projet MyWishList</h1>

<img src="<?= $rootUri ?>/public/images/logo.png">

<p>Selectionnez une action depuis la navbar ci-dessus</p>

<small>Par Tristan BELMONT Mathis PEROT Thomas MOINIER (S3C)</small>
