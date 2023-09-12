<?php
/**
 * User controller.
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserPasswordType;
use App\Form\Type\UserType;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserController.
 */
#[Route('/user')]
class UserController extends AbstractController
{
    /**
     * User service.
     */
    private UserServiceInterface $userService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Security helper.
     */
    private Security $security;

    private EntityManagerInterface $entityManager;

    /**
     * Constructor.
     *
     * @param UserServiceInterface   $userService   User service
     * @param TranslatorInterface    $translator    Translator
     * @param Security               $security      Security
     * @param EntityManagerInterface $entityManager entity manager
     */
    public function __construct(UserServiceInterface $userService, TranslatorInterface $translator, Security $security, EntityManagerInterface $entityManager)
    {
        $this->userService = $userService;
        $this->translator = $translator;
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(name: 'user_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        if (!$this->security->isGranted('ROLE_ADMIN')) {
            $this->addFlash(
                'warning',
                $this->translator->trans('message.access_denied')
            );

            return $this->redirectToRoute('post_index');
        }
        $pagination = $this->userService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('user/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param User $user User entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}', name: 'user_show', requirements: ['id' => '[1-9]\d*'], methods: 'GET')]
    public function show(User $user): Response
    {
        $currentUser = $this->security->getUser();
        if ($this->security->isGranted('ROLE_ADMIN') or ($currentUser === $user)) {
            return $this->render('user/show.html.twig', ['user' => $user]);
        }

        $this->addFlash(
            'warning',
            $this->translator->trans('message.access_denied')
        );

        return $this->redirectToRoute('post_index');
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param User    $user    User entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/edit', name: 'user_edit', requirements: ['id' => '[1-9]\d*'], methods: 'GET|PUT')]
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(
            UserType::class,
            $user,
            [
                'method' => 'PUT',
                'action' => $this->generateUrl('user_edit', ['id' => $user->getId()]),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->save($user);

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render(
            'user/edit.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }

    /**
     * Edit Password action.
     *
     * @param Request $request HTTP request
     * @param User    $user    User entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/editPassword', name: 'user_password', requirements: ['id' => '[1-9]\d*'], methods: 'GET|PUT')]
    public function editPassword(Request $request, User $user): Response
    {
        $form = $this->createForm(
            UserPasswordType::class,
            $user,
            [
                'method' => 'PUT',
                'action' => $this->generateUrl('user_password', ['id' => $user->getId()]),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->save($user);

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('post_index');
        }

        return $this->render(
            'user/edit.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request           $request           HTTP request
     * @param User              $user              User entity
     * @param PostRepository    $postRepository    Post repository
     * @param CommentRepository $commentRepository Comment repository
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/delete', name: 'user_delete', requirements: ['id' => '[1-9]\d*'], methods: 'GET|DELETE')]
    public function delete(Request $request, User $user, PostRepository $postRepository, CommentRepository $commentRepository): Response
    {
        $form = $this->createForm(
            FormType::class,
            $user,
            [
                'method' => 'DELETE',
                'action' => $this->generateUrl('user_delete', ['id' => $user->getId()]),
            ]
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $posts = $postRepository->findBy(['author' => $user->getId()]);
            foreach ($posts as $post) {
                $this->entityManager->remove($post);
            }

            $comments = $commentRepository->findBy(['author' => $user->getId()]);
            foreach ($comments as $comment) {
                $this->entityManager->remove($comment);
            }

            $this->entityManager->remove($user);
            $this->entityManager->flush();

            $this->userService->delete($user);
            $request->getSession()->invalidate();

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'user/delete.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }
}
