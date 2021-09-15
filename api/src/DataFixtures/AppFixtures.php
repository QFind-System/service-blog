<?php

namespace App\DataFixtures;

use App\Entity\Blog\Image;
use App\Entity\Blog\Menu;
use App\Entity\Blog\Post;
use App\Entity\Blog\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $image1 = $this->createImage('Image 1', 'image_1.jpg', 'image 1', Image::$STATUS_ACTIVE, 1, 1);
        $image2 = $this->createImage('Image 2', 'image_3.jpg', 'image 2', Image::$STATUS_NEW, 1, 1);
        $image3 = $this->createImage('Image 3', 'image_.jpg', 'image 3', Image::$STATUS_ACTIVE, 1, 1);

        $post1 = $this->createPost('Post 1', 'post_1', 'Post 1 content text ...', $image1, Post::$STATUS_ACTIVE, 1, 1);
        $post2 = $this->createPost('Post 2', 'post_2', 'Post 2 content text ...', $image2, Post::$STATUS_ACTIVE, 1, 1);
        $post3 = $this->createPost('Post 3', 'post_3', 'Post 3 content text ...', $image2, Post::$STATUS_NEW, 1, 1);
        $post4 = $this->createPost('Post 4', 'post_4', 'Post 4 content text ...', $image2, Post::$STATUS_ACTIVE, 1, 1);
        $post5 = $this->createPost('Post 5', 'post_5', 'Post 5 content text ...', $image2, Post::$STATUS_ACTIVE, 1, 1);

        $page1 = $this->createPage('Page 1', 'page_1', 'Page 1 content text ...', $image1, Page::$STATUS_ACTIVE, 1, 1, [$post1, $post2]);
        $page2 = $this->createPage('Page 2', 'page_2', 'Page 2 content text ...', $image3, Page::$STATUS_ACTIVE, 1, 1, [$post3]);

        $menu1 = $this->createMenu('Menu 1', Menu::$STATUS_ACTIVE, 1, 1, [$page1, $page2]);
        $menu2 = $this->createMenu('Menu 2', Menu::$STATUS_NEW, 1, 1, [$page1]);

        // Save
        $manager->persist($image1);
        $manager->persist($image2);
        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        $manager->persist($post4);
        $manager->persist($post5);
        $manager->persist($page1);
        $manager->persist($page2);
        $manager->persist($menu1);
        $manager->persist($menu2);
        $manager->flush();
    }

    private function createImage($title, $link, $alt, $status, $createdBy, $updatedBy): Image
    {
        $image = new Image();
        $image->setTitle($title);
        $image->setLink($link);
        $image->setAlt($alt);
        $image->setStatus($status);
        $image->setCreatedBy($createdBy);
        $image->setUpdatedBy($updatedBy);
        $image->onPrePersist();
        $image->onPreUpdate();
        return $image;
    }

    private function createPost($title, $link, $content, $image, $status, $createdBy, $updatedBy): Post
    {
        $post = new Post();
        $post->setTitle($title);
        $post->setLink($link);
        $post->setContent($content);
        $post->setImage($image);
        $post->setStatus($status);
        $post->setCreatedBy($createdBy);
        $post->setUpdatedBy($updatedBy);
        $post->onPrePersist();
        $post->onPreUpdate();
        return $post;
    }

    private function createPage($title, $link, $content, $image, $status, $createdBy, $updatedBy, array $posts): Page
    {
        $page = new Page();
        $page->setTitle($title);
        $page->setLink($link);
        $page->setContent($content);
        $page->setImage($image);
        $page->setStatus($status);
        foreach ($posts as $post) {
            $page->setPost($post);
        }
        $page->setCreatedBy($createdBy);
        $page->setUpdatedBy($updatedBy);
        $page->onPrePersist();
        $page->onPreUpdate();
        return $page;
    }

    private function createMenu($title, $status, $createdBy, $updatedBy, array $pages): Menu
    {
        $menu = new Menu();
        $menu->setTitle($title);
        $menu->setStatus($status);
        foreach ($pages as $page) {
            $menu->setPage($page);
        }
        $menu->setCreatedBy($createdBy);
        $menu->setUpdatedBy($updatedBy);
        $menu->onPrePersist();
        $menu->onPreUpdate();
        return $menu;
    }
}
