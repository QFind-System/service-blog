<?php

namespace App\Controller\Blog;

use App\Service\Blog\PostService;
use App\Validation\Blog\Post\CreatePostValidation;
use App\Validation\Blog\Post\UpdatePostValidation;
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
     * @Route("",  methods={"POST"})
     * Create post
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $violations = (new CreatePostValidation())->validate($data);
        if ($violations->count() > 0) {
            return new JsonResponse(["error" => (string)$violations], Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->postService->create($data);
            return new JsonResponse(['message' => "Created successful"], Response::HTTP_CREATED);
        } catch(\InvalidArgumentException $e) {
            return new JsonResponse(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/{id}",  methods={"PUT"})
     * Update post
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $violations = (new UpdatePostValidation())->validate($data);
        if ($violations->count() > 0) {
            return new JsonResponse(["error" => (string)$violations], Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->postService->update($data, $id);
            return new JsonResponse(['message' => "Updated successful"], Response::HTTP_OK);
        } catch(NotFoundHttpException $e) {
            return new JsonResponse(["error" => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch(\InvalidArgumentException $e) {
            return new JsonResponse(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
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
