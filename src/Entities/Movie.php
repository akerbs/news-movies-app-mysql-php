<?php

namespace Entities;

use Entities\{User, Genre, Writer, Director};
use Doctrine\ORM\Mapping as ORM;
use Webmasters\Doctrine\ORM\Util;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="movies")
 */
class Movie
{

  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  protected $id = 0;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $title = '';

  /**
   * @ORM\Column(type="text")
   */
  protected $description = '';

  /**
   * @ORM\Column(type="date", name="release_year")
   */
  protected $releaseYear;

  /**
   * @ORM\Column(type="integer")
   */
  protected $duration = 0;

  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Gedmo\Timestampable(on="create")
   */
  protected $createdAt;

  /**
   * @ORM\Column(name="publish_at", type="datetime")
   */
  protected $publishAt;

  /**
   * @ORM\ManyToOne(targetEntity="User", inversedBy="movies")
   */
  protected $user;

  /**
   * @ORM\ManyToOne(targetEntity="Director", inversedBy="movies")
   */
  protected $director;

  /**
   * @ORM\OneToMany(targetEntity="Cover", mappedBy="movie")
   */
  protected $covers;

  /**
   * @ORM\ManyToMany(targetEntity="Writer", inversedBy="movies")
   * @ORM\JoinTable(name="movies_writers")
   */
  protected $writers;

  /**
   * @ORM\ManyToMany(targetEntity="Genre", inversedBy="movies")
   * @ORM\JoinTable(name="movies_genres")
   */
  protected $genres;


  use \Traits\ArrayMappable;

  public function __construct(array $data = [])
  {
    $this->mapFromArray($data);
    $this->covers = new ArrayCollection();
    $this->writers = new ArrayCollection();
    $this->genres = new ArrayCollection();
  }

  /**** GETTER und SETTER- Methoden */

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getReleaseYear()
  {
    return new Util\DateTime($this->releaseYear);
  }

  public function getDuration()
  {
    return $this->duration;
  }

  public function getCreatedAt()
  {
    return new Util\DateTime($this->createdAt);
  }

  public function getPublishAt()
  {
    return new Util\DateTime($this->publishAt);
  }

  public function getDirector()
  {
    return $this->director;
  }

  public function getUser()
  {
    return $this->user;
  }

  // public function setId($id) {
  //   $this->id = $id;
  //   return $this;
  // }

  public function setTitle($title)
  {
    $this->title = $title;
    return $this;
  }

  public function setDescription($description)
  {
    $this->description = $description;
    return $this;
  }

  public function setReleaseYear($releaseYear)
  {
    $this->releaseYear = new Util\DateTime($releaseYear);
    return $this;
  }
  public function setDuration($duration)
  {
    $this->duration = $duration;
    return $this;
  }

  public function setPublishAt($publishAt)
  {
    $this->publishAt = new Util\DateTime($publishAt);
    return $this;
  }

  public function setDirector(?Director $director)
  {
    $this->director = $director;
    return $this;
  }

  // Das Präfix "?" aktiviert den Nullable Type, d.h. null kann alternativ als Parameter übergeben werden
  public function setUser(?User $user)
  {
    $this->user = $user;
    return $this;
  }

  // COVERS //////

  /**
   * [getCovers gibt ArrayCollection mit mehreren Entity-Objekten der Instanz Cover zurück]
   *
   * @return  [Object]  [ArrayCollection mit Covers]
   */
  public function getCovers()
  {
    return $this->covers;
  }

  /**
   * [clearCovers leert ArrayCollection]
   *
   * @return  [Object]  [Movie Instanz - somit Fluent Interface (chaining) möglich]
   */
  public function clearCovers()
  {
    $this->covers->clear();
    return $this;
  }

  /**
   * [addCover fügt ein Entity-Objekt der Instanz Cover in die ArrayCollection hinzu.]
   *
   * @param   Cover  $cover  [Entities\Cover Objekt]
   *
   * @return  [Object]  [Movie Instanz - somit Fluent Interface (chaining) möglich]
   */
  public function addCover(Cover $cover)
  {
    $this->covers->add($cover);

    return $this;
  }


  /**
   * [hasCover überprüft ob ein Objekt der Instanz Cover in der ArrayCollection existiert ]
   *
   * @param   Cover  $cover  [Entities\Cover Objekt]
   *
   * @return  [bool]         [true | false wenn Entity-Objekt gefunden oder nicht gefunden wird]
   */
  public function hasCover(Cover $cover)
  {
    return $this->covers->contains($cover);
  }

  /**
   * [removeCover entfernt Objekt der Instanz Cover aus der ArrayCollection. ]
   *
   * @param   Cover  $cover  [Entities\Cover Objekt]
   *
   * @return  [Object]  [Movie Instanz - somit Fluent Interface (chaining) möglich]
   */
  public function removeCover(Cover $cover)
  {
    $this->covers->removeElement($cover);
    return $this;
  }

  // Writers //////
  public function getWriters()
  {
    return $this->writers;
  }

  public function clearWriters()
  {
    $this->writers->clear();
    return $this;
  }

  public function addWriter(Writer $writer)
  {
    $this->writers->add($writer);
    return $this;
  }

  public function hasWriter(Writer $writer)
  {
    return $this->writers->contains($writer);
  }

  public function removeWriter(Writer $writer)
  {
    $this->writers->removeElement($writer);
    return $this;
  }

  // Genres //////
  public function getGenres()
  {
    return $this->genres;
  }

  public function clearGenres()
  {
    $this->genres->clear();
    return $this;
  }

  public function addGenre(Genre $genre)
  {
    $this->genres->add($genre);
    return $this;
  }

  public function hasGenre(Genre $genre)
  {
    return $this->genres->contains($genre);
  }

  public function removeGenre(Genre $genre)
  {
    $this->genres->removeElement($genre);
    return $this;
  }
}
