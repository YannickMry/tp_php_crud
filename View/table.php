<h1 class="mt-3">Liste des <?= $title ?>s</h1>

<a href="" class="btn btn-primary mb-3">Ajouter <?= $title ?></a>

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
                  <td><?= $r->__get($h) === true ? "Oui" : "Non" ?></td>
                <?php else: ?>
                  <td><?= $r->__get($h) ?></td>
                <?php endif; ?>
            <?php endforeach; ?>
            <td>
              <a href="" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
              <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
  </tbody>
</table>