<?php

namespace App\Repository\Blog;

use App\Entity\Blog\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    /**
     * @var int
     */
    private $pageCount;

    /**
     * PostRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
        $this->pageCount = $_ENV['PAGE_COUNT'];
    }

    /**
     * Get all posts
     *
     * @param string $title
     * @param string $status
     * @param null $page
     * @return array
     */
    public function getAll(string $title, string $status, $page = null): array
    {
        $qb = $this->createQueryBuilder('u');
        if ($title) {
            $qb->andWhere('u.title LIKE :email')->setParameter('title', "%".$title."%");
        }
        if ($status) {
            $qb->andwhere('u.status = :status')->setParameter('status', $status);
        }

        if ($page) {
            $offset = ($page - 1)  * $this->pageCount;
            $qb->setFirstResult($offset)->setMaxResults($this->pageCount);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Get post
     *
     * @param $id
     * @return Post
     */
    public function get($id): Post
    {
        $post = $this->find($id);
        if (!$post)
            throw new NotFoundHttpException('Post doesn\'t exist.');
        return $post;
    }

    /**
     * Save post
     *
     * @param Post $post
     * @return void
     */
    public function save(Post $post): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($post);
        $entityManager->flush();
    }

    /**
     * Delete post
     *
     * @param Post $post
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Post $post): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($post);
        $entityManager->flush();
    }


}
