<?php
/**
 * This is the license block.
 * It can contain licensing information, copyright notices, etc.
 */

namespace App\Service;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Comment Service.
 */
class CommentService implements CommentServiceInterface
{
    private CommentRepository $commentRepository;

    private PostRepository $postRepository;
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param CommentRepository  $commentRepository Category repository
     * @param PostRepository     $postRepository    Report
     * @param PaginatorInterface $paginator         Paginator
     */
    public function __construct(CommentRepository $commentRepository, PostRepository $postRepository, PaginatorInterface $paginator)
    {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
        $this->paginator = $paginator;
    }

    /**
     * Save entity.
     *
     * @param Comment $comment Comment entity
     */
    public function save(Comment $comment): void
    {
        if (null === $comment->getId()) {
            $comment->setCreatedAt(new \DateTimeImmutable());
        }
        $this->commentRepository->save($comment);
    }

    /**
     * Delete entity.
     *
     * @param Comment $comment Comment entity
     */
    public function delete(Comment $comment): void
    {
        $this->commentRepository->delete($comment);
    }
}
