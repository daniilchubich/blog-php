<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

// Подключаем файл с функцией selectAllFromPostsWithUsersOnIndex
include_once __DIR__ . '/../src/app/database/db.php';

class SelectAllFromPostsWithUsersOnIndexTest extends TestCase
{
    public function testSelectAllFromPostsWithUsersOnIndex()
    {
        // Создаем mock для объекта PDO
        $pdoMock = $this->createMock(PDO::class);

        // Создаем mock для объекта PDOStatement
        $stmtMock = $this->createMock(PDOStatement::class);

        // Настройка mock-объекта PDO для метода prepare()
        $pdoMock->method('prepare')
            ->willReturn($stmtMock);

        // Настройка mock-объекта PDOStatement для метода execute()
        $stmtMock->method('execute')
            ->willReturn(true);

        // Настройка mock-объекта PDOStatement для метода fetchAll()
        $stmtMock->method('fetchAll')
            ->willReturn([
                ['id' => 1, 'username' => 'user1', 'title' => 'Post 1'],
                ['id' => 2, 'username' => 'user2', 'title' => 'Post 2']
            ]);

        // Подменяем глобальную переменную $pdo на mock-объект
        $GLOBALS['pdo'] = $pdoMock;

        // Параметры для теста
        $table1 = 'posts';
        $table2 = 'users';
        $limit = 2;
        $offset = 0;

        // Выполняем тестируемую функцию, которая теперь должна использовать mock-объект $pdo
        $posts = selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset);

        // Проверка, что результат является массивом
        $this->assertIsArray($posts, 'Error: $posts must be an array.');
        $this->assertNotEmpty($posts, 'Error: $posts must not be empty.');

        // Проверка, что данные соответствуют ожидаемому результату
        $this->assertEquals(2, count($posts), 'Error: Expected 2 posts.');
        $this->assertEquals('user1', $posts[0]['username'], 'Error: Expected username for post 1.');
        $this->assertEquals('Post 1', $posts[0]['title'], 'Error: Expected title for post 1.');
        $this->assertEquals('user2', $posts[1]['username'], 'Error: Expected username for post 2.');
        $this->assertEquals('Post 2', $posts[1]['title'], 'Error: Expected title for post 2.');
    }
}
