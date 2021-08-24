<?php

namespace App\Repository\Blog;

use App\Entity\Blog\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Menu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menu[]    findAll()
 * @method Menu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuRepository extends ServiceEntityRepository
{

    /**
     * MenuRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    /**
     * Get menu
     *
     * @param $id
     * @return Menu
     */
    public function get($id): Menu
    {
        $menu = $this->find($id);
        if (!$menu)
            throw new NotFoundHttpException('Menu doesn\'t exist.');
        return $menu;
    }

    /**
     * Save menu
     *
     * @param Menu $post
     * @return void
     */
    public function save(Menu $menu): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($menu);
        $entityManager->flush();
    }

    /**
     * Delete menu
     *
     * @param Menu $menu
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Menu $menu): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($menu);
        $entityManager->flush();
    }


}
