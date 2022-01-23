<?php if (isset($_SESSION['login']) and $list->user_id == $account->id) { ?>
	<h1>Modifiez la liste</h1><br>
    <form method="POST">
		<p>Donnez un nouveau titre à la liste</p>
		<input required type="text" placeholder="Titre" name="titre" value="<?= htmlspecialchars($list->titre) ?>">
		<p>Indiquez une nouvelle date d'expiration</p>
		<input required type="date" value="<?= date("Y-m-d", strtotime($list->expiration)) ?>" name="expiration">
		<p>Changez une description à la liste</p>
		<textarea required name="description" id="description" rows="3"><?= htmlspecialchars($list->description) ?></textarea>
		<p>Publique</p>
		<input type="checkbox" <?= $list->public === 1 ? 'checked=\"checked\"' : ''?> name="public">
		<br />
		<a href="<?= $router->pathFor('list', ['token' => $list->token])?>" role="button">Annuler</a>
            <?php
                $notReserved = true;
                foreach ($items as $item) :
                    if ($item->account_id_reserv != null) :
                        $notReserved = false;
                        break;
                    endif;
                endforeach;
            ?>

            <button type="submit" name="submit" value="edit">Modifier la liste</button>
    </form>
<?php } else { ?>
<h1>Vous n'êtes pas connecté</h1>
<?php } ?>
