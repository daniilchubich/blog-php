<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class testForFrontEndFromDB extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        // Подключаем файлы, которые инициализируют $pdo
        require_once __DIR__ . '/../src/app/database/connect.php';  // Подключаем connect.php

        // Убедитесь, что $pdo проинициализировано
        $this->assertNotNull($pdo, 'PDO connection failed.');
    }
    public function testForFrontEndFromDB()
    {
        global $pdo;
        if (!empty($pdo)) {
            die('Error');
        }
        include __DIR__ . '/../src/app/database/db.php';
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
