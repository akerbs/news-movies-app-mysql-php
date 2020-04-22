<?php 

namespace Entities;

use Doctrine\ORM\Mapping as ORM;
use Webmasters\Doctrine\ORM\Util;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="genres")
 */
class Genre {
  
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  protected $id = 0;

  /**
   * @ORM\Column(type="string", length=100, unique=true)
   */
  protected $name = '';

  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Gedmo\Timestampable(on="create")
   */
  protected $createdAt;

  /**
   * @ORM\ManyToMany(targetEntity="Movie", mappedBy="genres")
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
  
  public function getName(){
    return $this->name;
  }

  public function getCreatedAt() {
    return new Util\DateTime($this->createdAt);
  }

  public function setName($name){
    $this->name = $name;
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