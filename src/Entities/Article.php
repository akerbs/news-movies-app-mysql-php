<?php 

namespace Entities;

use Entities\Tag;
use Entities\User;
use Doctrine\ORM\Mapping as ORM;
use Webmasters\Doctrine\ORM\Util;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Repositories\ArticleRepository")
 * @ORM\Table(name="articles")
 */
class Article {
  
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  protected $id = 0;

  /**
   * @ORM\Column(type="string", length=80)
   */
  protected $title = '';

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $teaser = '';

  /**
   * @ORM\Column(type="text")
   */
  protected $news;

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
   * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
   */
  protected $user;

  /**
   * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles")
   * @ORM\JoinTable(name="tagging")
   */
  protected $tags;

  use \Traits\ArrayMappable;

  public function __construct(array $data = []) {
    $this->mapFromArray($data);
    $this->tags = new ArrayCollection();
  }

/**** GETTER und SETTER- Methoden */

  public function getId() {
    return $this->id;
  }
  
  public function getTitle() {
    return $this->title;
  }

  public function getTeaser() {
    return $this->teaser;
  }

  public function getNews() {
    return $this->news;
  }
 
  public function getCreatedAt() {
    return new Util\DateTime($this->createdAt);
  }

  public function getPublishAt() {
    return new Util\DateTime($this->publishAt);
  }

  public function getUser() {
    return $this->user;
  }
 

  // public function setId($id) {
  //   $this->id = $id;
  //   return $this;
  // }

  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  public function setTeaser($teaser) {
    $this->teaser = $teaser;
    return $this;
  }

  public function setNews($news) {
    $this->news = $news;
    return $this;
  }

  public function setPublishAt($publishAt) {
    // wenn publishAt leer, dann das aktuelle Datum über "new Util\DateTime('now');" abspeichern
    if(empty($publishAt)) {
      $publishAt = 'now';
    }

    $this->publishAt = new Util\DateTime($publishAt); 
  }

  public function setUser(?User $user) {
    $this->user = $user;
    return $this;
  }

  // Tags //////
  public function getTags() {
    return $this->tags; 
  }

  public function clearTags() {
    $this->tags->clear();
    return $this;
  }

  public function addTag(Tag $tag) {
    $this->tags->add($tag);
  
    return $this;
  }

  public function hasTag(Tag $tag) {
    return $this->tags->contains($tag);
  }

  public function removeTag(Tag $tag) {
    $this->tags->removeElement($tag);
    return $this;
  }


}