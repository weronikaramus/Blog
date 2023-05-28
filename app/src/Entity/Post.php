<?php
/**
 * Post entity.
 */

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'posts')]
class Post
{
    /**
     * Primary key.
     *
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Title.
     *
     * @var String|null
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * Content.
     *
     * @var Text|null
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    /**
     * Created at.
     *
     * @var DateTimeImmutable|null
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * Id of author.
     *
     * @var Integer|null
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Column]
    private ?int $authorId = null;

    /**
     * Id of category.
     *
     * @var Integer|null
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Column]
    private ?int $categoryId = null;

    /**
     * Is published.
     *
     * @var Boolean|null
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Column]
    private ?bool $isPublished = null;

    /**
     * Slug.
     *
     * @var String|null
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    /**
     * Getter for Id.
     *
     * @return int|null Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for title.
     *
     * @return string|null Title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Setter for title.
     *
     * @param string|null $title Title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Setter for content.
     *
     * @param text|null $content Content
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
