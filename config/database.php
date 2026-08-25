<?php

function get_db(): PDO
{
    $host = '127.0.0.1';
    $dbname = 'consent_site';
    $username = 'root';
    $password = '123456';

    try {
        $pdo = new PDO(
            "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
            $username,
            $password
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    } catch (PDOException $e) {
        $_SESSION['login_error'] = 'Database connection failed.';
        header('Location: /admin/login.php');
        exit;
    }
}
