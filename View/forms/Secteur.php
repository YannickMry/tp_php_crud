<h2 class="my-2"><?= isset($form) ? 'Modifier' : 'Ajouter' ?> Secteur</h2>
<form id="form_secteur" method="POST">
    <div class="form-group">
    <label for="LIBELLE"><?= config('strings')['LIBELLE'] ?></label>
    <input required type="text" class="form-control" id="LIBELLE" name="LIBELLE" value="<?= isset($form) && $form->LIBELLE != null ? $form->LIBELLE : '' ?>">
    </div>
</form>
<button type="submit" form="form_secteur" class="btn btn-primary"><?= isset($form) ? 'Modifier' : 'Ajouter' ?></button>