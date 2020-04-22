<?php 

namespace Entities;

use Entities\Movie;
use Doctrine\ORM\Mapping as ORM;
use Webmasters\Doctrine\ORM\Util;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="writers")
 */
class Writer {
  
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
   * @ORM\Column(type="text")
   */
  protected $biography = '';

  /**
   * @ORM\Column(type="string", length=1)
   */
  protected $gender = '';

  /**
   * @ORM\Column(type="date", nullable=true)
   */
  protected $birthdate;

  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Gedmo\Timestampable(on="create")
   */
  protected $createdAt;

  /**
   * @ORM\ManyToMany(targetEntity="Movie", mappedBy="writers")
   */
  protected $movies;

  use \Traits\ArrayMappable;

  public function __construct(array $data = []) {
    $this->mapFromArray($data);
    $this->movies = new ArrayCollection();
  }

/**** GETTER und SETTER- Methoden */

  public function getId() {
    return $this->id;
  }
  
  public function getFirstname() { 
    return $this->firstname;
  }
  
  public function getLastname() {
    return $this->lastname;
  }

  public function getBiography() {
    return $this->biography;
  }

  public function getGender() {
    return $this->gender;
  }

  public function getBirthdate() {
    return new Util\DateTime($this->birthdate);
  }


  public function getCreatedAt() {
    return new Util\DateTime($this->createdAt);
  }

  public function setFirstname($firstname) {
    $this->firstname = $firstname;
    return $this;
  }
  
  public function setLastname($lastname) {
    $this->lastname = $lastname;
    return $this;
  }

  public function setBiography($biography) {
    $this->biography = $biography;
    return $this;
  }

  public function setBirthdate($birthdate) {
        $this->birthdate = new Util\DateTime($birthdate);
    }

  public function setGender($gender) {
    $this->gender = $gender;
    return $this;
  }

  // Movies //////
  public function getMovies() {
    return $this->movies; 
  }

  public function clearMovies() {
    $this->movies->clear();
    return $this;
  }


  public function addMovie(Movie $movie) {
    $this->movies->add($movie);
     
    return $this;
  }

  public function hasMovie(Movie $movie) {
    return $this->movies->contains($movie);
  }

  public function removeMovie(Movie $movie) {
    $this->movies->removeElement($movie);
    return $this;
  }

}