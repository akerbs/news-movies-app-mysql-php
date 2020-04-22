<section class="section-article">
  <div class="container">
    <form action="index.php?action=<?= $action ?>" method="post">
      <div class="form-row">
        <div class="form-group col-12 col-md-6">
          <label for="input-title">Title</label>
          <input type="text" name="title" class="form-control" id="input-title">
        </div>

        <div class="form-group col-12 col-md-6">
          <label for="input-publish-at">Publish At</label>
          <input type="date" name="publish_at" class="form-control" id="input-publish-at">
        </div>
      </div>

      <div class="form-group">
        <label for="select-tags">Tags</label>
        <select name="tag_ids[]" id="select-tags" class="form-control" size="7" multiple>
          <?php foreach ($tags as $tag) : ?>
            <option value="<?= $tag->getId(); ?>"><?= $tag->getTitle() ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="input-teaser">Teaser</label>
        <input type="text" name="teaser" class="form-control" id="input-teaser">
      </div>
      <div class="form-group">
        <label for="textarea-news">News</label>
        <textarea name="news" id="textarea-news" class="form-control" cols="30" rows="8"></textarea>
      </div>

      <button type="submit" class="btn btn-info mt-3"><?= ucfirst($action) ?> News</button>
    </form>

  </div>
</section>