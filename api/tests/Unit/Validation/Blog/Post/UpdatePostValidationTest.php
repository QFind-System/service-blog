<?php

namespace App\Tests\Unit\Validation\Blog\Post;

use App\Entity\Blog\Post;
use App\Tests\Unit\Base;
use App\Validation\Blog\Post\UpdatePostValidation;

class UpdatePostValidationTest extends Base
{
    /**
     * @test
     */
    public function successValidate(): void
    {
        $validate = new UpdatePostValidation();
        $data = [
            'title' => $this->faker->title,
            'link' => $this->faker->url,
            'content' => $this->faker->text,
            'status' => Post::$STATUS_ACTIVE,
            'created_by' => $this->faker->randomDigitNotNull,
            'updated_by' => $this->faker->randomDigitNotNull
        ];
        $result = $validate->validate($data);
        $this->assertEquals(0, $result->count());
    }

    /**
     * @test
     */
    public function failureValidate(): void
    {
        $validate = new UpdatePostValidation();
        $data = ['title' => $this->faker->title];
        $result = $validate->validate($data);
        $this->assertEquals(5, $result->count());
    }
}
