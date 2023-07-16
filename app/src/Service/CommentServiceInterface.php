<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Post;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface CommentServiceInterface
{



    public function save(Comment $comment) : void;

    /**
     * Delete entity.
     *
     * @param Comment $comment Comment entity
     */
    public function delete(Comment $comment): void;
}

