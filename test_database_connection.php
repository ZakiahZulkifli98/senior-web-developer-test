<?php
require_once __DIR__ . '/config/database.php';

try {
    $pdo = get_db();
    echo "Database connection successful!";

    $stmt = $pdo->query("SELECT username FROM admins");
    foreach ($stmt->fetchAll() as $row) {
        echo "<br>Admin user: " . htmlspecialchars($row['username']);
    }
} catch (Exception $e) {
    echo "Failed: " . $e->getMessage();
}
