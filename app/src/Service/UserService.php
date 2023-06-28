<?php
/**
 * User service.
 */

namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Service\NonUniqueResultException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserService.
 */
class UserService implements UserServiceInterface
{
    /**
     * User repository.
     */
    private UserRepository $userRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param UserRepository     $userRepository User repository
     * @param PaginatorInterface $paginator      Paginator
     *
     * @param Security $security Security helper
     */
    public function __construct(UserRepository $userRepository, PaginatorInterface $paginator)
    {
        $this->userRepository = $userRepository;
        $this->paginator = $paginator;
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
            $this->userRepository->queryAll(),
            $page,
            UserRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }


    /**
     * Save entity.
     *
     * @param User $user User entity
     */
    public function save(User $user): void
    {
        // if ($user->getId() == null) {
        //     $user->setCreatedAt(new \DateTimeImmutable());
        // }
        // $user->setUpdatedAt(new \DateTimeImmutable());

        $this->userRepository->save($user);
    }

    /**
     * Find by id.
     *
     * @param int $id User id
     *
     * @return User|null User entity
     *
     * @throws NonUniqueResultException
     */
    public function findOneById(int $id): ?User
    {
        return $this->userRepository->findOneById($id);
    }


    /**
     * Delete entity.
     *
     * @param Post $post Post entity
     */
    public function delete(User $user): void
    {
        $this->userRepository->delete($user);
    }

    public function getUser(User $user): void
    {
        $this->userRepository->getUsername($user);
    }
}
