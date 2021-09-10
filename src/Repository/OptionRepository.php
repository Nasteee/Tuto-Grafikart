<?php

namespace App\Repository;

use App\Entity\Option;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Option|null find($id, $lockMode = null, $lockVersion = null)
 * @method Option|null findOneBy(array $criteria, array $orderBy = null)
 * @method Option[]    findAll()
 * @method Option[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Option::class);
    }

    /**
     * Persiste une option en base de données.
     */
    public function create(Option $option)
    {
        $this->getEntityManager()->persist($option);
        $this->getEntityManager()->flush($option);
    }

    public function edit(Option $option)
    {
        $this->getEntityManager()->flush($option);
    }

    public function delete(Option $option)
    {
        $this->getEntityManager()->remove($option);
        $this->getEntityManager()->flush($option);
    }

    public function read(int $id): Option
    {
        if ($id >= 0 ){
            $option = $this->createQueryBuilder('e')
                        ->where('e.id = :id')
                        ->setParameter('id', $id);
        }
        $query = $option->getQuery();
        return $query->getSingleResult();

    }


    // /**
    //  * @return Option[] Returns an array of Option objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Option
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
