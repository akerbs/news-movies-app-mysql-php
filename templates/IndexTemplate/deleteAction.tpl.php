<section class="section-delete">
  <div class="container">
      <!-- Modal -->
      <div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Delete article ?</h5>
            </div>
            <div class="modal-body">
              <p>
              Are you sure you want to remove article
              &quot;<?= clean($article->getTitle()) ?>&quot;
              from <?= clean($article->getCreatedAt()->format('d.m.Y')) ?>?
              </p>
            </div>
            <div class="modal-footer">
              <form method="post">
                <input type="hidden" 
                  name="id" 
                  value="<?= (int) $article->getId() ?>">
                <button type="submit" 
                  class="btn btn-secondary" 
                  data-dismiss="modal">Yes</button>
                <a href="index.php" class="btn btn-info">Stop</a>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>