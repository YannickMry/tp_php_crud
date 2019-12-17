<form id="form_structure">
          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
          </div>
          <div class="form-group">
            <label for="rue">Rue</label>
            <input type="text" class="form-control" id="rue" name="rue">
          </div>
          <div class="form-group">
            <label for="cp">Code postal</label>
            <input type="number" class="form-control" id="cp" name="cp">
          </div>
          <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="estasso" name="estasso">
            <label class="form-check-label" for="estasso">Est une association</label>
          </div>
          <div class="form-group">
            <label for="ville">Nombre actionnaires (ou donateurs)</label>
            <input type="text" class="form-control" id="nb" name="nb">
          </div> 
        </form>
        <button type="submit" form="form_structure" class="btn btn-primary">Ajouter</button>