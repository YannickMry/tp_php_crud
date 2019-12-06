<table class="table">
  <thead>
    <tr>
        <?php foreach($headers as $h): ?>
            <th><?= $this->string($h) ?></th>
        <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
        <?php foreach($rows as $r): ?>
        <tr>
            <?php foreach($headers as $h): ?>
            
                  <?php if(!is_string($r)) { ?>
                    <td><?= $r->__get($h) ?></td>
                  <?php } ?>
                
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
  </tbody>
</table>