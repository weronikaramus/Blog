<?php
/**
 * Post fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Enum\PostStatus;
use App\Entity\Tag;
use App\Entity\Post;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class PostFixtures.
 */
class PostFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullPropertyFetch
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        if (null === $this->manager || null === $this->faker) {
            return;
        }

        $this->createMany(100, 'posts', function (int $i) {
            $post = new Post();
            $post->setTitle($this->faker->sentence);
            $post->setCreatedAt(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );
            $post->setContent($this->faker->paragraph(5));

            /** @var Category $category */
            $category = $this->getRandomReference('categories');
            $post->setCategory($category);

            /** @var User $author */
            $author = $this->getRandomReference('users');
            $post->setAuthor($author);

            /** @var Tag $tag */
            $tags = $this->getRandomReferences('tags',3);
            foreach($tags as $tag){
                $post->addTag($tag);
            }

            return $post;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: CategoryFixtures::class}
     */
    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}