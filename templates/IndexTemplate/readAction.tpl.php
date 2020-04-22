<section class="section-article">
  <div class="container">
    
    <div class="card text-center">
    <div class="card-header">
      <a href="index.php" class="btn btn-info btn-sm my-2"><i class="fas fa-chevron-left"></i> Back to News</a>
      <h2><?= clean($article->getTitle()) ?></h2>
    </div>
    <div class="card-body">
      <p class="card-text"><?= purify($article->getNews()); ?></p>
    </div>
    <div class="card-footer text-muted">
      <small>Article by: <?= clean($article->getUser()->getUsername()) ?></small>
    </div>
  </div>
  </div>
</section>