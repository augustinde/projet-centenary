<?php

namespace App\Repository;

use App\Entity\Centenary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Centenary>
 *
 * @method Centenary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Centenary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Centenary[]    findAll()
 * @method Centenary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CentenaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Centenary::class);
    }

    public function add(Centenary $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Centenary $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Centenary[] Returns an array of Centenary objects
     */
    public function findAddedByYear($year): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.updated_at LIKE :val')
            ->setParameter('val', $year)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Centenary
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
