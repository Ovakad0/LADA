<?php
// Включаем вывод ошибок для отладки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Подключаем конфиг
require 'config.php';

// Проверяем метод запроса
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем и очищаем данные
    $name = htmlspecialchars(trim($_POST['name']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $question = htmlspecialchars(trim($_POST['question']));

    // Валидация данных
    if (empty($name) || empty($surname) || empty($email) || empty($question)) {
        die("Заполните все обязательные поля");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Некорректный email");
    }

    try {
        // Подготовленный запрос для безопасности
        $stmt = $pdo->prepare("INSERT INTO feedback (name, surname, email, question) 
                              VALUES (:name, :surname, :email, :question)");
        
        // Выполняем запрос
        $stmt->execute([
            ':name' => $name,
            ':surname' => $surname,
            ':email' => $email,
            ':question' => $question
        ]);

        // Перенаправляем при успехе
        header("Location: feedback_success.html");
        exit();
        
    } catch (PDOException $e) {
        // Логируем ошибку
        file_put_contents('error.log', date('Y-m-d H:i:s').' - '.$e->getMessage()."\n", FILE_APPEND);
        die("Ошибка при сохранении данных. Попробуйте позже.");
    }
} else {
    // Если запрос не POST
    header("Location: feedback.html");
    exit();
}
?>