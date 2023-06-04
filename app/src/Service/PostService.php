<?php
/**
 * Post service.
 */

namespace App\Service;

use App\Repository\PostRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class PostService.
 */
class PostService implements PostServiceInterface
{
    /**
     * Category service.
     */
    private CategoryServiceInterface $categoryService;

    /**
     * Post repository.
     */
    private PostRepository $postRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param CategoryServiceInterface $categoryService Category service
     * @param PaginatorInterface       $paginator       Paginator
    //  * @param TagServiceInterface      $tagService      Tag service
     * @param PostRepository           $taskRepository  Task repository
     */
    public function __construct(
        CategoryServiceInterface $categoryService,
        PaginatorInterface $paginator,
        // TagServiceInterface $tagService,
        PostRepository $taskRepository
    ) {
        $this->categoryService = $categoryService;
        $this->paginator = $paginator;
        // $this->tagService = $tagService;
        $this->postRepository = $taskRepository;
    }

    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->postRepository->queryAll(),
            $page,
            PostRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}
