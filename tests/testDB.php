<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class TestDB extends TestCase
{
    public function testPdoConnection()
    {
        // Подготовка
        $driver = 'mysql';
        $host = 'localhost';
        $db_name = 'myblog';
        $db_user = 'rot';
        $db_pass = '';
        $charset = 'utf8';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        // Тестируем подключение
        try {
            $pdo = new PDO(
                "$driver:host=$host;dbname=$db_name;charset=$charset",
                $db_user,
                $db_pass,
                $options
            );

            // Проверка, что объект PDO успешно создан
            $this->assertInstanceOf(PDO::class, $pdo);
            return $pdo;
        } catch (PDOException $e) {
            // Если ошибка, провалить тест с сообщением об ошибке
            $this->fail('Не удалось подключиться к базе данных: ' . $e->getMessage());
        }
    }
}
