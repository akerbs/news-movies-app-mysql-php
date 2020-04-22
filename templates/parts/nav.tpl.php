<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">News-Movies App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          News
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php">All News</a>
          <a class="dropdown-item" href="index.php?action=add">Add News</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?controller=tag">All Tags</a>
          <a class="dropdown-item" href="index.php?controller=tag&action=add">Add Tag</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Movies
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?controller=movie">All Movies</a>
          <a class="dropdown-item" href="index.php?controller=movie&action=add">Add Movie</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="index.php?controller=user&action=register"><i class="fas fa-user-plus"></i> Register</a>
      </li>
      <?php if (!isLoggedIn()) : ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=user&action=login"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
      <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=user&action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>