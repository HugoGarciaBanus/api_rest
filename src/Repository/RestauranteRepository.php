<?php

namespace App\Repository;

use App\Entity\Restaurante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Restaurante>
 *
 * @method Restaurante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurante[]    findAll()
 * @method Restaurante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestauranteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurante::class);
    }

    public function add(Restaurante $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Restaurante $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByDayTimeMunicipio($dia, $hora, $idMunicipio){


        //Creamos la Query y le añadimos un alias
        return $this->createQueryBuilder('restaurante')
            ->join('restaurante.horarios', 'horarios')
            ->join('restaurante.municipio', 'municipio')
            ->where('municipio.id = :idMunicipio')
            ->andWhere('horarios.dia = :dia')
            ->andWhere('horarios.apertura <= :hora')
            ->andWhere('horarios.cierre >= :hora')
            ->setParameters(new ArrayCollection(
                [
                    new Parameter('idMunicipio', $idMunicipio),
                    new Parameter('dia', $dia),
                    new Parameter('hora', $hora)
                ]
            ))
            ->orderBy('restaurante.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Restaurante[] Returns an array of Restaurante objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Restaurante
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
