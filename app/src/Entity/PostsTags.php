<?php

namespace App\Entity;

use App\Repository\PostsTagsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsTagsRepository::class)]
class PostsTags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $post_id = null;

    #[ORM\Column]
    private ?int $tags_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    public function setPostId(int $post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }

    public function getTagsId(): ?int
    {
        return $this->tags_id;
    }

    public function setTagsId(int $tags_id): self
    {
        $this->tags_id = $tags_id;

        return $this;
    }
}
