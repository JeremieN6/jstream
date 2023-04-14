<?php

namespace App\Repository;

use App\Entity\SaisonEpisodes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaisonEpisodes>
 *
 * @method SaisonEpisodes|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaisonEpisodes|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaisonEpisodes[]    findAll()
 * @method SaisonEpisodes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisonEpisodesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaisonEpisodes::class);
    }

    public function save(SaisonEpisodes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SaisonEpisodes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SaisonEpisodes[] Returns an array of SaisonEpisodes objects
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

//    public function findOneBySomeField($value): ?SaisonEpisodes
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
