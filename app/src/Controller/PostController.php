<?php
/**
 * Post controller.
 */

 namespace App\Controller;

 use App\Entity\Post;
 use App\Service\PostServiceInterface;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController.
 */
#[Route('/post')]
class PostController extends AbstractController
{
    /**
     * Post service.
     */
    private PostServiceInterface $postService;

    /**
     * Constructor.
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(
        name: 'post_index',
        methods: 'GET'
    )]
    public function index(Request $request): Response
    {
        $filters = $this->getFilters($request);
        /** @var User $user */
        $user = $this->getUser();
        $pagination = $this->postService->getPaginatedList(
            $request->query->getInt('page', 1),
            $user,
            $filters
        );

        return $this->render('post/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Post $post Post entity
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'post_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET',
    )]
    public function show(Post $post): Response
    {
        return $this->render(
            'post/show.html.twig',
            ['post' => $post]
        );
    }


    /**
     * Navigation action.
     *
     * @param Post $post Post entity
     *
     * @return Response HTTP response
     */
    #[Route('/{nav}', name: 'post_menu')]
    public function showNav(string $nav): Response
    {
        return $this->render(
            'post/'.$nav.'.html.twig',
            ['nav' => $nav]
        );
    }

    /**
     * Get filters from request.
     *
     * @param Request $request HTTP request
     *
     * @return array<string, int> Array of filters
     *
     * @psalm-return array{category_id: int, tag_id: int, status_id: int}
     */
    private function getFilters(Request $request): array
    {
        $filters = [];
        $filters['category_id'] = $request->query->getInt('filters_category_id');
        // $filters['tag_id'] = $request->query->getInt('filters_tag_id');

        return $filters;
    }
}
