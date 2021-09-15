<?php

namespace App\Validation\Blog\Post;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

/**
 * Class UpdatePostValidation
 * @package App\Validation\Blog\Post
 */
class UpdatePostValidation
{
    /**
     * Validor for update post
     *
     * @param array $data
     * @return ConstraintViolationListInterface
     */
    public function validate(array $data): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        $constraint = new Assert\Collection(
            [
                'title' =>
                    [
                        new Assert\NotBlank()
                    ],
                'link' =>
                    [
                        new Assert\NotBlank()
                    ],
                'content' =>
                    [
                        new Assert\NotBlank()
                    ],
                'status' =>
                    [
                        new Assert\NotBlank()
                    ],
                'created_by' =>
                    [
                        new Assert\NotBlank()
                    ],
                'updated_by' =>
                    [
                        new Assert\NotBlank()
                    ]

            ]
        );
        return $validator->validate($data, $constraint);
    }
}
