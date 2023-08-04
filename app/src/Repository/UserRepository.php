<?php
/**
 * This is the license block.
 * It can contain licensing information, copyright notices, etc.
 */
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    private UserPasswordHasherInterface $passwordHasher;
    /**
     * Items per page.
     *
     * Use constants to define configuration options that rarely change instead
     * of specifying them in configuration files.
     * See https://symfony.com/doc/current/best_practices.html#configuration
     *
     * @constant int
     */
    public const PAGINATOR_ITEMS_PER_PAGE = 10;

    /**
     * Constructor
     *
     * @param ManagerRegistry             $registry
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(ManagerRegistry $registry, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct($registry, User::class);
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * Save user
     *
     * @param User $entity
     *
     * @return void
     */
    public function save(User $entity): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($entity, $entity->getPassword());
        $entity->setPassword($hashedPassword);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * Create user
     *
     * @param User $entity
     *
     * @return void
     */
    public function create(User $entity, $password): void
    {
        $password = $this->passwordHasher->hashPassword($entity, $entity->getPassword());
        $entity->setPassword(
            $this->passwordHasher->hashPassword(
                $password
            )
        );
        $entity->setRoles(['ROLE_USER']);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * Remove user
     *
     * @param User $entity
     *
     * @return void
     */
    public function remove(User $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }


    /**
     * Upgrade password function
     *
     * @param PasswordAuthenticatedUserInterface $user
     * @param string                             $newHashedPassword
     *
     * @return void
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }

    /**
     * Query all users.
     *
     * @return QueryBuilder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()
            ->select('partial user.{id, email, username, password}')
            ->orderBy('user.id', 'DESC');
    }

    /**
     * Get or create new query builder.
     *
     * @param QueryBuilder|null $queryBuilder Query builder
     *
     * @return QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?? $this->createQueryBuilder('user');
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}