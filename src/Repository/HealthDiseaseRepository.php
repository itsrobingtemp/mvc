<?php

namespace App\Repository;

use App\Entity\HealthDisease;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HealthDisease>
 *
 * @method HealthDisease|null find($id, $lockMode = null, $lockVersion = null)
 * @method HealthDisease|null findOneBy(array $criteria, array $orderBy = null)
 * @method HealthDisease[]    findAll()
 * @method HealthDisease[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HealthDiseaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HealthDisease::class);
    }

    public function save(HealthDisease $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HealthDisease $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findItemsByTypeAndCountry($type, $country): array
    {   
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $queryBuilder
            ->select('dataPoint')
            ->from(HealthDisease::class, 'dataPoint')
            ->where('dataPoint.type = :type')
            ->andWhere('dataPoint.country = :country')
            ->setParameter('type', $type)
            ->setParameter('country', $country)
            ->getQuery();

        $items = $query->getResult();

        return $items;
    }

//    /**
//     * @return HealthDisease[] Returns an array of HealthDisease objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HealthDisease
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
