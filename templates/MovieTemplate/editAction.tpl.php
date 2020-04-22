<section>
  <div class="container">
    <h2>Edit Movie</h2>

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
        <input type="text" name="title" class="form-control" id="input-title" value="<?= clean($movie->getTitle()); ?>">
      </div>

      <div class="form-group">
        <label for="textarea-description">Description</label>
        <textarea name="description" class="form-control" id="textarea-description"><?= purify($movie->getDescription()); ?></textarea>
      </div>

      <div class="form-group">
        <label for="input-release-year">Release Year</label>
        <input type="date" name="releaseYear" class="form-control" id="input-release-year" value="<?= clean($movie->getReleaseYear()->format('Y-m-d')); ?>">
      </div>

      <div class="form-group">
        <label for="input-duration">Duration</label>
        <input type="number" name="duration" class="form-control" id="input-duration" value="<?= clean($movie->getDuration()) ?>">
      </div>

      <button type="submit" class="btn btn-primary">Update Movie</button>
    </form>

  </div>
</section>