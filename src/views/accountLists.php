<?php if (isset($_SESSION['login'])) { ?>
    <h1>Mes listes (<?= sizeof($lists)?>)</h1>
        <?php if (sizeof($lists) >= 1) { ?>
            <?php foreach ($lists as $list) { ?>
                <div class="list">
					<h1 class="title"><?= $list->titre ?></h1>
                    <?php if ($list->public) { ?>
					<p>Liste publique</p>
                    <?php } else { ?>
					<p>Liste privée</p>
					<?php } ?>
					<p class="desc"><?= $list->description ?></p>
					<?php if (strtotime($list->expiration) > strtotime("-1 days")) { ?>
					<p class="date">Liste valide jusqu'au : <?= date("d/m/Y", strtotime($list->expiration)) ?></p>
					<?php } else { ?>
					<p class="date" style="color: red">Expirée depuis le : <?= date("d/m/Y", strtotime($list->expiration)) ?></p>
					<?php } ?>
					<a href='<?= $router->pathFor('list', ['token' => $list->token]) ?>' class="stretched-link"></a>
					<button onclick="window.location.href = '/editList/<?= $list->token?>'">Modifier Liste</button>
					<button onclick="window.location.href = '/list/<?= $list->token?>'">Voir Contenu</button>
					<button onclick="window.location.href = '/ajouterItem/<?= $list->token?>'">Ajouter Item</button>
				</div>
            <?php } ?>
		<?php } else { ?>
		<p>Aucune liste trouvée</p>
		<?php } ?>
    <br />
        <a href="<?= $router->pathFor('newList')?>">Créer une nouvelle liste</a>
<?php } else { ?>
<h1>Vous n'êtes pas connecté.</h1>
<?php } ?>