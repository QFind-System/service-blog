<?php

namespace App\Repository\Blog;

use App\Entity\Blog\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Page|null find($id, $lockMode = null, $lockVersion = null)
 * @method Page|null findOneBy(array $criteria, array $orderBy = null)
 * @method Page[]    findAll()
 * @method Page[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends ServiceEntityRepository
{

    /**
     * PageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }

    /**
     * Get page
     *
     * @param $id
     * @return Page
     */
    public function get($id): Page
    {
        $page = $this->find($id);
        if (!$page)
            throw new NotFoundHttpException('Page doesn\'t exist.');
        return $page;
    }

    /**
     * Save page
     *
     * @param Page $post
     * @return void
     */
    public function save(Page $page): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($page);
        $entityManager->flush();
    }

    /**
     * Delete page
     *
     * @param Page $post
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Page $page): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($page);
        $entityManager->flush();
    }


}
