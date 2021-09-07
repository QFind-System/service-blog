<?php

namespace App\Service\Blog;

use App\Repository\Blog\PostRepository;
use App\Service\Helper\SerializeService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use http\Exception\RuntimeException;

/**
 * Class PostService
 * @package App\Service\Blog
 */
class PostService
{
    private $postRepository;

    private $serializeService;

    public function __construct(PostRepository $postRepository, SerializeService $serializeService)
    {
        $this->postRepository = $postRepository;
        $this->serializeService = $serializeService;
    }

    /**
     * Get all posts
     *
     * @param string $title
     * @param string $status
     * @param int $page
     * @return array
     */
    public function all(string $title, string $status, int $page): array
    {
        return $this->serializeService->normalize($this->postRepository->getAll($title, $status, $page));
    }

    /**
     * Get single post
     *
     * @param int $id
     * @return array
     */
    public function single(int $id): array
    {
        return $this->serializeService->normalize($this->postRepository->get($id));
    }

    /**
     * Delete post
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $user = $this->postRepository->get($id);
        try {
            $this->postRepository->delete($user);
        } catch (OptimisticLockException | ORMException $e) {
            throw new RuntimeException($e);
        }
    }
}
