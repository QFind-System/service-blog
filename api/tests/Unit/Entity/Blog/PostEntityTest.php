<?php

namespace App\Tests\Unit\Entity\Blog;

use App\Entity\Blog\Image;
use App\Entity\Blog\Post;
use App\Tests\Unit\Base;


class PostEntityTest extends Base
{
    /**
     * @test
     */
    public function checkEntity(): void
    {
        $image = new Image();
        $image->setTitle($this->faker->title);
        $image->setLink($this->faker->url);
        $image->setAlt($this->faker->title);
        $image->setStatus(Image::$STATUS_ACTIVE);

        $post = new Post();
        $post->setTitle($title = $this->faker->title);
        $post->setLink($link = $this->faker->url);
        $post->setContent($content = $this->faker->text);
        $post->setStatus($status = Post::$STATUS_ACTIVE);
        $post->setImage($image);
        $post->setCreatedBy($createdBy = $this->faker->randomDigitNotNull);
        $post->setUpdatedBy($updatedBy = $this->faker->randomDigitNotNull);

        $this->assertEquals($title, $post->getTitle());
        $this->assertEquals($link, $post->getLink());
        $this->assertEquals($content, $post->getContent());
        $this->assertEquals($status, Post::$STATUS_ACTIVE);
        $this->assertEquals($createdBy, $post->getCreatedBy());
        $this->assertEquals($updatedBy, $post->getUpdatedBy());
        $this->assertEquals($image->getTitle(), $post->getImage()->getTitle());
    }
}
