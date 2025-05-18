<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Model\PropertySearch;


/**
 * @extends ServiceEntityRepository<Property>
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function search(PropertySearch $search): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.type', 'pt')
            ->addSelect('pt');

        if ($search->getTitle()) {
            $qb->andWhere('p.title LIKE :title')
                ->setParameter('title', '%' . $search->getTitle() . '%');
        }

        if ($search->getPurpose()) {
            $qb->andWhere('p.purpose = :purpose')
                ->setParameter('purpose', $search->getPurpose());
        }

        if ($search->getType()) {
            $qb->andWhere('p.type = :type')
                ->setParameter('type', $search->getType());
        }

        return $qb->getQuery()->getResult();
    }


    //    /**
    //     * @return Property[] Returns an array of Property objects
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

    //    public function findOneBySomeField($value): ?Property
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
