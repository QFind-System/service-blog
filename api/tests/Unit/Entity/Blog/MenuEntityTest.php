<?php

namespace App\Tests\Unit\Entity\Blog;

use App\Entity\Blog\Menu;
use App\Entity\Blog\Page;
use App\Tests\Unit\Base;


class MenuEntityTest extends Base
{
    /**
     * @test
     */
    public function checkEntity(): void
    {
        $page = new Page();
        $page->setTitle($this->faker->title);
        $page->setLink($this->faker->url);
        $page->setContent($this->faker->text);
        $page->setStatus(Page::$STATUS_ACTIVE);

        $menu = new Menu();
        $menu->setTitle($title = $this->faker->title);
        $menu->setStatus($status = Menu::$STATUS_ACTIVE);
        $menu->setPage($page);
        $menu->setCreatedBy($createdBy = $this->faker->randomDigitNotNull);
        $menu->setUpdatedBy($updatedBy = $this->faker->randomDigitNotNull);

        $this->assertEquals($title, $menu->getTitle());
        $this->assertEquals($status, Menu::$STATUS_ACTIVE);
        $this->assertEquals($createdBy, $menu->getCreatedBy());
        $this->assertEquals($updatedBy, $menu->getUpdatedBy());
        $this->assertEquals($page->getTitle(), $menu->getPage()[0]->getTitle());
    }
}
