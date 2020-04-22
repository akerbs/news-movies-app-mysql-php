<section class="section-user-register">
  <div class="container">
    <div class="row mb-5">
      <h2><?= ucfirst(clean($action)) ?> Form</h2>
    </div>
    <div class="row">
        <form action="index.php?controller=user&action=<?= clean($action) ?>" method="post" novalidate>
      <input type="hidden" name="id" value="<?= (int) $user->getId() ?>">
      
      <div class="form-row">
      <div class="form-group col">
      <label for="input-firstname">Firstname</label>
      <input type="text"
      name="firstname"
      id="input-firstname"
      class="form-control"
      value="<?= clean($user->getFirstname()) ?>">
      </div>
      <div class="form-group col">
      <label for="input-lastname">Lastname</label>
      <input type="text"
      name="lastname"
      id="input-lastname"
      class="form-control"
      value="<?= clean($user->getLastname()) ?>">
      </div>
      </div>
      
      <div class="form-group">
      <label for="input-username">Username</label>
      <input type="text"
      name="username"
      id="input-username"
      class="form-control"
      value="<?= clean($user->getUsername()) ?>">
      </div>

      <div class="form-group">
      <label for="input-email">Email</label>
      <input type="email"
      name="email"
      id="input-email"
      class="form-control"
      value="<?= clean($user->getEmail()) ?>">
      </div>
      
      <div class="form-group">
      <label for="input-password">Password</label>
      <input type="password"
      name="password"
      id="input-password"
      class="form-control"
      value="<?= $user->getPassword() ?>">
      <small class="form-text text-muted">
      <strong>Annotation:</strong> The password must be at least twelve characters long and
       should not include your email address. <br />
       It shouldn't be too easy to guess, so use a combination
       from lowercase / capital letters, numbers and special characters.
      </small>
      </div>
      
      <button type="submit" class="btn btn-info"><?= ucfirst(clean($action)) ?> Form</button>
      
      
      </form>
    </div>

  </div>
</section>