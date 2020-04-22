<section class="section-tags">
  <div class="container">
    <ul class="list-group">
      <?php foreach ($tags as $tag) : ?>
      <li class="list-group-item list-group-item-action">
        <a href="index.php?controller=tag&action=read&id=<?= $tag->getId() ?>">
          <?= $tag->getTitle(); ?>
        </a>
        <a href="index.php?controller=tag&action=edit&id=<?= $tag->getId(); ?>" class="btn btn-info btn-sm float-right">
          <i class="far fa-edit"><span class="sr-only">Edit<span></i>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>