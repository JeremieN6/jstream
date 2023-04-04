<?php

namespace App\Repository;

use App\Entity\AnimeSaison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnimeSaison>
 *
 * @method AnimeSaison|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnimeSaison|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnimeSaison[]    findAll()
 * @method AnimeSaison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimeSaisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnimeSaison::class);
    }

    public function save(AnimeSaison $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AnimeSaison $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AnimeSaison[] Returns an array of AnimeSaison objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AnimeSaison
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
