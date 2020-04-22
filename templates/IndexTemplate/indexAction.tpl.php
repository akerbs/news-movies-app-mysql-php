<section>

  <?php if ($action === 'index' || $action === 'search') : ?> 
    <?php include_once 'templates/parts/search.tpl.php'; ?>
  <?php endif; ?>
  <div class="container">
    <h1><?= $headline ?></h1>

    <div class="row">
      <?php foreach($articles as $article) : ?>
        <div class="col-12 col-md-6 col-xl-4">
          <div class="card mb-5">
            <h4 class="card-header">
            <?= $article->getTitle(); ?>
            <a href="index.php?action=edit&id=<?= $article->getId() ?>" class="btn btn-info btn-sm">
              <i class="far fa-edit"></i>
              <span class="sr-only">Edit</span>
            </a>

            <a href="index.php?action=delete&id=<?= $article->getId() ?>" class="btn btn-danger btn-sm">
              <i class="fas fa-trash-alt"></i>
              <span class="sr-only">Delete</span>
            </a>
            </h4>
            
            <div class="card-body">
              <div class="card-text py-2">
              <?= clean($article->getTeaser()); ?>
              </div>
              <a href="index.php?action=read&id=<?= $article->getId() ?>" class="btn btn-sm btn-dark">More Information…</a>

              <div class="mt-3">

                <?php foreach($article->getTags()->toArray() as $tag) : ?>
                <a href="#" class="badge badge-info">
                  <?= $tag->getTitle(); ?>
                </a>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="card-footer text-muted text-right">
              <small>
                Article from <?= $article->getCreatedAt()->format('d.m.Y H:i'); ?>
                by <?= $article->getUser()->getUsername(); ?>
              </small>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>