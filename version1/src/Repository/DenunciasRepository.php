<?php

namespace App\Repository;

use App\Entity\Denuncias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Denuncias|null find($id, $lockMode = null, $lockVersion = null)
 * @method Denuncias|null findOneBy(array $criteria, array $orderBy = null)
 * @method Denuncias[]    findAll()
 * @method Denuncias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DenunciasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Denuncias::class);
    }

    // /**
    //  * @return Denuncias[] Returns an array of Denuncias objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Denuncias
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
