<?php

require_once __DIR__ . '/../vendor/autoload.php';
include '../src/app/controllers/topics.php';

use PHPUnit\Framework\TestCase;

class TestDB extends TestCase
{
    public function testForFrontEndFromDB()
    {
        $limit = 2;
        $offset = 0;

        try {
            $posts = selectAllFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset);
            $topTopic = selectTopTopicFromPostsOnIndex('posts');

            // Check that variables contain expected data
            $this->assertIsArray($posts, 'Error: $posts must be an array.');
            $this->assertNotEmpty($posts, 'Error: $posts must not be empty.');

            $this->assertIsArray($topTopic, 'Error: $topTopic must be an array.');
            $this->assertNotEmpty($topTopic, 'Error: $topTopic must not be empty.');
        } catch (Exception $e) {
            // Fail the test with the error message
            $this->fail('An error occurred while executing the query: ' . $e->getMessage());
        }
    }
}
