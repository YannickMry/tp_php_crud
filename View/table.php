<h2 class="mt-3">Liste <?= $entity ?></h2>

<a href="<?= path('main/create', ['entity' => $entity]) ?>" class="btn btn-primary mb-3">Ajouter</a>

<table class="table mb-5" style="overflow-x: scroll;">
  <thead>
    <tr>
        <?php foreach($headers as $h): ?>
            <th><?= $this->string($h) ?></th>
        <?php endforeach; ?>
        <th>Actions</th>
    </tr>
  </thead>
  <tbody>
        <?php foreach($rows as $r): ?>
        <tr>
            <?php foreach($headers as $h): ?>
                <?php if ($h === 'ESTASSO'): ?>
                  <td><?= $r->$h === true ? "Oui" : "Non" ?></td>
                <?php else: ?>
                  <td><?= $r->$h ?></td>
                <?php endif; ?>
            <?php endforeach; ?>
            <td>
              <a href="<?= path('main/update', ['entity' => $entity, 'id' => $r->ID]) ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
              <a href="<?= path('main/delete', ['entity' => $entity, 'id' => $r->ID]) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
  </tbody>
</table>