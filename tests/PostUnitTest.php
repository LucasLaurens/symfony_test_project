<?php

namespace App\Tests;

use App\Entity\Post;
use PHPUnit\Framework\TestCase;

class PostUnitTest extends TestCase
{
    public const MAX_SENTENCE_SIZE = 10;

    public function testIsTrue(): void
    {
        $post = new Post();
        $faker = \Faker\Factory::create();
        
        $title = $faker->word;
        $content = implode(', ', $faker->words(self::MAX_SENTENCE_SIZE));
        $author = $faker->name;

        $post->setTitle($title);
        $post->setContent($content);
        $post->setAuthor($author);

        $this->assertTrue($post->getTitle() === $title);
        $this->assertTrue($post->getContent() === $content);
        $this->assertTrue($post->getAuthor() === $author);
    }
}
