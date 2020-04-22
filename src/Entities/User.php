<?php

namespace Entities;

use Entities\Article;
use Doctrine\ORM\Mapping as ORM;
use Webmasters\Doctrine\ORM\Util;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Repositories\UserRepository")
 * @ORM\Table(name="users")
 */
class User
{
  protected const HASH_ALGO = PASSWORD_BCRYPT;
  protected const HASH_OPTIONS = [
    'cost' => 12,
  ];

  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  protected $id = 0;

  /**
   * @ORM\Column(type="string", length=100)
   */
  protected $firstname = '';

  /**
   * @ORM\Column(type="string", length=100)
   */
  protected $lastname = '';

  /**
   * @ORM\Column(type="string", length=100, unique=true)
   */
  protected $username = '';

  /**
   * @ORM\Column(type="string", length=255, unique=true)
   */
  protected $email = '';

  // Keine Annotation mehr und somit auch keine DB-Speicherung
  protected $password = '';


  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $hash = '';

  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Gedmo\Timestampable(on="create")
   */
  protected $createdAt;

  /**
   * @ORM\OneToMany(targetEntity="Article", mappedBy="user" )
   */
  protected $articles;

  /**
   * @ORM\OneToMany(targetEntity="Movie", mappedBy="user" )
   */
  protected $movies;

  use \Traits\ArrayMappable;

  public function __construct(array $data = [])
  {
    $this->articles = new ArrayCollection();
    $this->movies = new ArrayCollection();
    $this->mapFromArray($data);
  }

  /**** GETTER und SETTER- Methoden */

  public function getId()
  {
    return $this->id;
  }

  public function getFirstname()
  {
    return $this->firstname;
  }

  public function getLastname()
  {
    return $this->lastname;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getCreatedAt()
  {
    return new Util\DateTime($this->createdAt);
  }

  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;
    return $this;
  }

  public function setLastname($lastname)
  {
    $this->lastname = $lastname;
    return $this;
  }

  public function setUsername($username)
  {
    $this->username = $username;
    return $this;
  }

  public function setEmail($email)
  {
    $this->email = $email;
    return $this;
  }

  public function setPassword($password)
  {
    $this->password = $password;

    // Attribut $hash befuellen
    $this->hashPassword();

    return $this;
  }

  // Article //////
  public function getArticles()
  {
    return $this->articles;
  }

  public function clearArticles()
  {
    $this->articles->clear();
    return $this;
  }

  public function addArticle(Article $article)
  {
    $this->articles->add($article);

    return $this;
  }

  public function hasArticle(Article $article)
  {
    return $this->articles->contains($article);
  }

  public function removeArticle(Article $article)
  {
    $this->articles->removeElement($article);
    return $this;
  }


  // Movies //////
  public function getMovies()
  {
    return $this->movies;
  }

  public function clearMovies()
  {
    $this->movies->clear();
    return $this;
  }

  public function addMovie(Movie $movie)
  {
    $this->movies->add($movie);

    return $this;
  }

  public function hasMovie(Movie $movie)
  {
    return $this->movies->contains($movie);
  }

  public function removeMovie(Movie $movie)
  {
    $this->movies->removeElement($movie);
    return $this;
  }

  /* Password-Hashing  */
  protected function hashPassword()
  {
    if (!empty($this->password)) {
      $this->hash = password_hash($this->password, self::HASH_ALGO, self::HASH_OPTIONS);
    }
  }

  public function verifyPasswordHash($password)
  {
    return password_verify($password, $this->hash);
  }

  public function checkPasswordNeedsRehash()
  {
    return password_needs_rehash($this->hash, self::HASH_ALGO, self::HASH_OPTIONS);
  }
}
