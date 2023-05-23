<?php
/**
 * Blog controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController.
 */
 #[Route('/blog')]
class BlogController extends AbstractController
{
    /**
     * Index action.
     *
     * @param string $name User input
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{name}',
        name: 'blog_index',
        // requirements: ['name' => '[a-zA-Z]+'],
        defaults: ['name' => 'index'],
        methods: 'GET'
    )]
    public function index(string $name): Response
    {
        return $this->render(
            'blog/index.html.twig',
            ['name' => $name]
        );
    }

    #[Route('/blog/{nav}', name: 'blog_menu')]
    public function show(string $nav): Response
    {
        return $this->render(
            'blog/'.$nav.'.html.twig',
            ['nav' => $nav]
        );
    }

}
