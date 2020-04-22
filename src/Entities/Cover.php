<?php 

namespace Entities;

use Entities\Movie;
use Doctrine\ORM\Mapping as ORM;
use Webmasters\Doctrine\ORM\Util;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="covers")
 */
class Cover {
  
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  protected $id = 0;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $path = '';

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $title = '';

  /**
   * @ORM\Column(type="text")
   */
  protected $description = '';

  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Gedmo\Timestampable(on="create")
   */
  protected $createdAt;

  /**
   * @ORM\ManyToOne(targetEntity="Movie", inversedBy="covers")
   */
  protected $movie;

  use \Traits\ArrayMappable;

  public function __construct(array $data = []) {
    $this->mapFromArray($data);
  }

/**** GETTER und SETTER- Methoden */

  public function getId() {
    return $this->id;
  }
  
  public function getPath(){
    return $this->path;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getMovie() {
    return $this->movie;
  }

  public function getCreatedAt() {
    return new Util\DateTime($this->createdAt);
  }
  
  public function setPath($path){
    $this->path = $path;
    return $this;
  }

  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  public function setMovie(Movie $movie) {
    $this->movie = $movie;
    return $this;
  }


}