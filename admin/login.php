<?php

session_start();

if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    <link rel="stylesheet" href="/assets/css/admin.css">
</head>

<body class="admin-login-page">

    <div class="login-container">

        <div class="login-card">

            <h1>Admin Portal</h1>

            <p class="login-subtitle">
                Sign in to manage consent records.
            </p>

            <?php if ($error): ?>
                <div class="login-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="handler/login.php">

                <div class="form-group">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        required
                        autocomplete="username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password">
                </div>

                <button type="submit" class="admin-button">
                    Login
                </button>

            </form>

        </div>
        <?php require_once __DIR__ . '/components/footer.php'; ?>
    </div>


</body>

</html>