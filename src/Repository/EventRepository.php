<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

        public function findLimited(int $limit = 3): array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.date_start', 'DESC') // ou autre critère
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


        public function searchByCityAndTitle(?string $city, ?string $title): array
    {
        $qb = $this->createQueryBuilder('e');

        if ($city) {
            $qb->andWhere('e.city LIKE :city')
            ->setParameter('city', '%' . $city . '%');
        }

        if ($title) {
            $qb->andWhere('e.title LIKE :title')
            ->setParameter('title', '%' . $title . '%');
        }

        return $qb->getQuery()->getResult();
    }

    public function searchEvents(?string $city, ?string $title): array
{
    $qb = $this->createQueryBuilder('e');

    if (!empty($city)) {
        $qb->andWhere('e.city LIKE :city')
           ->setParameter('city', '%' . $city . '%');
    }

    if (!empty($title)) {
        $qb->andWhere('e.title LIKE :title')
           ->setParameter('title', '%' . $title . '%');
    }

    return $qb->getQuery()->getResult();
}


    //    /**
    //     * @return Event[] Returns an array of Event objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Event
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
