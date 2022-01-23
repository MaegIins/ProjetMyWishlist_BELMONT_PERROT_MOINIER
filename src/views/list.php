<h1><?= htmlspecialchars($list->titre)?></h1>
<?php if (sizeof($items) >= 1) { ?>
	<?php foreach ($items as $item) { ?>
		<?php
		$fileName = 'noimage.png';
		if(file_exists('./public/images/' . $item->img)) {
			$fileName = $item->img;
		}
		?>
		<div class="list">
			<h1 class="title"><?= $item->nom ?></h1>
			<br />
			<img src="../public/images/<?= $fileName ?>" height="200">
			<br />
			<p class="desc"><?= $item->descr ?></p>
			<h1 class="tarif">Tarif: <?= $item->tarif ?></h1>
		</div>
	<?php } ?>
<?php } else { ?>
<p>Aucun item trouvé</p>
<?php } ?>