<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Post;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use DateTimeImmutable;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class CommentService implements CommentServiceInterface
{
    private CommentRepository $commentRepository;

    private PostRepository $postRepository;
    private PaginatorInterface $paginator;


    public function __construct (CommentRepository $commentRepository, PostRepository $postRepository, PaginatorInterface $paginator) {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
        $this->paginator = $paginator;
    }




    /**
     * Save entity.
     *
     * @param Comment $category Comment entity
     */
    public function save(Comment $comment): void
    {
        if ($comment->getId() == null) {
            $comment->setCreatedAt(new DateTimeImmutable());
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