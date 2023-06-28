<?php
/**
 * Tag controller.
 */

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Post;
use App\Form\Type\TagType;
use App\Repository\TagRepository;
use App\Service\TagServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;


/**
 * Class TagController.
 */
#[Route('/tag')]
class TagController extends AbstractController
{
    /**
     * Tag service.
     */
    private TagServiceInterface $tagService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     */
    public function __construct(TagServiceInterface $tagService, TranslatorInterface $translator)
    {
        $this->tagService = $tagService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(name: 'tag_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->tagService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('tag/index.html.twig', ['pagination' => $pagination]);
    }

    // /**
    //  * Show action.
    //  *
    //  * @param Category $category Category
    //  *
    //  * @return Response HTTP response
    //  */
    // #[Route(
    //     '/{id}',
    //     name: 'tag_show',
    //     requirements: ['id' => '[1-9]\d*'],
    //     methods: 'GET'
    // )]
    // public function show(Request $request, TagRepository $tagRepository, $id, PaginatorInterface $paginator): Response
    // {
    //     $tag = $tagRepository->find($id);
        
    //     if (!$tag) {
    //         throw $this->createNotFoundException('Tag not found');
    //     }

    //     $pagination = $paginator->paginate(
    //         $posts = $tag->getPosts(),
    //         $request->query->getInt('page', 1),
    //         TagRepository::PAGINATOR_ITEMS_PER_PAGE
    //     );

    //     return $this->render('tag/show.html.twig', [
    //         'tag' => $tag,
    //         'posts' => $posts,
    //         'pagination' => $pagination,
    //     ]);
    // }
    /**
     * Show action.
     *
     * @param Category $category
     *
     * @return Response
     */
    #[Route(
        '/{id}',
        name: 'tag_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Tag $tag): Response
    {
        return $this->render(
            'tag/show.html.twig',
            ['tag' => $tag]
        );
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     */
    #[Route(
        '/create',
        name: 'tag_create',
        methods: 'GET|POST',
    )]
    public function create(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->tagService->save($tag);

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Delete action.
     *
     * @param Request  $request  HTTP request
     * @param Tag $tag Tag entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/delete', name: 'tag_delete', requirements: ['id' => '[1-9]\d*'], methods: 'GET|DELETE')]
    public function delete(Request $request, Tag $tag): Response
    {

        $form = $this->createForm(
            FormType::class, 
            $tag, 
            [
              'method' => 'DELETE',
              'action' => $this->generateUrl('tag_delete', ['id' => $tag->getId()]),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->tagService->delete($tag);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/delete.html.twig',
            [
                'form' => $form->createView(),
                'tag' => $tag,
            ]
        );
    }
    
    
    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param Tag    $tag    Tag entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/edit', name: 'tag_edit', requirements: ['id' => '[1-9]\d*'], methods: 'GET|PUT')]
    public function edit(Request $request, Tag $tag): Response
    {
        $form = $this->createForm(
            TagType::class, 
            $tag, 
            [
                'method' => 'PUT',
                'action' => $this->generateUrl('tag_edit', ['id' => $tag->getId()]),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->tagService->save($tag);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/edit.html.twig', 
            [
                'form' => $form->createView(),
                'tag' => $tag,
            ]
        );
    }


    /**
     * Navigation action.
     *
     * @param Post $post Post entity
     *
     * @return Response HTTP response
     */
    #[Route('/', name: 'tag_menu')]
    public function showNav(string $nav): Response
    {
        return $this->render(
            'tag/'.$nav.'.html.twig',
            ['nav' => $nav]
        );
    }
}
