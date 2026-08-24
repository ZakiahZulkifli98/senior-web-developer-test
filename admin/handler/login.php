<?php

session_start();

require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['login_error'] = 'Please enter your username and password.';
    header('Location: /admin/login.php');
    exit;
}

try {
    $db = get_db();

    $stmt = $db->prepare("
        SELECT id, username, password
        FROM admins
        WHERE username = :username
        LIMIT 1
    ");

    $stmt->execute([
        ':username' => $username
    ]);

    $admin = $stmt->fetch();
} catch (PDOException $e) {
    $_SESSION['login_error'] = 'Unable to process login.';
    header('Location: /admin/login.php');
    exit;
}

if (!$admin || !password_verify($password, $admin['password'])) {
    $_SESSION['login_error'] = 'Invalid username or password.';
    header('Location: /admin/login.php');
    exit;
}

//  Login successful 

session_regenerate_id(true);

$_SESSION['admin_id'] = $admin['id'];
$_SESSION['admin_username'] = $admin['username'];

header('Location: /admin/dashboard.php');
exit;
