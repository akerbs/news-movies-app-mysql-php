<?php 

namespace Repositories;

use Entities\Tag;
use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository {
  public function findDuplicates(Tag $tag) {
    $em = $this->getEntityManager();
    
    $query = $em->createQueryBuilder()
        ->select('T')
        ->from('Entities\Tag', 'T')
        ->where('T.title = :title')
        ->andWhere('T.id != :id')
        ->setParameter('title', $tag->getTitle())
        ->setParameter('id', $tag->getId())
        ->getQuery();
      
    return $query->getResult();
  }
}