<?php
/**
 * Comment fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class CommentFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class CommentFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(5, 'comments', function (int $i) {
            $comment = new Comment();
            $comment->setContent($this->faker->unique()->word);

            /** @var User $author */
            $author = $this->getRandomReference('users');
            $comment->setAuthor($author);

            /** @var Post $post */
            $post = $this->getRandomReference('posts');
            $comment->setPost($post);

            $post->setCreatedAt(
                \DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );

            return $comment;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: UserFixtures::class}
     * @psalm-return array{0: PostFixtures::class}
     */
    public function getDependencies(): array
    {
        return [UserFixtures::class, PostFixtures::class];
    }
}
