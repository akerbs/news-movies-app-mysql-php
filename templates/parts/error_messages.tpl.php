<?php if (!empty($errors) && is_array($errors)) : ?>
<div class="alert alert-danger" role="alert">
  <ul class="list-group list-group-flush">
  <?php foreach ($errors as $error) : ?>
    <li class="list-group-item">
      <?= $error ?>
    </li>
  <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>