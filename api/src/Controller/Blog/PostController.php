<?php

namespace App\Controller\Blog;

use App\Service\Blog\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts")
 */
class PostController extends AbstractController
{
    /**
     * @var PostService
     */
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @Route("/",  methods={"GET"})
     * Get all posts
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function all(Request $request): JsonResponse
    {
        $title = $request->query->get('title');
        $status = $request->query->get('status');
        $page = $request->query->get('page');

        try {
            return new JsonResponse(
                [
                    'posts' => $this->postService->all($title, $status, $page)
                ],  Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/{id}",  methods={"GET"})
     * Get single post
     *
     * @param int $id
     * @return JsonResponse
     */
    public function single(int $id): JsonResponse
    {
        try {
            return new JsonResponse(['post' => $this->postService->single($id)], Response::HTTP_OK);
        } catch(NotFoundHttpException $e) {
            return new JsonResponse(["error" => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/{id}",  methods={"DELETE"})
     * Delete post
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $this->postService->delete($id);
            return new JsonResponse(['message' => "Post was deleted"], Response::HTTP_OK);
        } catch(NotFoundHttpException $e) {
            return new JsonResponse(["error" => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
