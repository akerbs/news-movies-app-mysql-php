<?php 

namespace Entities;

use Doctrine\ORM\Mapping as ORM;
use Webmasters\Doctrine\ORM\Util;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Repositories\TagRepository")
 * @ORM\Table(name="tags")
 */
class Tag {
  
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  protected $id = 0;

  /**
   * @ORM\Column(type="string", length=25, unique=true)
   */
  protected $title = '';

  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Gedmo\Timestampable(on="create")
   */
  protected $createdAt;

  
  /**
   * @ORM\ManyToMany(targetEntity="Article", mappedBy="tags")
   */
  protected $articles;


  use \Traits\ArrayMappable;

  public function __construct(array $data = []) {
    $this->mapFromArray($data);
    $this->articles = new ArrayCollection();
  }

/**** GETTER und SETTER- Methoden */

  public function getId() {
    return $this->id;
  }
  
  public function getTitle(){
    return $this->title;
  }

  public function getCreatedAt() {
    return new Util\DateTime($this->createdAt);
  }

  public function setTitle($title){
    $this->title = $title;
    return $this;
  }

  // Article //////
  public function getArticles() {
    return $this->articles; 
  }

  public function clearArticles() {
    $this->articles->clear();
    return $this;
  }

  public function addArticle(Article $article) {
    $this->articles->add($article);
    return $this;
  }

  public function hasArticle(Article $article) {
    return $this->articles->contains($article);
  }

  public function removeArticle(Article $article) {
    $this->articles->removeElement($article);
    return $this;
  }  

}