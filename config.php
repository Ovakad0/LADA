<?php
$host = 'localhost'; // Сервер базы данных
$db   = 'lada_db';   // Имя базы данных
$user = 'root';      // Пользователь
$pass = '';          // Пароль (пустой для Open Server по умолчанию)
$charset = 'utf8';   // Кодировка

// Настройки PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    die('Ошибка подключения к БД: ' . $e->getMessage());
}
?>