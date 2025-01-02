<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

// Подключаем файл с функцией selectTopTopicFromPostsOnIndex
include_once __DIR__ . '/../src/app/database/db.php';

class SelectTopTopicFromPostsOnIndexTest extends TestCase
{
    public function testSelectTopTopicFromPostsOnIndex()
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
                ['id' => 1, 'id_topic' => 5, 'title' => 'Top topic post']
            ]);

        // Подменяем глобальную переменную $pdo на mock-объект
        $GLOBALS['pdo'] = $pdoMock;

        // Параметры для теста
        $table1 = 'posts';

        // Выполняем тестируемую функцию, которая теперь должна использовать mock-объект $pdo
        $sql = "SELECT * FROM $table1 WHERE id_topic = 5";
        $query = $pdoMock->prepare($sql);
        $query->execute();
        dbCheckError($query);
        $topTopic = $query->fetchAll();
        //$topTopic = selectTopTopicFromPostsOnIndex($table1);

        // Проверка, что результат является массивом
        $this->assertIsString($topTopic, 'Error: $topTopic must be an array.');
        $this->assertNotEmpty($topTopic, 'Error: $topTopic must not be empty.');

        // Проверка, что данные соответствуют ожидаемому результату
        $this->assertEquals(2, count($topTopic), 'Error: Expected 2 posts.');
        $this->assertEquals($topTopic[0]['id_topic'], 6, 'Error: Expected id_topic to be 6.');
        $this->assertEquals('Top topic post', $topTopic[0]['title'], 'Error: Expected title for top topic post.');
        $this->assertEquals('Another top topic post', $topTopic[1]['title'], 'Error: Expected title for another top topic post.');
    }
}
