<h1>Listes publiques (<?= sizeof($lists)?>)</h1>
<div class="body">
    <?php if ($lists->count() > 0) { ?>
        <?php foreach ($lists as $list) { ?>
			<div class="list">
				<h1 class="title"><?= $list->titre ?></h1>
				<p class="desc"><?= $list->description ?></p>
				<?php if (strtotime($list->expiration) > strtotime("-1 days")) { ?>
				<p class="date">Liste valide jusqu'au : <?= date("d/m/Y", strtotime($list->expiration)) ?></p>
				<?php } else { ?>
				<p class="date" style="color: red">Expirée depuis le : <?= date("d/m/Y", strtotime($list->expiration)) ?></p>
				<?php } ?>
				<a href='<?= $router->pathFor('list', ['token' => $list->token]) ?>'></a>
				<button onclick="window.location.href = '/list/<?= $list->token?>'">Voir Contenu</button>
			</div>
        <?php } ?>
    <?php } else { ?>
        <h3>Aucune liste publique trouvée</h3>
    <?php } ?>
</div>