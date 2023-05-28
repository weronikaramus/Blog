<?php
/**
 * Post fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Post;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * Class Postixtures.
 */
class PostFixtures extends AbstractBaseFixtures
{

    /**
     * Load data.
     */
    public function loadData(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $post = new Post();
            $post->setTitle($this->faker->sentence);
            $post->setContent($this->faker->paragraphs(2, true));
            $post->setCreatedAt(
                DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $post->setAuthorId($this->faker->randomNumber(2, false));
            $post->setCategoryId($this->faker->randomNumber(2, false));
            $post->setIsPublished($this->faker->numberBetween(0, 1));
            $post->setSlug($this->faker->slug);

            $this->manager->persist($post);
        }

        $this->manager->flush();
    }
}
