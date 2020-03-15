<?php

namespace App\Repository;

use App\Entity\ListOfItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ListOfItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListOfItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListOfItems[]    findAll()
 * @method ListOfItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListOfItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListOfItems::class);
    }

    // /**
    //  * @return ListOfItems[] Returns an array of ListOfItems objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListOfItems
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
