<?php

namespace App\Repository\Blog;

use App\Entity\Blog\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Image|null find($id, $lockMode = null, $lockVersion = null)
 * @method Image|null findOneBy(array $criteria, array $orderBy = null)
 * @method Image[]    findAll()
 * @method Image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{

    /**
     * ImageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    /**
     * Get image
     *
     * @param $id
     * @return Image
     */
    public function get($id): Image
    {
        $image = $this->find($id);
        if (!$image)
            throw new NotFoundHttpException('Image doesn\'t exist.');
        return $image;
    }

    /**
     * Save image
     *
     * @param Image $image
     * @return void
     */
    public function save(Image $image): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($image);
        $entityManager->flush();
    }

    /**
     * Delete image
     *
     * @param Image $image
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Image $image): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($image);
        $entityManager->flush();
    }


}
