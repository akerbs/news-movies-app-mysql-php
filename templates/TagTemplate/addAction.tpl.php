<section class="section-tag">
  <div class="container">
    <form action="index.php?controller=tag&action=<?= $action ?>" method="post">
      <input type="hidden" name="id" value="<?= $tag->getId() ?>">
      <div class="form-group">
        <label for="input-tag">Tag Title*</label>
        <input type="text" 
          name="title"
          maxlength="20" 
          id="input-tag" 
          class="form-control"
          value="<?= $tag->getTitle(); ?>">
      </div>
      <button type="submit" class="btn btn-info mt-3">
        Send
      </button>
    </form>
  </div>
</section>