<?php

namespace App\Repository;

use App\Entity\PlatoCantidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlatoCantidad>
 *
 * @method PlatoCantidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatoCantidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatoCantidad[]    findAll()
 * @method PlatoCantidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatoCantidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatoCantidad::class);
    }

    public function add(PlatoCantidad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlatoCantidad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PlatoCantidad[] Returns an array of PlatoCantidad objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlatoCantidad
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
