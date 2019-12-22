<h2 class="my-2"><?= isset($form) ? 'Modifier' : 'Ajouter' ?> Structure</h2>
<form id="form_structure" method="POST">
  <div class="form-group">
    <label for="NOM"><?= config('strings')['NOM'] ?></label>
    <input type="text" class="form-control" id="NOM" name="NOM" value="<?= isset($form) && $form->NOM != null ? $form->NOM : '' ?>" required>
  </div>
  <div class="form-group">
    <label for="RUE"><?= config('strings')['RUE'] ?></label>
    <input type="text" class="form-control" id="RUE" name="RUE" value="<?= isset($form) && $form->RUE != null ? $form->RUE : '' ?>" required>
  </div>
  <div class="form-group">
    <label for="CP"><?= config('strings')['CP'] ?></label>
    <input type="number" class="form-control" id="CP" name="CP" value="<?= isset($form) && $form->CP != null ? $form->CP : '' ?>" required>
  </div>
  <div class="form-group">
    <label for="VILLE"><?= config('strings')['VILLE'] ?></label>
    <input type="text" class="form-control" id="VILLE" name="VILLE" value="<?= isset($form) && $form->VILLE != null ? $form->VILLE : '' ?>" required>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="ESTASSO" name="ESTASSO" <?= isset($form) && $form->ESTASSO != null && intval($form->ESTASSO) == 1 ? 'checked' : '' ?>>
    <label class="form-check-label" for="ESTASSO"><?= config('strings')['ESTASSO'] ?></label>
  </div>
  <div class="form-group">
    <label for="NB">Nombre actionnaires (ou donateurs)</label>

    <?php if(isset($form) && $form->NB_DONATEURS != null) { ?>

    <input type="number" class="form-control" id="NB" name="NB" value="<?= $form->NB_DONATEURS ?>" required>

    <?php } elseif(isset($form) && $form->NB_ACTIONNAIRES != null) { ?>

    <input type="number" class="form-control" id="NB" name="NB" value="<?= $form->NB_ACTIONNAIRES ?>" required>
    
    <?php } else { ?>

    <input type="number" class="form-control" id="NB" name="NB" required>

    <?php } ?>

  </div> 
</form>
<button type="submit" form="form_structure" class="btn btn-primary"><?= isset($form) ? 'Modifier' : 'Ajouter' ?></button>