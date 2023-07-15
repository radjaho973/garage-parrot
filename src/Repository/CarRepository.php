<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function save(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
     * @return array tableau contenant un tableau associatif 
     * avec year_min & year_max 
     */
    function getMinMaxYear(){
        $qb= $this->createQueryBuilder('c')
        ->select("MIN(c.yearPlacedInCirculation) AS year_min")
        ->addSelect("MAX(c.yearPlacedInCirculation) AS year_max");
        return $qb->getQuery()->getResult();
    }
    /**
     * @return array tableau contenant un tableau associatif 
     * avec price_min & price_max 
     */
    function getMinMaxPrice(){
        $qb= $this->createQueryBuilder('c')
        ->select("MIN(c.price) AS price_min")
        ->addSelect("MAX(c.price) AS price_max");
        return $qb->getQuery()->getResult();
    }
    /**
     * @param array json passé  en tableau associatif
     * @return array tableau contenant un tableau associatif 
     * avec price_min & price_max 
     */
    function search($data){

        //si il n'ya pas de marque et pas de catégorie choisie
        // donc que les 2 empty() renvoie true
        if( empty( trim($data["brandInput"]) ) &&
         empty( trim($data["categoryInput"]) ) ){
            
            $qb = $this->createQueryBuilder('c')
            ->andWhere('c.price <= :priceData')
            ->andWhere('c.yearPlacedInCirculation <= :yearData')
            ->setParameter('yearData', $data["yearInput"] )
            ->setParameter('priceData', $data["priceInput"])
            ;
            return $qb->getQuery()->getResult();
        }
        //si il y'a une marque et une catégorie choisie
        // donc que les 2 empty() renvoie false
        if( !empty( trim($data["brandInput"]) ) &&
         !empty( trim($data["categoryInput"]) ) ){
            
             $qb = $this->createQueryBuilder('c')
             ->andWhere('c.yearPlacedInCirculation <= :yearData')
             ->andWhere('c.price <= :priceData')
             ->join("c.category","cat")
             ->andWhere("cat.id = :catData")
             ->join("c.brand","b")
             ->andWhere("b.id = :brandData")
             ->setParameter('yearData', $data["yearInput"] )
             ->setParameter('priceData', $data["priceInput"])
             ->setParameter('catData', $data["categoryInput"])
             ->setParameter('brandData', $data["brandInput"])
             ;
             
            return $qb->getQuery()->getResult();
        }
        // si il y'a une marque et pas de catégorie choisie
        if( !empty( trim($data["brandInput"]) ) &&
         empty( trim($data["categoryInput"]) ) ){
            
            $qb = $this->createQueryBuilder('c')
            ->andWhere('c.yearPlacedInCirculation <= :yearData')
            ->andWhere('c.price <= :priceData')
            ->join("c.brand","b")
            ->andWhere("b.id = :brandData")
            ->setParameter('yearData', $data["yearInput"] )
            ->setParameter('priceData', $data["priceInput"])
            ->setParameter('brandData', $data["brandInput"])
            ;

            return $qb->getQuery()->getResult();
        }
        //si il n'y a pas de marque mais une catégorie choisie
        if( empty( trim($data["brandInput"]) ) &&
         !empty( trim($data["categoryInput"]) ) ){
            
            $qb = $this->createQueryBuilder('c')
             ->andWhere('c.yearPlacedInCirculation <= :yearData')
             ->andWhere('c.price <= :priceData')
             ->join("c.category","cat")
             ->andWhere("cat.id = :catData")
             ->setParameter('yearData', $data["yearInput"] )
             ->setParameter('priceData', $data["priceInput"])
             ->setParameter('catData', $data["categoryInput"])
             ;
             
            return $qb->getQuery()->getResult();
        }
        
    }
}
