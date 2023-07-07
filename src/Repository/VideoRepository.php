<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Video>
 *
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    public function save(Video $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Video $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function queryFindAll(): Query
    {
        return $this->createQueryBuilder('v')
            ->getQuery();
    }

    public function findLikeName(?string $search): Query
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.title LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->getQuery();
    }

    public function sortByLikes(): array
    {
        $query = $this->createQueryBuilder('v')
            ->leftJoin('v.userLikes', 'userLikes')
            ->groupBy('v')
            ->orderBy('COUNT(userLikes.id)', 'DESC');

        return $query->getQuery()->getResult();
    }

    public function findVideoByCatAndTag(int $categoryId, int $tagId): array
    {
        $query = $this->createQueryBuilder('v')
            ->join('v.category', 'c')
            ->join('v.tag', 't')
            ->where('c.id = :categoryId')
            ->andWhere('t.id = :tagId')
            ->setParameter('categoryId', $categoryId)
            ->setParameter('tagId', $tagId);

        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Video[] Returns an array of Video objects
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

//    public function findOneBySomeField($value): ?Video
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
