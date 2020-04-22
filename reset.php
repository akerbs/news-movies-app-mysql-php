<?php 

use Entities\{ Tag, User, Cover, Genre, Movie, Writer, Article, Director};
use Doctrine\Common\Util\Debug;

require_once 'inc/helper.inc.php';
require_once 'inc/bootstrap.inc.php';

$em->getConnection()->query('SET FOREIGN_KEY_CHECKS=0;');
$em->getConnection()->query('TRUNCATE TABLE articles;');
$em->getConnection()->query('TRUNCATE TABLE covers;');
$em->getConnection()->query('TRUNCATE TABLE directors;');
$em->getConnection()->query('TRUNCATE TABLE genres;');
$em->getConnection()->query('TRUNCATE TABLE movies;');
$em->getConnection()->query('TRUNCATE TABLE movies_genres;');
$em->getConnection()->query('TRUNCATE TABLE movies_writers;');
$em->getConnection()->query('TRUNCATE TABLE tags;');
$em->getConnection()->query('TRUNCATE TABLE tagging;');
$em->getConnection()->query('TRUNCATE TABLE users;');
$em->getConnection()->query('TRUNCATE TABLE writers;');
$em->getConnection()->query('SET FOREIGN_KEY_CHECKS=1;');

$tags = [
  ['title' => 'HTML'],
  ['title' => 'CSS'],
  ['title' => 'Javascript'],
  ['title' => 'PHP'],
  ['title' => 'Python']
];

foreach ($tags as $entry) {
  $tag = new Tag($entry);
  $em->persist($tag);
}
$em->flush();

$users = [
  [
    'firstname' => 'Max',
    'lastname' => 'Mustermann',
    'username' => 'm.mustermann',
    'email' => 'm@mustermann.de',
    'password' => 'topsecret',
  ],
  [
    'firstname' => 'John',
    'lastname' => 'Doe',
    'username' => 'j.doe',
    'email' => 'john.doe@gmail.com',
    'password' => 'topsecret2',
  ],
  [
    'firstname' => 'Anatol',
    'lastname' => 'Kerbs',
    'username' => 'a.kerbs',
    'email' => 'anker2702@gmail.com',
    'password' => 'sunshine',
  ]
];

foreach($users as $entry) {
  $user = new User($entry);
  $em->persist($user);
}
$em->flush();

$articles = [
  [
    'title' => 'First article',
    'teaser' => 'Lorem ipsum, dolor sit amet',
    'news' => "Erster Absatz …\n Lorem ipsum dolor sit amet.",
    'publish_at' => 'now',
    'user_id' => 1,
    'tags' => ['HTML','CSS']
  ],
  [
    'title' => 'Second article',
    'teaser' => 'Anderer Lorem ipsum, dolor sit amet',
    'news' => 'Erster Absatz … Lorem ipsum dolor sit amet.',
    'publish_at' => '2019-12-11',
    'user_id' => 2,
    'tags' => ['PHP','Javascript']
  ],
  [
    'title' => 'Third article',
    'teaser' => 'Anderer Lorem ipsum, dolor sit amet',
    'news' => 'Erster Absatz … Lorem ipsum dolor sit amet.',
    'publish_at' => '2018-12-10',
    'user_id' => 2,
    'tags' => ['Python']
  ]
];

foreach ($articles as $entry) {
  // [
  //   'title' => 'Nur ein Test', //setTitle('Nur ein Test')
  //   'teaser' => 'Lorem ipsum, dolor sit amet', //setTeaser('Lorem…')
  //   'news' => 'Erster Absatz … Lorem ipsum dolor sit amet.', //setNews('Erster…');
  //   'publish_at' => 'now', //setPublishAt('now');
  //   'user_id' => 1, 
  // setUserId(1) <-- existiert nicht und wird nicht ausgwführt
  //   'tags' => ['HTML','Javascript']
  // setTags(['HTML','Javascript']) <-- existiert nicht und wird nicht ausgwführt
  // ]
  $article = new Article($entry);

  $user = $em->getRepository('Entities\User')
    ->find($entry['user_id']);

  $user->addArticle($article); // Gegenseite
  $article->setUser($user); // Eigentümerseite


  foreach($entry['tags'] as $name) {
    $tag = $em->getRepository('Entities\Tag')
      ->findOneByTitle($name);
    
    $tag->addArticle($article); // t.articles tags ArrayCollection erhält ein weiteres Article-Objekt;
    $article->addTag($tag); // a.tags ArrayCollection erhält ein weiteres Tag-Objekt

    $em->persist($tag);
  }
 
  // pre_r(Debug::dump($article));
  $em->persist($article);
}
$em->flush();

