<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    /**
     * @return Reservation[] Returns an array of Reservation objects
     */
    public function findByMonth(int $year, int $month): array
    {
        $startDate = \DateTime::createFromFormat('Y-n-d H:i:s', $year.'-'.$month.'-01 00:00:00');
        $endDate = (clone $startDate)->modify('+ 1 month - 1 second');
        
        return $this->createQueryBuilder('r')
            ->andWhere('r.date BETWEEN :dateFrom AND :dateTo')
            ->setParameter('dateFrom', $startDate)
            ->setParameter('dateTo', $endDate)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Reservation[] Returns an array of Reservation objects
     */
    public function findByMonthAssoc(int $year, int $month): array
    {
        $startDate = \DateTime::createFromFormat('Y-n-d H:i:s', $year.'-'.$month.'-01 00:00:00');
        $endDate = (clone $startDate)->modify('+ 1 month - 1 second');
        
        return $this->createQueryBuilder('r')
            ->select('r')
            ->leftJoin( 'r.userAt9', 'u9' )
            ->leftJoin( 'r.userAt10', 'u10' )
            ->leftJoin( 'r.userAt11', 'u11' )
            ->leftJoin( 'r.userAt12', 'u12' )
            ->leftJoin( 'r.userAt13', 'u13' )
            ->leftJoin( 'r.userAt14', 'u14' )
            ->leftJoin( 'r.userAt15', 'u15' )
            ->leftJoin( 'r.userAt16', 'u16' )
            ->leftJoin( 'r.userAt17', 'u17' )
            ->andWhere('r.date BETWEEN :dateFrom AND :dateTo')
            ->setParameter('dateFrom', $startDate)
            ->setParameter('dateTo', $endDate)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
//            ->getArrayResult()
        ;
    }

//    public function findOneBySomeField($value): ?Reservation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
