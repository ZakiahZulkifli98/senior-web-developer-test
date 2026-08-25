<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Website') ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <header class="site-header">
        <nav class="navbar">
            <a href="/index.php" class="logo">
                Website
            </a>
            <button
                type="button"
                class="menu-toggle"
                id="menu-toggle"
                aria-label="Toggle navigation"
                aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="nav-links" id="nav-links">
                <a href="/index.php">Home</a>
                <a href="/pages/about_us.php">About Us </a>
                <a href="/pages/privacy_policy.php">Privacy Policy</a>
                <a href="/pages/terms.php">Terms & Conditions</a>
            </div>
        </nav>
    </header>

    <main>