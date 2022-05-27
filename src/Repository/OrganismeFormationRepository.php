<?php

namespace App\Repository;

use App\Entity\OrganismeFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrganismeFormation>
 *
 * @method OrganismeFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrganismeFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrganismeFormation[]    findAll()
 * @method OrganismeFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganismeFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrganismeFormation::class);
    }

    public function add(OrganismeFormation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrganismeFormation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OrganismeFormation[] Returns an array of OrganismeFormation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrganismeFormation
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
