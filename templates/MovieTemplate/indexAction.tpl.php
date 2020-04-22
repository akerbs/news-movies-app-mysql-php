<section>
  <div class="container">
    <h2>Movielist</h2>
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th>
            Id
          </th>
          <th>
            Covers
          </th>
          <th>
            Title
          </th>
          <th class="w-25">
            Description
          </th>
          <th>
            Release Year
          </th>
          <th>
            Duration
          </th>
          <th>
            Director
          </th>
          <th>
            Writers
          </th>
          <th>
            Genres
          </th>
          <th>
            Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($movies as $movie) : ?>

          <tr>
            <td>
              <?= clean($movie->getId()); ?>
            </td>
            <td>
              <?php foreach ($movie->getCovers() as $cover) : ?>
                <img src="assets/img/<?= $cover->getPath(); ?>" alt="<?= clean($cover->getTitle()) ?>" class="w-100 img-thumbnail m-2">
              <?php endforeach; ?>
            </td>
            <td>
              <?= clean($movie->getTitle()) ?>
            </td>
            <td class="w-25">
              <?= purify($movie->getDescription()) ?>
            </td>
            <td>
              <?= clean($movie->getReleaseYear()->format('d.m.Y')) ?>
            </td>
            <td>
              <?= clean($movie->getDuration()) ?>
            </td>
            <td>
              <?php if ($movie->getDirector()) : ?>
                <?= clean($movie->getDirector()->getFirstname()) ?> <?= clean($movie->getDirector()->getLastname()) ?>
              <?php endif; ?>
            </td>
            <td>

              <ul>
                <?php foreach ($movie->getWriters() as $writer) : ?>
                  <li>
                    <?= clean($writer->getFirstname()) ?>&nbsp;
                    <?= clean($writer->getLastname()) ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </td>
            <td>

              <?= isset($genres[$movie->getId()]) ? implode(", ", $genres[$movie->getId()]) : ''; // => "Action, Adventure"; 
              ?>
            </td>
            <td>
              <a href="index.php?controller=movie&action=edit&id=<?= (int) $movie->getId() ?>" class="btn btn-secondary mb-2">
                <i class="fas fa-edit"></i><span class="sr-only">Edit</span>
              </a>
              <a href="index.php?controller=movie&action=delete&id=<?= (int) $movie->getId() ?>" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i><span class="sr-only">Delete</span>
              </a>
            </td>
          </tr>

        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>