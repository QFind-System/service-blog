<?php

namespace App\Entity\Blog;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Blog\PostRepository")
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $link;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * Many Posts has One Image.
     * @ORM\ManyToOne(targetEntity="\App\Entity\Blog\Image", inversedBy="post", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image", referencedColumnName="id",  nullable=false)
     */
    private $image;

    /**
     * @var string The status of post
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $status = "new";

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Blog\Page", mappedBy="post",cascade={"persist"})
     */
    private $page;

    /**
     * @ORM\Column(type="integer")
     */
    private $created_by;

    /**
     * @ORM\Column(type="integer")
     */
    private $updated_by;

    /**
     * @var \DateTime $created_at
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public static $STATUS_NEW = "new";
    public static $STATUS_ACTIVE = "active";
    public static $STATUS_BLOCKED = "blocked";

    public static function statusList(): array
    {
        return [
            self::$STATUS_NEW => 'new',
            self::$STATUS_ACTIVE => 'active',
            self::$STATUS_BLOCKED => 'blocked',
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    public function setCreatedBy(string $created_by): self
    {
        $this->created_by = $created_by;
        return $this;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updated_by;
    }

    public function setUpdatedBy(string $updated_by): self
    {
        $this->updated_by = $updated_by;
        return $this;
    }


    /**
     * Gets triggered only on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created_at = new \DateTime("now");
        return $this;
    }

    /**
     * Gets triggered every time on update
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated_at = new \DateTime("now");
        return $this;
    }

}
