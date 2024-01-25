<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
        $userAtColumn = Reservation::USER_COLUMN_BASE_STR;
        
        return $this->createQueryBuilder('r')
            ->select("r.id, r.date, r.{$userAtColumn}9, r.{$userAtColumn}10, r.{$userAtColumn}11, r.{$userAtColumn}12, r.{$userAtColumn}13, r.{$userAtColumn}14, r.{$userAtColumn}15, r.{$userAtColumn}16, r.{$userAtColumn}17")
//            ->leftJoin(\App\Entity\User::class, 'u')
//            ->select( 'r.id, r.date, r.user_id_at_9' )
//            ->select('r.*')
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
