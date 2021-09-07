<?php

namespace App\Tests\Unit\Service\Helper;

use App\Entity\Blog\Post;
use App\Service\Helper\SerializeService;
use App\Tests\Unit\Base;

class SerializeServiceTest extends Base
{
    /**
     * @test
     */
    public function serialize(): void
    {
        $serializeService = new SerializeService();
        $result = $serializeService->serialize(Post::class);

        $this->assertTrue(is_string($result));
    }

    /**
     * @test
     */
    public function normalize(): void
    {
        $serializeService = new SerializeService();
        $result = $serializeService->normalize(array(Post::class));
        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     */
    public function deserialize(): void
    {
        $serializeService = new SerializeService();
        $serializeUser = $serializeService->serialize(Post::class);
        $result = $serializeService->deserialize($serializeUser, Post::class, 'json');

        $this->assertTrue($result instanceof Post);
    }
}
