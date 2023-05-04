<?php

namespace App\Repository;

use App\Entity\FermeVeterinaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FermeVeterinaire>
 *
 * @method FermeVeterinaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method FermeVeterinaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method FermeVeterinaire[]    findAll()
 * @method FermeVeterinaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FermeVeterinaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FermeVeterinaire::class);
    }

    public function save(FermeVeterinaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FermeVeterinaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FermeVeterinaire[] Returns an array of FermeVeterinaire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FermeVeterinaire
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
