<?php 

namespace Repositories;

use Entities\Article;
use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository {
 public function searchBy($like) {
    $em = $this->getEntityManager();

    $query = $em->createQueryBuilder()
      ->select('A')
      ->from('Entities\Article', 'A')
      ->where('A.title LIKE :search')
      ->orWhere('A.teaser LIKE :search')
      ->setParameter('search', '%'.$like.'%' )
      ->orderBy('A.createdAt', 'DESC')
      ->getQuery();

    return $query->getResult();
 }
}