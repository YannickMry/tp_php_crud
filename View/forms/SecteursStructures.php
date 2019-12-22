<h2 class="my-2"><?= isset($form) ? 'Modifier' : 'Ajouter' ?> SecteursStructures</h2>
<form id="form_secteur_structure" method="POST">
    <div class="form-group">
        <label for="select_secteurs"><?= config('strings')['SECTEUR'] ?></label>
        <select class="form-control" id="select_secteurs" name="ID_SECTEUR" required>
            <?php foreach($secteurs as $s): ?>
                <option value="<?= $s->ID ?>" <?= isset($form) && $form->secteur->ID == $s->ID ? 'selected' : '' ?>><?= $s->LIBELLE ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="select_structures"><?= config('strings')['STRUCTURE'] ?></label>
        <select class="form-control" id="select_structures" name="ID_STRUCTURE" required>
            <?php foreach($structures as $s): ?>
                <option value="<?= $s->ID ?>" <?= isset($form) && $form->structure->ID == $s->ID ? 'selected' : '' ?>><?= $s->NOM ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" form="form_secteur_structure" class="btn btn-primary"><?= isset($form) ? 'Modifier' : 'Ajouter' ?></button>
</form>