$genres = ["Action","Adventure","Animation","Biography","Comedy","Crime","Drama","Family","Fantasy","Horror","Sci-Fi", "Thriller","Romance" ];

foreach ($genres as $entry) {
  $genre = new Genre(["name" => $entry]);
  $em->persist($genre);
}
$em->flush();


$writers = [
  [
    "firstname" => "Willard",
    "lastname" => "Huyck",
    "biography" => "Willard Huyck was born on September 8, 1945 in Los Angeles, California, USA as Willard Miller Huyck Jr. He is a writer and director, known for Howard the Duck (1986), American Graffiti (1973) and Indiana Jones and the Temple of Doom (1984). He was previously married to Gloria Katz.",
    "gender" => "m",
    "birthdate" => "1945-09-08"
  ],
  [
    "firstname" => "Gloria",
    "lastname" => "Katz",
    "biography" => "Gloria Katz was born on October 25, 1942 in Los Angeles, California, USA as Gloria Pearl Katz. She was a writer and producer, known for Howard the Duck (1986), American Graffiti (1973) and Indiana Jones and the Temple of Doom (1984). She was married to Willard Huyck. She died on November 25, 2018 in Los Angeles.",
    "gender" => "f",
    "birthdate" => "1942-10-25"
  ],
  [
    "firstname" => "George",
    "lastname" => "Lucas",
    "biography" => "George Walton Lucas, Jr. was raised on a walnut ranch in Modesto, California. His father was a stationery store owner and he had three siblings. During his late teen years, he went to Thomas Downey High School and was very much interested in drag racing. He planned to become a professional racecar driver. ",
    "gender" => "m",
    "birthdate" => "1944-05-14"
  ],
  [
    "firstname" => "James",
    "lastname" => "Cameron",
    "biography" => "James Francis Cameron was born on August 16, 1954 in Kapuskasing, Ontario, Canada. He moved to the United States in 1971. The son of an engineer, he majored in physics at California State University before switching to English, and eventually dropping out. He then drove a truck to support his screenwriting ambition.",
    "gender" => "m",
    "birthdate" => "1954-08-16"
  ],
  [
    "firstname" => "David",
    "lastname" => "Giler",
    "biography" => "David Giler was born as David Kevin Giler. He is a producer and writer, known for Aliens (1986), Alien³ (1992) and Alien Resurrection (1997). He was previously married to Nancy Kwan.",
    "gender" => "m",
    "birthdate" => null
  ],
  [
    "firstname" => "Pete",
    "lastname" => "Docter",
    "biography" => "Pete Docter was born on October 9, 1968 in Bloomington, Minnesota, USA as Peter Hans Docter. He is a producer and writer, known for Up (2009), Inside Out (2015) and Monsters, Inc. (2001). He has been married to Amanda Jean Schmidt since December 27, 1992. They have two children.",
    "gender" => "m",
    "birthdate" => "1968-10-09"
  ],
  [
    "firstname" => "Jil",
    "lastname" => "Culton",
    "biography" => "Jill Culton is known for her work on Monsters, Inc. (2001), Open Season (2006) and Toy Story (1995).",
    "gender" => "f",
    "birthdate" => null
  ],
];

foreach ($writers as $entry) {
  $writer = new Writer($entry);
  $em->persist($writer);
}
$em->flush();

$directors = [
  [ 
    'firstname' => 'Steven',
    'lastname' => 'Spielberg'
  ],
  [ 
    'firstname' => 'James',
    'lastname' => 'Cameron'
  ],
  [ 
    'firstname' => 'Pete',
    'lastname' => 'Docter'
  ],
];

foreach ($directors as $entry) {
  $director = new Director($entry);
  $em->persist($director);
}
$em->flush();

