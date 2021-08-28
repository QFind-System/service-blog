<?php

namespace App\Tests\Unit\Entity\Blog;

use App\Entity\Blog\Image;
use App\Tests\Unit\Base;


class ImageEntityTest extends Base
{
    /**
     * @test
     */
    public function checkEntity(): void
    {
        $image = new Image();
        $image->setTitle($title = $this->faker->title);
        $image->setLink($link = $this->faker->url);
        $image->setAlt($alt = $this->faker->title);
        $image->setStatus($status = Image::$STATUS_ACTIVE);
        $image->setCreatedBy($createdBy = $this->faker->randomDigitNotNull);
        $image->setUpdatedBy($updatedBy = $this->faker->randomDigitNotNull);

        $this->assertEquals($title, $image->getTitle());
        $this->assertEquals($link, $image->getLink());
        $this->assertEquals($alt, $image->getAlt());
        $this->assertEquals($status, Image::$STATUS_ACTIVE);
        $this->assertEquals($createdBy, $image->getCreatedBy());
        $this->assertEquals($updatedBy, $image->getUpdatedBy());
    }
}
