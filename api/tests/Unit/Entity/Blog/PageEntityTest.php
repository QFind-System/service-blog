<?php

namespace App\Tests\Unit\Entity\Blog;

use App\Entity\Blog\Image;
use App\Entity\Blog\Page;
use App\Entity\Blog\Post;
use App\Tests\Unit\Base;


class PageEntityTest extends Base
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
        $post->setTitle($this->faker->title);
        $post->setLink($this->faker->url);
        $post->setContent($this->faker->text);
        $post->setStatus(Post::$STATUS_ACTIVE);

        $page = new Page();
        $page->setTitle($title = $this->faker->title);
        $page->setLink($link = $this->faker->url);
        $page->setContent($content = $this->faker->text);
        $page->setStatus($status = Page::$STATUS_ACTIVE);
        $post->setImage($image);
        $page->setCreatedBy($createdBy = $this->faker->randomDigitNotNull);
        $page->setUpdatedBy($updatedBy = $this->faker->randomDigitNotNull);
        $page->setPost($post);

        $this->assertEquals($title, $page->getTitle());
        $this->assertEquals($link, $page->getLink());
        $this->assertEquals($content, $page->getContent());
        $this->assertEquals($status, Page::$STATUS_ACTIVE);
        $this->assertEquals($createdBy, $page->getCreatedBy());
        $this->assertEquals($updatedBy, $page->getUpdatedBy());
        $this->assertEquals($post->getTitle(), $page->getPost()[0]->getTitle());
        $this->assertEquals($image->getTitle(), $post->getImage()->getTitle());
    }
}
