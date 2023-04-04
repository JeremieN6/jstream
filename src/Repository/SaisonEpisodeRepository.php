<?php

namespace App\Repository;

use App\Entity\SaisonEpisode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaisonEpisode>
 *
 * @method SaisonEpisode|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaisonEpisode|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaisonEpisode[]    findAll()
 * @method SaisonEpisode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisonEpisodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaisonEpisode::class);
    }

    public function save(SaisonEpisode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SaisonEpisode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SaisonEpisode[] Returns an array of SaisonEpisode objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SaisonEpisode
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
