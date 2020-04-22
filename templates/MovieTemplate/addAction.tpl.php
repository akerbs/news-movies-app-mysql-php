<section>
  <div class="container">
    <h2>Add Movie</h2>

    <form action="index.php?controller=movie&action=<?= clean($action) ?>" method="post">

      <input type="hidden" name="id" value="<?= clean($movie->getId()); ?>">
      <input type="hidden" name="csrf_token" value="<?= clean($token, false) ?>">


      <div class="form-group">
        <h6 class="my-3">Genres</h6>

        <?php foreach ($genres as $genre) : ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="genres_ids[]" type="checkbox" id="checkbox-genre-<?= $genre->getId(); ?>" <?= ($movie->hasGenre($genre)) ? 'checked' : '' ?> value="<?= $genre->getId(); ?>">
            <label class="form-check-label" for="checkbox-genre-<?= $genre->getId(); ?>"><?= $genre->getName(); ?></label>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="form-group">
        <label for="input-title">Title</label>
        <input type="text" name="title" class="form-control" id="input-title">
      </div>

      <div class="form-group">
        <label for="input-description">Description</label>
        <input type="text" name="description" class="form-control" id="input-description">
      </div>

      <div class="form-group">
        <label for="input-release-year">Release Year</label>
        <input type="date" name="release_year" class="form-control" id="input-release-year">
      </div>

      <div class="form-group">
        <label for="input-duration">Duration</label>
        <input type="number" name="duration" class="form-control" id="input-duration">
      </div>

      <div class="form-group">
        <label for="input-publish-at">Publish At</label>
        <input type="date" name="publish_at" class="form-control" id="input-publish-at" readonly value="<?= date('Y-m-d') ?>">
      </div>

      <button type="submit" class="btn btn-primary">Add Movie</button>
    </form>

  </div>
</section>