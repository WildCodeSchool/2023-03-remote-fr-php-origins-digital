<?php

namespace App\Repository;

use App\Entity\VideoBookmarks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VideoBookmarks>
 *
 * @method VideoBookmarks|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoBookmarks|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoBookmarks[]    findAll()
 * @method VideoBookmarks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoBookmarksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoBookmarks::class);
    }

    public function save(VideoBookmarks $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VideoBookmarks $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return VideoBookmarks[] Returns an array of VideoBookmarks objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VideoBookmarks
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
