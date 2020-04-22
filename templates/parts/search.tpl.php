  <!-- ▼ search ▼ -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10">
          <form id="form-search" 
            action="index.php?controller=index&action=search" method="post">
            <div class="form-group row">
              <div class="col-10">
                <label class="sr-only" for="input-search">Search:</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                  <input type="text" 
                    class="form-control"
                    name="like" 
                    id="input-search" placeholder="search…">
                </div>
              </div>
              <div class="col-2">
                <button type="submit" class="btn btn-info">Search</button>
              </div>
            </div>
          </form>
      </div>
    </div>
    <?php if ($action == 'search') : ?>
    <p>You search for: <?= clean($searchValue) ?? '' ?>
    <?php endif; ?>
  </div>
  <!-- /search -->