$movies = [
  [
    'title' => 'Indiana Jones and the Temple of Doom',
    'description' => 'In 1935, Indiana Jones arrives in India, still part of the British Empire, and is asked to find a mystical stone.',
    'releaseYear' => '1984-05-23',
    'duration' => 118,
    'publish_at' => '2019-12-09',
    'director_id' => 1,
    'user_id' => 2,
    'genres' => ['Action', 'Adventure'],
    'writers' => [1, 2, 3]
  ],
  [
    'title' => 'Aliens',
    'description' => 'Ellen Ripley is rescued by a deep salvage team after being in hypersleep for 57 years. The moon that the Nostromo visited has been colonized, but contact is lost.',
    'release_year' => '1986-07-18',
    'duration' => 137,
    'publish_at' => '2019-12-09',
    'director_id' => 2,
    'user_id' => 2,
    'genres' => ['Action', 'Adventure', 'Sci-Fi', 'Thriller'],
    'writers' => [4, 5]
  ],
  [
    'title' => 'Monsters, Inc.',
    'description' => 'In order to power the city, monsters have to scare children so that they scream. However, the children are toxic to the monsters, and after a child gets through, 2 monsters realize things may not be what they think.',
    'release_year' => '2001-11-02',
    'duration' => 92,
    'publish_at' => '2019-12-09',
    'director_id' => 3,
    'user_id' => 1,
    'genres' => ['Animation', 'Adventure', 'Comedy','Family','Fantasy'],
    'writers' => [6, 7]
  ],
];

foreach ($movies as $entry) {
  $movie = new Movie($entry);
  $user = $em->getRepository('Entities\User')
    ->find($entry['user_id']);
  

  $director = $em->getRepository('Entities\Director')
    ->find($entry['director_id']);
  
  $user->addMovie($movie);
  $director->addMovie($movie); // ArrayCollection von $movies wird um ein Movie-Objekt erweitert

  $movie->setUser($user);  // $user Attribut wird mit dem User-Objekt befüllt.
  $movie->setDirector($director); // $director Attribut wird mit dem Director-Objekt befüllt.
  
  foreach ($entry['genres'] as $name) {
    $genre = $em->getRepository('Entities\Genre')
      ->findOneByName($name);

    $genre->addMovie($movie);
    $movie->addGenre($genre);

    $em->persist($genre);
  }

  foreach($entry['writers'] as $id) {
    $writer = $em->getRepository('Entities\Writer')
      ->find($id);

    $writer->addMovie($movie);
    $movie->addWriter($writer);

    $em->persist($writer);
  }


  $em->persist($movie);
}
$em->flush();

$covers = [
  [
    "path" => "indiana_cover_01.jpg",
    "title" => "Indiana Jones and the Temple of Doom",
    "description" => "Indiana Jones and the Temple of Doom Cinema Cover",
    "movie_id" => 1
  ],
  [
    "path" => "indiana_cover_02.jpg",
    "title" => "Indiana Jones and the Temple of Doom 02",
    "description" => "Indiana Jones and the Temple of Doom Cinema Cover",
    "movie_id" => 1
  ],
  [
    "path" => "aliens_cover.jpg",
    "title" => "Aliens",
    "description" => "Aliens Cinema Cover",
    "movie_id" => 2
  ],
  [
    "path" => "monster_ag.jpg",
    "title" => "Monster AG",
    "description" => "Monster AG Cover",
    "movie_id" => 3
  ]
];

foreach ($covers as $entry) {
  //  [
  //   "path" => "indiana_cover_01.jpg", // setPath("indiana_cover_01.jpg")
  //   "title" => "Indiana Jones and the Temple of Doom", // setTitle("Indiana Jones…")
  //   "description" => "Indiana Jones…", //setDescription("…")
  //   "movie_id" => 1 // setMovieId <-- setter existiert nicht und die Methode wird nicht ausgeführt
  // ]
  $cover = new Cover($entry);
  // pre_r($cover);

  $movie = $em->getRepository('Entities\Movie')
    ->find($entry['movie_id']);
  // pre_r(Debug::dump($movie)); // Debugger von Doctrine. Über das Debug-Objekt können Entitie-Objekte ausgegeben werden.

  $movie->addCover($cover); // Gegenseite ArrayCollection "covers" wird befüllt
  $cover->setMovie($movie); // Eigentümer 
  // pre_r(Debug::dump($cover));

  $em->persist($cover);

}
$em->flush();


  

?>
The database contents have been adjusted.