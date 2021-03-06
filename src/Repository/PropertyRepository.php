<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery (PropertySearch $search): Query
    {
        $query = $this->findVisibleQuery();

            if($search->getMaxPrice()){
                $query = $query
                    ->andWhere('p.price <= :maxprice')
                    ->setParameter('maxprice', $search->getMaxPrice());
            }
        if($search->getMinSurface()){
            $query = $query
                ->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }
        if ($search->getOptions()->count() > 0)
        {
            $k = 0;
            foreach($search->getOptions() as $k => $option){
                $k++;
                $query = $query
                    ->andWhere(":option$k MEMBER OF p.options")
                    ->setParameter("option$k", $option);
            }
        }
        return $query->getQuery();
    }

    /**
     * @return Property[]
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery (): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
    }

    /**
     * @param Property $property
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * Cr??ation d'une property
     */
    public function create(Property $property)
    {
        $this->getEntityManager()->persist($property);
        $this->getEntityManager()->flush($property);
    }

    /**
     * @param Property $property
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * Edition d'une property
     */
    public function edit(Property $property)
    {
        $this->getEntityManager()->flush($property);
    }

    /**
     * @param Property $property
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * Suppresion d'une property
     */
    public function delete(Property $property)
    {
        $this->getEntityManager()->remove($property);
        $this->getEntityManager()->flush($property);
    }

    /**
     * @param int $id
     * @return Property
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * Lecture d'une property en fonction de son ID
     */
    public function read(int $id): Property
    {
        if ($id >= 0) {
            $property = $this->createQueryBuilder('e')
                ->where('e.id = :id')
                ->setParameter('id', $id);
        }
        $query = $property->getQuery();
        return $query->getSingleResult();
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
