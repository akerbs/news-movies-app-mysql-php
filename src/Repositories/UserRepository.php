<?php 

namespace Repositories;

use Entities\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {
  public function findDuplicateUsernames(User $user) {
    $em = $this->getEntityManager();
    
    $query = $em->createQueryBuilder()
        ->select('U')
        ->from('Entities\User', 'U')
        ->where('U.username = :username')
        ->andWhere('U.id != :id')
        ->setParameter('username', $user->getUsername())
        ->setParameter('id', $user->getId())
        ->getQuery();
      
    return $query->getResult();
  }

  public function findDuplicateEmails(User $user) {
    // fill me
  }
}