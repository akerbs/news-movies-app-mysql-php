<section class="section-user-login">
  <div class="container">
    <form action="index.php?controller=user&action=login" method="post">
      <div class="form-group">
        <label for="input-email">E-Mail</label>
        <input type="email" name="email" id="input-email" class="form-control">
      </div>
      <div class="form-group">
        <label for="input-password">Password</label>
        <input type="password" name="password" id="input-password" class="form-control">
      </div>

      <div class=" form-group">
        <button type="submit" class="btn btn-info">Login</button>
      </div>

    </form>
  </div>
</section>